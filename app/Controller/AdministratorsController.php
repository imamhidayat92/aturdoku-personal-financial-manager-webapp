<?php

class AdministratorsController extends AppController {
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = "default_admin_foundation";
    }
    
    public function index() {
        
    }
}
?>
