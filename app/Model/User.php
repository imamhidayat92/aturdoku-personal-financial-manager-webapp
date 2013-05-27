<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends AppModel {
    public $name = "User";
    
    public $validate = array(
        
    );
    
    public $hasMany = array(
        'Transaction'
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])){
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
    }
    
    public function beforeDelete($cascade = true) {
        parent::beforeDelete($cascade);
        
        $this->loadModel('ExpensePlan');
        $expensePlans = $this->ExpensePlan->find('all', array(
            'conditions' => array(
                'user_id' => $id
            )
        ));
        foreach ($expensePlans as $expensePlan) {
            $this->ExpensePlan->delete($expensePlan);
        }

        $this->loadModel('Category');
        $categories = $this->Category->find('all', array(
            'conditions' => array(
                'user_id' => $id
            )
        ));
        foreach ($categories as $category) {
            $this->Category->delete($category);
        }

        $this->loadModel('Transaction');
        $transactions = $this->Transaction->find('all', array(
            'conditions' => array(
                'user_id' => $id
            )
        ));
        foreach ($transactions as $transaction) {
            $this->Transaction->delete($transaction);
        }
    }
}
