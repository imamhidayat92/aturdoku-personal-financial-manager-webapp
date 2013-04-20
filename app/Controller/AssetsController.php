<?php

class AssetsController extends AppController {
    public function index() {
        
    }
    
    public function add() {
        
    }
    
    public function edit($asset_id) {
        $this->set('title_for_layout', "Edit Data Aset");
        
        if ($this->request->isPost()) {
            $this->request->data['Transaction']['id'] = $asset_id;
            
            if ($this->Transaction->save($this->request->data)) {
                $this->Session->setFlash("", "flash_custom");
            }
        }
        
        $asset = $this->Asset->findByid($asset_id);
        $this->set('asset', $asset);
    }
    
    public function delete($asset_id) {
        
    }
}
?>
