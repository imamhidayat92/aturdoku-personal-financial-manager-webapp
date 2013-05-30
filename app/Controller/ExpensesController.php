<?php

class ExpensesController extends AppController{
    public $itemPerPage = 25;
    
    public $paginate = array(
        'order' => array(
            'date' => 'DESC'
        ),
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->loadModel('Category');
        $this->loadModel('Transaction');        
        $this->loadModel('User');
        
        $this->paginate['limit'] = $this->itemPerPage;
    }
    
    public function index() {
        $this->paginate['conditions'] = array(
            'User.id' => $this->Auth->user('id'),
            'type' => 0
        );
        $expenses = $this->paginate('Transaction');              
        $this->set('expenses', $expenses);
        $this->set('itemPerPage', $this->itemPerPage);
        $this->set('title_for_layout', "Pengeluaran");
    }
    
    public function add() {
        if ($this->request->isPost()) {
            $this->request->data['Transaction']['type'] = 0;
            $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
            $this->request->data['Transaction']['date'] = strlen($this->request->data['Transaction']['date']) == 0 ? date('Y-m-d') : $this->request->data['Transaction']['date'];
            if ($this->Transaction->save($this->request->data)) {
                $this->Session->setFlash('Data Pengeluaran Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'expenses', 'action' => 'index'));
            }
            else {
                $this->Session->setFlash('Data Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Tambah Data Pengeluaran");
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'category_type' => 0
           )
        ));
        $this->set('categories', $categories);
    }
    
    public function edit($expense_id) {
        if ($this->request->isPost()) {
            $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
            $this->request->date['Transaction']['type'] = 0;
            if ($this->Transaction->save($this->request->data)) {
                $this->Session->setFlash('Ubah Data Pengeluaran Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'expenses', 'action' => 'index'));
            }
            else {
                $this->Session->setFlash('Ubah Data Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Ubah Data Pengeluaran");
        
        $expense = $this->Transaction->findByid($expense_id);
        $this->set('expense', $expense);
        
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'category_type' => 0
           )
        ));
        $this->set('categories', $categories);
    }
    
    public function delete($expense_id) {
        $this->Transaction->delete($expense_id);
        $this->redirect(array('controller' => 'users', 'controller' => 'dashboard'));
    }
}
?>
