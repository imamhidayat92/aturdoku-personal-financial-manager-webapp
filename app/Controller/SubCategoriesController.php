<?php
    class SubCategoriesController extends AppController {
        public function beforeFilter() {
            parent::beforeFilter();
        }
        
        public function index($categoryId) {
            $subCategories = $this->SubCategory->find('all', array(
                'category_id'
            ));
            $this->set('subCategories', $subCategories);
            
            $this->set('title_for_layout', "Sub Kategori");
        }
        
        public function add() {
            if ($this->request->isPost()) {
                $this->loadModel('Category');
                $category = $this->Category->findByid($this->request->data['SubCategory']['category_id']);
                
                if ($this->SubCategory->save($this->request->data)) {
                    $this->Session->setFlash("", 'flash_success');
                    
                    if ($category['Category']['category_type'] == 0) {
                        $this->redirect(array('controller' => 'categories', 'action' => 'expense'));
                    }
                    else {
                        $this->redirect(array('controller' => 'categories', 'action' => 'income'));
                    }                    
                }
                else {
                    $this->Session->setFlash("", 'flash_success');
                }
            }
            
            $this->set('title_for_layout', "Tambah Sub Kategori Baru");
        }
        
        public function edit($id) {
            if ($this->request->isPost()) {
                if ($this->SubCategory->save($this->request->data)) {
                    $this->Session->setFlash("", 'flash_success');
                    $this->redirect(array('controller' => 'categories', 'action' => 'index'));
                }
                else {
                    $this->Session->setFlash("", 'flash_fail');
                }
            }
            
            $subCategory = $this->SubCategory->findByid($id);
            $this->set('subCategory', $subCategory);
            
            $this->set('title_for_layout', "Ubah Sub Kategori");            
        }
        
        public function delete($id) {
            
        }
        
        public function view($id) {
            $this->loadModel('Transaction');
            $transactions = $this->Transaction->find('all', array(
                'conditions' => array(
                    'sub_category_id' => $id
                )
            ));
            $this->set('transactions', $transactions);
            
            $subCategory = $this->SubCategory->findByid($id);
            $this->set('subCategory', $subCategory);
            
            $this->set('title_for_layout', "Subkategori: " . $subCategory['SubCategory']['name']);
        }
    }
?>