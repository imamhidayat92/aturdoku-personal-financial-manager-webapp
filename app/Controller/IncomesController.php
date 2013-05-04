<?php

class IncomesController extends AppController {
    
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'id' => 'asc'
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->loadModel('Transaction');
    }
    
    public function index() {
       $incomes = $this->paginate('Transaction');
       $this->set('incomes', $incomes);
    }
    
    public function add() {
        if($this->request->isPost()){
            if($this->Transaction->save($this->request->data)){
                $this->Session->setFlash('Data Pemasukan Telah Tersimpan', 'flash_cutom');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Data Pemasukan Gagal Tersimpan', 'flash_custom');
            }
        }        
    }
    
    public function edit($income_id) {
        if($this->request->isPost()){
            $this->request->data['Transaction']['id'] = $income_id;
            if($this->Transaction->save($this->request->data)){
                $this->Session->setFlash('Ubah Data Pemasukan Telah Tersimpan', 'flash_custom');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Ubah Data Pemasukan Gagal Tersimpan', 'flash_custom');
            }
        }
        
    }
    
    public function delete($income_id) {
        
    }
}
?>
