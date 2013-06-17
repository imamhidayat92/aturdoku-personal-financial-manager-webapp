<?php

class BillsController extends AppController {
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->loadModel('Account');
        $this->loadModel('Transaction');
        $this->loadModel('Category');
    }
    
    public function index() {
        $bills = $this->Bill->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id')
           ) 
        ));
        $this->set('bills', $bills);
        
        $this->set('title_for_layout', "Daftar Tagihan");
    }
    
    public function add() {
        if ($this->request->isPost()) {
            $this->request->data['Bill']['user_id'] = $this->Auth->user('id');
            if ($this->Bill->save($this->request->data)) {
                $this->Session->setFlash("Data Tagihan Telah Tersimpan", 'flash_success');
                $this->redirect(array('controller' => 'bills', 'action' => 'index'));
            }
            
            $this->Session->setFlash("Data Tagihan Gagal Tersimpan", 'flash_fail');
        }
        
        $this->set('title_for_layout', "Tambah Tagihan Baru");
        
        $accounts = $this->Account->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        ));
        $this->set('accounts', $accounts);                
    }
    
    public function edit($id) {
        if ($this->request->isPost()) {
            if ($this->Bill->save($this->request->data)) {
                $this->Session->setFlash("Ubah Data Tagihan Telah Tersimpan", 'flash_success');
                $this->redirect(array('controller' => 'bills', 'action' => 'index'));
            }
            
            $this->Session->setFlash("Ubah Data Tagihan Gagal", 'flash_fail');
        }
        
        $this->set('title_for_layout', "Ubah Data Tagihan");
        
        $bill = $this->Bill->findByid($id);
        $this->set('bill', $bill);
        
    }
    
    public function delete($id) {
        $this->Bill->delete($id);
        $this->redirect(array('controller' => 'bills', 'action' => 'index'));
    }
    
    public function pay($id){
        if ($this->request->isPost()) {            
            if ($this->Bill->save(array('Bill' => array('id' => $id, 'paid_status' => true)))) {
                $insertedBillId = $this->Bill->getInsertID();
                
                $this->request->data['Transaction']['type'] = 0;
                $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
                $this->request->data['Transaction']['date'] = strlen($this->request->data['Transaction']['date']) == 0 ? date('Y-m-d') : $this->request->data['Transaction']['date'];
                $this->request->data['Transaction']['bill_id'] = $insertedBillId;
                
                $this->Transaction->save($this->request->data);
                
                $this->Session->setFlash("Pembayaran Tagihan telah diproses dengan sukses.", 'flash_success');
                $this->redirect(array('controller' => 'bills', 'action' => 'index'));
            }
            
            $this->Session->setFlash("Pembayaran Tagihan gagal.", 'flash_fail');
        }
        
        $this->set('title_for_layout', "Ubah Data Tagihan");
        
        $bill = $this->Bill->findByid($id);
        $this->set('bill', $bill);
        
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'category_type' => 0
           )
        ));
        $this->set('categories', $categories);
        
        $accounts = $this->Account->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        ));
        $this->set('accounts', $accounts);
    }
}

?>
