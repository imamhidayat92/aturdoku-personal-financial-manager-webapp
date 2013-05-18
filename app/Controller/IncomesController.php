<?php

class IncomesController extends AppController {
    
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'id' => 'asc'
        ),
        
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->loadModel('Transaction');
        $this->loadModel('Category');
        $this->loadModel('User');
    }
    
    public function index() {
        $this->paginate['conditions'] = array(
            'User.id' => $this->Auth->user('id'),
            'type' => 1
        );
       $incomes = $this->paginate('Transaction');
       $this->set('incomes', $incomes);
    }
    
    public function add() {
        if($this->request->isPost()){
            $this->request->data['Transaction']['type'] = 1;
            $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
            if($this->Transaction->save($this->request->data)){
                $this->Session->setFlash('Data Pemasukan Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Data Pemasukan Gagal Tersimpan', 'flash_fail');
            }
        }        
        
        $this->set('title_for_layout', "Tambah Data Pemasukan");
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'type' => 1
           )
        ));
        $this->set('categories', $categories);
    }
    
    public function edit($income_id) {
        if($this->request->isPost()){
            $this->request->data['Transaction']['id'] = $income_id;
            if($this->Transaction->save($this->request->data)){
                $this->Session->setFlash('Ubah Data Pemasukan Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Ubah Data Pemasukan Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Edit Data Pemasukan");
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'type' => 1
           )
        ));
        $this->set('categories', $categories);
    }
    
    public function delete($income_id) {
        
    }
}
?>
