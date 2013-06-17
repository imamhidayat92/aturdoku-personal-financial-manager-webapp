<?php

class AccountsController extends AppController {
    public function index() {
        $accounts = $this->Account->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        ));
        $this->set('accounts', $accounts);
        
        $this->loadModel('Transaction');
        
        $accountExpenses = $this->Transaction->query("SELECT SUM(amount) AS 'total', account_id FROM transactions WHERE type = 0 AND transactions.user_id = " . $this->Auth->user('id') . " GROUP BY account_id ORDER BY account_id ASC");
        $this->set('accountExpenses', $accountExpenses);
        
        $accountIncomes = $this->Transaction->query("SELECT SUM(amount) AS 'total', account_id FROM transactions WHERE type = 1 AND transactions.user_id = " . $this->Auth->user('id') . " GROUP BY account_id ORDER BY account_id ASC");
        $this->set('accountIncomes', $accountIncomes);
        
        $this->set('title_for_layout', "Daftar Akun");
    }
    
    public function noncash() {
        if ($this->request->isPost()) {
            $this->request->data['Account']['user_id'] = $this->Auth->user('id');
            if ($this->Account->save($this->request->data)) {
                $this->Session->setFlash("Data Akun Telah Tersimpan", 'flash_success');
                $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
            }
            
            $this->Session->setFlash("", 'flash_fail');
        }
        
        $this->set('title_for_layout', "Tambah Akun Baru");
    }
    
    public function cash() {
        if ($this->request->isPost()) {
            $this->request->data['Account']['user_id'] = $this->Auth->user('id');
            if ($this->Account->save($this->request->data)) {
                $this->Session->setFlash("Data Akun Telah Tersimpan", 'flash_success');
                $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
            }
            
            $this->Session->setFlash("", 'fail');
        }
        
        $this->set('title_for_layout', "Tambah Akun Baru");
    }
    
    public function edit($id) {
        if ($this->request->isPost()) {
            if ($this->Account->save($this->request->data)) {
                $this->Session->setFlash("Perbaruan Data Akun Telah Tersimpan", 'flash_success');
                $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
            }
            
            $this->Session->setFlash("", 'fail');
        }
        
        $account = $this->Account->findByid($id);
        $this->set('account', $account);
        
        $this->set('title_for_layout', "Ubah Akun");
    }
    
    public function update($id) {
        if ($this->request->isPost()) {
            if ($this->Account->save($this->request->data)) {
                $this->Session->setFlash("", 'success');
                $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
            }
            
            $this->Session->setFlash("", 'fail');           
        }
        $account = $this->Account->findByid($id);
        $this->set('account', $account);
        
        $this->set('title_for_layout', "Perbarui Saldo Akun");
    }
    
    public function delete($id) {
        
    }
    
    public function transfer() {        
        if ($this->request->isPost()) {
            $sourceAccount = $this->Account->findByid($this->request->data['Account']['sourceId']);
            $destinationAccount = $this->Account->findByid($this->request->data['Account']['destinationId']);
            
            $sourceAccount['Account']['balance'] -= $this->request->data['Account']['amount'];
            $destinationAccount['Account']['balance'] += $this->request->data['Account']['amount'];
            
            if ($this->Account->save($sourceAccount) && $this->Account->save($destinationAccount)) {
                $this->Session->setFlash("", 'flash_success');
                $this->redirect(array('controller' => 'accounts', 'action' => 'index'));
            }
            else {
                $this->Session->setFlash("", 'flash_fail');
            }
        }
        
        $accounts = $this->Account->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        ));
        $this->set('accounts', $accounts);
    }
}
?>
