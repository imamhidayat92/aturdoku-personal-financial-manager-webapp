<?php

class ExpensesPlanController extends AppController {
    public $paginate = array(
        'limit' => 5
    );
    
    public function index() {
        
    }
    
    public function add() {
        if ($this->request->isPost()) {
            if ($this->ExpensePlan->save($this->request->isPost())) {
                
            }
        }            
    }
    
    public function edit() {
        if ($this->request->isPost()) {
            if ($this->ExpensePlan->save($this->request->isPost())) {
                
            }
        }
    }
    
    public function delete($expense_plan_id) {
        $this->ExpensePlan->delete($expense_plan_id);
    }
}
?>
