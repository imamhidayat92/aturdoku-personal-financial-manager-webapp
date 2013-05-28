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
        $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
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
            'Category' => array(
                'name' => 'Pemasukan Bulanan',
                'description' => '',
                'type' => '1',
            ),
        ),
        1 => array(
            'Category' => array(
                'name' => 'Pemasukan Tambahan',
                'description' => '',
                'type' => '1',
            )
        ),
    );
    
    private $defaultExpenseCategories = array(
        0 => array(
            'Category' => array(
                'name' => 'Administrasi Bulanan',
                'description' => '',
                'type' => '0',
            )
        ),
        1 => array(
            'Category' => array(
                'name' => 'Makanan/Minuman',
                'description' => '',
                'type' => '0',
            )
        ),
    );
    
/**
 * add method
 *
 * @return void
 */
    public function add() {
        if ($this->Auth->user() != null) {
            $this->redirect(array('action' => 'dashboard'));
        }
        
        if ($this->request->is('post')) {
            $this->User->create();
            $this->request->data['User']['is_active'] = true;
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

                $this->Session->setFlash('Registrasi berhasil. Silakan masuk dengan menggunakan username dan password Anda.', 'flash_success');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Registrasi gagal. Coba cek ulang data Anda.', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', 'Registrasi');
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
        if (!$this->isAdministrator()) {
            $this->redirect(array('action' => 'dashboard'));
        }
        
        if ($this->User->delete()) {           
            $this->Session->setFlash(__('User dan seluruh datanya telah dihapus.'), 'flash_success');
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
    
    public function login() {
        if ($this->request->isPost()) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('is_active')) {
                    $loginData['User']['last_login'] = date('Y-m-d H:i:s');
                    $loginData['User']['id'] = $this->Auth->user('id');
                    $this->User->save($loginData);
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
        
        $this->set('title_for_layout', "Login");
    }
    
    public function logout() {
        $this->redirect($this->Auth->logout());
    }
    
    public function dashboard() {
        $this->set('title_for_layout', 'Dashboard');
        
        $dailyExpenses = $this->Transaction->query("SELECT date, SUM(amount) AS 'total' FROM transactions WHERE user_id = " . $this->Auth->user('id') . " AND type = 0 GROUP BY date LIMIT 30");
        $this->set('dailyExpenses', $dailyExpenses);
        
        $totalExpenses = $this->Transaction->query("SELECT SUM(amount) AS 'total' FROM transactions WHERE user_id = " . $this->Auth->user('id'). " AND type = 0");
        $this->set('totalExpenses', $totalExpenses[0][0]['total']);
        
        $dailyIncomes = $this->Transaction->query("SELECT date, SUM(amount) AS 'total' FROM transactions WHERE user_id = " . $this->Auth->user('id') . " AND type = 1 GROUP BY date LIMIT 30");
        $this->set('dailyIncomes', $dailyIncomes);
        
        $totalIncomes = $this->Transaction->query("SELECT SUM(amount) AS 'total' FROM transactions WHERE user_id = " . $this->Auth->user('id'). " AND type = 1");
        $this->set('totalIncomes', $totalIncomes[0][0]['total']);
        
        $expenses = $this->Transaction->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id'),
                'type' => 0
            ),
            'order' => array(
                'Transaction.date DESC' 
            ),
            'limit' => 20
        ));
        $this->set('expenses', $expenses);
        
        $incomes = $this->Transaction->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id'),
                'type' => 1
            ),
            'order' => array(
                'Transaction.date DESC' 
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
