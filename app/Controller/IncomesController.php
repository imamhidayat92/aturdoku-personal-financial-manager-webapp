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
       $this->set('title_for_layout', "Pendapatan");
    }
    
    public function add() {
        $this->checkWhetherUserAccountIsExist();
        if($this->request->isPost()){
            $this->request->data['Transaction']['type'] = 1;
            $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
            if (strlen(trim($this->request->data['Transaction']['date'])) == 0) {
                $this->request->data['Transaction']['date'] = date('Y-m-d');
            }            
            if($this->Transaction->save($this->request->data)){
                $this->Session->setFlash('Data Pendapatan Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'incomes', 'action' => 'index'));
            }
            else{
                $this->Session->setFlash('Data Pendapatan Gagal Tersimpan', 'flash_fail');
            }
        }        
        
        $this->set('title_for_layout', "Tambah Data Pendapatan");
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'category_type' => 1
           )
        ));
        $this->set('categories', $categories);
    }
    
    public function edit($income_id) {
        if($this->request->isPost()){
            $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
            $this->request->date['Transaction']['type'] = 1;
            if($this->Transaction->save($this->request->data)){
                $this->Session->setFlash('Ubah Data Pendapatan Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'incomes', 'action' => 'index'));
            }
            else{
                $this->Session->setFlash('Ubah Data Pendapatan Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Ubah Data Pendapatan");
        
        $income = $this->Transaction->findByid($income_id);
        $this->set('income', $income);
        
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'category_type' => 1
           )
        ));
        $this->set('categories', $categories);
    }
    
    public function delete($income_id) {
        $this->Transaction->delete($income_id);
        $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
    }
}
?>
