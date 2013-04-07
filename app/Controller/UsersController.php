<?php

class UsersController extends AppController {
    public function dashboard($user_id) {
        /* TODO: Remove $user_id parameter. Use session instead after login is implemented */
        
        $user = $this->User->findByid($user_id);
        
        $this->set('data', $user);
    }
    
    public function index() {
        die('atur yuuuhuu');
    }    
}
?>
