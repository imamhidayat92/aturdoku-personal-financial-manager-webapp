<?php

class ExpensesController extends AppController{
    
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'date' => 'ASC'
        )
    );
    
    public function index() {
       $expenses = $this->paginate('Transaction');
       $this->set('expenses', $expenses);
    }
    
    public function add() {
        if ($this->request->isPost()) {
            if ($this->Transaction->save($this->request->data)) {
                $this->Session->setFlash('Data Pengeluaran Telah Tersimpan', 'flash_custom');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else {
                $this->Session->setFlash('Data Pengeluaran Gagal Tersimpan', 'flash_custom');
            }
        }
    }
    
    public function edit($expense_id) {
        if ($this->request->isPost()) {
            $this->request->data['Transaction']['id'] = $expense_id;
            if ($this->Transaction->save($this->request->data)) {
                $this->Session->setFlash('Ubah Data Pengeluaran Telah Tersimpan', 'flash_custom');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else {
                $this->Session->setFlash('Ubah Data Pengeluaran Gagal Tersimpan', 'flash_custom');
            }
        }
    }
    
    public function delete($expense_id) {
        
    }
}
?>
