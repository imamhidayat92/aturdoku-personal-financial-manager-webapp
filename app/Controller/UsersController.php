<?php

class UsersController extends AppController {
    public function dashboard() {
        /* TODO: Remove $user_id parameter. Use session instead after login is implemented */
        $this->set('title_for_layout', "Dashboard");
    }
    
    public function index() {
        die('atur yuuuhuu');
    }    
}
?>
