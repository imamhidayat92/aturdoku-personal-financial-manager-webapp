<?php

class AssetsController extends AppController {
    
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'id' => 'asc'
        ),
        'conditions' => array(
            'User.id' => 0 // TODO: Put User.id from AuthComponent here.
        )
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->loadModel('User');
    }
    
    public function index() {
         $assets = $this->paginate('Asset');
         $this->set('assets', $assets);
    }
    
    public function add() {
        if($this->request->isPost()){
            if($this->Asset->save($this->request->data)){
                $this->Session->setFlash('Data Aset Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Data Aset Gagal Tersimpan', 'flash_fail');
            }
        }
    }
    
    public function edit($asset_id) {
        if($this->request->isPost()){
            $this->request->data['Asset']['id'] = $asset_id;
            if($this->Asset->save($this->request->data)){
                $this->Session->setFlash('Ubah Data Aset Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Ubah Data Aset Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Edit Data Aset");
        
        $data = $this->Asset->findByid($asset_id);
        $this->set('data', $data);
    }
    
    public function delete($asset_id) {
        
    }
}
?>
