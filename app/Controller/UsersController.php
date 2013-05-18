<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add');
        
        $this->loadModel('Transaction');
        $this->loadModel('Category');
        $this->loadModel('Asset');
        $this->loadModel('Post');
    }
/**
 * index method
 *
 * @return void
 */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    private $defaultIncomeCategories = array(
        0 => array(
            'name' => 'Pemasukan Bulanan',
            'description' => '',
            'type' => '1',
        ),
        1 => array(
            'name' => 'Pemasukan Tambahan',
            'description' => '',
            'type' => '1',
        ),
    );
    
    private $defaultExpenseCategories = array(
        0 => array(
            'name' => 'Administrasi Bulanan',
            'description' => '',
            'type' => '0',
        ),
        1 => array(
            'name' => 'Makanan/Minuman',
            'description' => '',
            'type' => '0',
        ),
    );
    
/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $newId = $this->User->getInsertID();

                // Generate initial category.
                $this->loadModel('Category');

                foreach ($this->defaultIncomeCategories as $category) {
                    $this->Category->create();
                    $category['Category']['user_id'] = $newId;
                    $this->Category->save($category);
                }
                
                foreach ($this->defaultExpenseCategories as $category) {
                    $this->Category->create();
                    $category['Category']['user_id'] = $newId;
                    $this->Category->save($category);
                }

                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function login() {
        if ($this->request->isPost()) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('is_active')) {
                    $this->redirect($this->Auth->redirect());
                }
                else {
                    $this->Session->setFlash('Akun Anda belum diaktivasi.', 'flash_fail');
                    $this->logout();
                }
            }
            else {
                $this->Session->setFlash('Login Error', 'flash_fail');
            }
        }
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function dashboard() {
        $expenses = $this->Transaction->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id'),
                'type' => 0
            ),
            'order' => array(
                'Transaction.created DESC' 
            ),
            'limit' => 31
        ));
        $this->set('expenses', $expenses);
        
        $incomes = $this->Transaction->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id'),
                'type' => 1
            ),
            'order' => array(
                'Transaction.created DESC' 
            ),
            'limit' => 31
        ));
        $this->set('incomes', $incomes);
        
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
    }
}
