<?php

class SiteController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('index');
        
        $this->layout = "default_home_foundation";
    }

        public function index() {
        
    }
}
?>
