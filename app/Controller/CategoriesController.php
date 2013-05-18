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
        
    }
    
    public function add() {
        if ($this->request->isPost()) {
            
        }
    }
    
    public function edit($category_id) {
        
    }
    
    public function delete($category_id) {
        
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
