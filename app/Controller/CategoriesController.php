<?php

class CategoriesController extends AppController {
    
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'id' => 'asc'
        ),        
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->loadModel('User');
    }
    
    public function index() {
        $expenses = $this->Category->find('all', array(
            'category_type' => 0
        ));
        $this->set('expenses', $expenses);
        
        $incomes = $this->Category->find('all', array(
            'category_type' => 1
        ));
        $this->set('incomes', $incomes);
        
        $this->set('title_for_layout', "Kategori Pengeluaran & Pendapatan");
    }
    
    public function add_expense() {
        if($this->request->isPost()){
            $this->request->data['Category']['category_type'] = 0;
            $this->request->data['Category']['user_id'] = $this->Auth->user('id');
            if($this->Category->save($this->request->data)){
                $this->Session->setFlash('Data Kategori Pengeluaran Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'categories', 'action' => 'expense'));
            }
            else{
                $this->Session->setFlash('Data Kategori Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
    }
    
    public function add_income() {
        if($this->request->isPost()){
            $this->request->data['Category']['category_type'] = 1;
            $this->request->data['Category']['user_id'] = $this->Auth->user('id');
            if($this->Category->save($this->request->data)){
                $this->Session->setFlash('Data Kategori Pengeluaran Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'categories', 'action' => 'income'));
            }
            else{
                $this->Session->setFlash('Data Kategori Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
    }
    
    public function edit($category_id) {
        if($this->request->isPost()){
            $this->request->data['Category']['user_id'] = $this->Auth->user('id');
            if($this->Category->save($this->request->data)){
                $this->Session->setFlash('Data Kategori Telah Tersimpan', 'flash_success');
                if ($this->request->data['Category']['category_type'] == 0) {
                    $this->redirect(array('controller' => 'categories', 'action' => 'expense'));
                }
                else{
                    $this->redirect(array('controller' => 'categories', 'action' => 'income'));
                }
                    
            }
            else{
                $this->Session->setFlash('Data Kategori Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Ubah Data Kategori");
        
        $data = $this->Category->findByid($category_id);
        $this->set('data', $data);
        
    }
    
    public function delete($category_id) {
        if ($this->Category->delete($category_id)) {
            
        }
        else {
            
        }
    }
    
    public function expense() {
        $this->set('title_for_layout', "Kategori Pengeluaran");
        
        $this->paginate['conditions'] = array(
            'User.id' => $this->Auth->user('id'),
            'category_type' => 0
        );
       $categories = $this->paginate('Category');
       $this->set('categories', $categories);
    }
    
    public function income() {
        $this->set('title_for_layout', "Kategori Pendapatan");
        
        $this->paginate['conditions'] = array(
            'User.id' => $this->Auth->user('id'),
            'category_type' => 1
        );
       $categories = $this->paginate('Category');
       $this->set('categories', $categories);
    }
    
    public function view($id) {
        $this->loadModel('Transaction');
        
        $category = $this->Category->findByid($id);
        $this->set('category', $category);
        
        $this->paginate['conditions'] = array(
            'Transaction.category_id' => $id,
        );
        $transactions = $this->paginate('Transaction');        
        $this->set('transactions', $transactions);
        
        $this->set('title_for_layout', 'Pendapatan Kategori: ' . $category['Category']['name']);
    }
}
?>
