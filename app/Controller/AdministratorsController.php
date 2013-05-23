<?php

class AdministratorsController extends AppController {
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'User.is_active' => 'DESC',
            'User.last_login' => 'ASC'
        )
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = "default_admin_foundation";
        
        $this->loadModel('User');
    }
    
    public function index() {
        $users = $this->paginate('User');
        $this->set('users', $users);
        $this->set('title_for_layout', 'Manajemen Pengguna');
    }
    
    public function toggleActivateDeactivate($user_id) {
        $this->loadModel('User');
        $user = $this->User->findByid($user_id);
        
        $user['User']['is_active'] = !$user['User']['is_active'];
        
        $this->User->save($user);
        
        $this->redirect(array('controller' => 'administrators', 'action' => 'index'));
    }
}
?>
