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
            'type' => 0
        ));
        $this->set('expenses', $expenses);
        
        $incomes = $this->Category->find('all', array(
            'type' => 1
        ));
        $this->set('incomes', $incomes);
        
        $this->set('title_for_layout', "Kategori Pengeluaran & Pendapatan");
    }
    
    public function add_expense() {
        if($this->request->isPost()){
            $this->request->data['Category']['type'] = 0;
            $this->request->data['Category']['user_id'] = $this->Auth->user('id');
            if($this->Category->save($this->request->data)){
                $this->Session->setFlash('Data Kategori Pengeluaran Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Data Kategori Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
    }
    
    public function add_income() {
        if($this->request->isPost()){
            $this->request->data['Category']['type'] = 1;
            $this->request->data['Category']['user_id'] = $this->Auth->user('id');
            if($this->Category->save($this->request->data)){
                $this->Session->setFlash('Data Kategori Pengeluaran Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
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
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Data Kategori Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
        
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
        $this->paginate['conditions'] = array(
            'User.id' => $this->Auth->user('id'),
            'type' => 0
        );
       $categories = $this->paginate('Category');
       $this->set('categories', $categories);
    }
    
    public function income() {
        $this->paginate['conditions'] = array(
            'User.id' => $this->Auth->user('id'),
            'type' => 1
        );
       $categories = $this->paginate('Category');
       $this->set('categories', $categories);
    }
}
?>
