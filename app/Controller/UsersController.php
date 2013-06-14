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
                'category_type' => '1',
            ),
        ),
        1 => array(
            'Category' => array(
                'name' => 'Pemasukan Tambahan',
                'description' => '',
                'category_type' => '1',
            )
        ),
    );
    
    private $defaultExpenseCategories = array(
        0 => array(
            'Category' => array(
                'name' => 'Administrasi Bulanan',
                'description' => '',
                'category_type' => '0',
            )
        ),
        1 => array(
            'Category' => array(
                'name' => 'Makanan/Minuman',
                'description' => '',
                'category_type' => '0',
            )
        ),
    );
    
    private $defaultAccounts = array(
        0 => array(
            'Account' => array(
                'name' => 'Dompet',
                'saldo' => 0
            )
        )
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
            $this->request->data['User']['first_time'] = true;
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
                
                // Generate initial account.
                $this->loadModel('Account');
                
                foreach ($this->defaultAccounts as $account) {
                    $this->Account->create();
                    $account['Account']['last_update'] = date('Y-m-d');
                    $this->Account->save($account);
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
        
        $monthlyIncomes = $this->Transaction->query("SELECT SUM(amount) AS 'total', CONCAT(MONTH(date), '-', YEAR(date)) AS 'time', date FROM transactions WHERE user_id = " . $this->Auth->user('id') . " AND type = 1 GROUP BY time ORDER BY date");
        $this->set('monthlyIncomes', $monthlyIncomes);
        
        $incomeCategory = $this->Transaction->query("SELECT SUM(amount) AS 'total', categories.name AS 'category' FROM transactions LEFT JOIN categories ON categories.id = transactions.category_id WHERE category_type = 1 AND transactions.user_id = ". $this->Auth->user('id') ." GROUP BY category_id");
        $this->set('incomeCategory', $incomeCategory);
        
        $expenseCategory = $this->Transaction->query("SELECT SUM(amount) AS 'total', categories.name AS 'category' FROM transactions LEFT JOIN categories ON categories.id = transactions.category_id WHERE category_type = 0 AND transactions.user_id = ". $this->Auth->user('id') ." GROUP BY category_id");
        $this->set('expenseCategory', $expenseCategory);
        
        $currentMonthTotalExpense = $this->Transaction->query("SELECT SUM(amount) AS 'total', date FROM transactions WHERE type = 0 AND MONTH(date) = MONTH(NOW()) AND user_id = ". $this->Auth->user('id') ." ");
        $this->set('currentMonthTotalExpense', $currentMonthTotalExpense[0][0]['total']);
        
        $currentMonthAverageExpense = $this->Transaction->query("SELECT AVG(amount) AS 'total', date FROM transactions WHERE type = 0 AND MONTH(date) = MONTH(NOW()) AND user_id = ". $this->Auth->user('id') ." ");
        $this->set('currentMonthAverageExpense', $currentMonthAverageExpense[0][0]['total']);
        
        $currentMonthMaxExpense = $this->Transaction->query("SELECT MAX(amount) AS 'total', date FROM transactions WHERE type = 0 AND MONTH(date) = MONTH(NOW()) AND user_id = ". $this->Auth->user('id') ." ");
        $this->set('currentMonthMaxExpense', $currentMonthMaxExpense[0][0]['total']);
        
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
                
        if ($this->Auth->user('first_time') == 1) {
            $loginData['User']['id'] = $this->Auth->user('id');
            $loginData['User']['first_time'] = 0;
            $this->User->save($loginData);
            $this->Session->write('Auth', $this->User->read(null, $this->Auth->user('id')));
            
            $this->set('first_time', 1);
        }
        else {
            $this->set('first_time', 0);
        }
        
        $this->loadModel('Account');
        $accounts = $this->Account->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )           
        ));
        $this->set('accounts', $accounts);
        
        $accountExpenses = $this->Transaction->query("SELECT SUM(amount) AS 'total', account_id FROM transactions WHERE type = 0 AND transactions.user_id = " . $this->Auth->user('id') . " GROUP BY account_id ORDER BY account_id ASC");
        $this->set('accountExpenses', $accountExpenses);
        
        $accountIncomes = $this->Transaction->query("SELECT SUM(amount) AS 'total', account_id FROM transactions WHERE type = 1 AND transactions.user_id = " . $this->Auth->user('id') . " GROUP BY account_id ORDER BY account_id ASC");
        $this->set('accountIncomes', $accountIncomes);
        
        $totalBalance = $this->Transaction->query("SELECT SUM(balance) AS 'total' FROM accounts WHERE user_id = " . $this->Auth->user('id'));
        $this->set('totalBalance', $totalBalance[0][0]['total']);
    }
}
