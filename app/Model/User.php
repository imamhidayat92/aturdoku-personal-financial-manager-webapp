<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 */
class User extends AppModel {
    public $name = "User";
    
    public $hasMany = array(
        'Transaction'
    );
    
    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])){
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }
    }
}
