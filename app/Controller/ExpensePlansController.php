<?php

class ExpensePlansController extends AppController {
    public $paginate = array(
        'limit' => 5
    );
    
    public function index() {       
        $this->set('title_for_layout', "Rencana Pengeluaran");
        
        $this->paginate['conditions']['user_id'] = $this->Auth->user('id');
        
        $dateElements = explode('-', date('Y-m-d'));
        
        $plans = $this->ExpensePlan->find('all', array(
            'conditions' => array(
                'MONTH(time)' => '\'' . $dateElements[0] . '-' . $dateElements[1] . '-1' . '\''
            )
        ));
        $this->set('plans', $plans);
        
        $this->loadModel('Transaction');
        $expenseCategories = $this->Transaction->query("SELECT SUM(amount) AS 'total', date, categories.name AS 'category' FROM transactions LEFT JOIN categories ON categories.id = transactions.category_id WHERE MONTH(date) = " . date('m') . " AND YEAR(date) = " . date('Y') . " AND type = 0 AND transactions.user_id = " .$this->Auth->user('id') . " GROUP BY category_id");
        $this->set('expenseCategories', $expenseCategories);
        
        $this->loadModel('Category');        
    }
    
    public function add() {
        if ($this->request->isPost()) {
            // TODO: Decline save if month < current month.
            
            $this->request->data['ExpensePlan']['year'] = date('Y');
            $this->request->data['ExpensePlan']['user_id'] = $this->Auth->user('id');
            if ($this->ExpensePlan->save($this->request->data)) {
                $this->Session->setFlash("Rencana Pengeluaran telah berhasil disimpan.", "flash_success");
                $this->redirect(array('controller' => 'expenseplans', 'action' => 'index'));
            }
        }            
        
        $this->set('title_for_layout', "Buat Rencana Pengeluaran");
        
        $this->loadModel('Category');
        $categories = $this->Category->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id'),
                'category_type' => 0
            )
        ));
        $this->set('categories', $categories);
    }
    
    public function edit($id) {
        if ($this->request->isPost()) {
            if ($this->ExpensePlan->save($this->request->data)) {
                $this->Session->setFlash("", 'flash_success');
                $this->redirect(array('controller' => 'expenseplans', 'action' => 'index'));
            }
            else {
                $this->Session->setFlash("", 'flash_fail');
            }            
        }
        
        $expensePlan = $this->ExpensePlan->findByid($id);
        $this->set('expensePlan', $expensePlan);
        
        $this->set('title_for_layout', "");
    }
    
    public function delete($expense_plan_id) {
        if ($this->ExpensePlan->delete($expense_plan_id)) {
            $this->redirect(array('controller' => 'expenseplans', 'action' => 'index'));
        }        
    }
}
?>
