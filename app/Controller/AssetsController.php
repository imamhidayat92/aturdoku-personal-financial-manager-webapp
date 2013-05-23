<?php

class AssetsController extends AppController {
    
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'id' => 'asc'
        )
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->loadModel('User');
    }
    
    public function index() {
        $this->paginate['conditions'] = array(
            'User.id' => $this->Auth->user('id')
        );
        
        $assets = $this->paginate('Asset');
         $this->set('assets', $assets);
    }
    
    public function add() {
        if($this->request->isPost()){
            $this->request->data['Asset']['user_id'] = $this->Auth->user('id');
            if($this->Asset->save($this->request->data)){
                $this->Session->setFlash('Data aset telah tersimpan.', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Data Aset Gagal Tersimpan', 'flash_fail');
            }
        }
    }
    
    public function edit($asset_id) {
        if($this->request->isPost()){
            $this->request->data['Asset']['user_id'] = $this->Auth->user('id');
            if($this->Asset->save($this->request->data)){
                $this->Session->setFlash('Data aset telah tersimpan.', 'flash_success');
                $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
            }
            else{
                $this->Session->setFlash('Ubah Data Aset Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Ubah Data Aset");
        
        $data = $this->Asset->findByid($asset_id);
        $this->set('data', $data);
    }
    
    public function delete($asset_id) {
        $this->Asset->delete($asset_id);
    }
    
    public function outputtopdf(){
        $assets = $this->Asset->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            ),
            'order' => array(
                'Asset.year DESC' 
            ),
            'limit' => 5
        ));
        $this->set('assets', $assets);
        
        App::import('Vendor', 'Fpdf', array('file' => 'fpdf/fpdf.php'));
        $this->layout = 'pdf'; //this will use the pdf.ctp layout
        
        $this->response->type('pdf');
        
        $pdfObject = new FPDF('P','mm','A4');
        $pdfObject->SetLeftMargin(20);
        $pdfObject->SetRightMargin(20);
        
        $this->set('fpdf', $pdfObject);

        $this->render('pdf');
    }
}
?>
