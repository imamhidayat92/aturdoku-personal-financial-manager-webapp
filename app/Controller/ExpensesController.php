<?php

class ExpensesController extends AppController{
    public $itemPerPage = 25;
    
    public $paginate = array(
        'order' => array(
            'date' => 'DESC'
        ),
    );
    
    public function beforeFilter() {
        parent::beforeFilter();
        
        $this->loadModel('Category');
        $this->loadModel('Transaction');        
        $this->loadModel('Account');
        $this->loadModel('User');
        
        $this->paginate['limit'] = $this->itemPerPage;
    }
    
    public function index() {       
        if($this->request->isPost()){
            $this->redirect(array('controller' => 'expenses', 'action' => 'daily', $this->request->data['Transaction']['year'], $this->request->data['Transaction']['month']));
        }
        $this->paginate['conditions'] = array(
            'User.id' => $this->Auth->user('id'),
            'type' => 0,
            'MONTH(Transaction.date)' => date('m')
        );
        $expenses = $this->paginate('Transaction');              
        $this->set('expenses', $expenses);
        
        $dailyExpenses = $this->Transaction->query("SELECT date, SUM(amount) AS 'total' FROM transactions WHERE user_id = " . $this->Auth->user('id') . " AND type = 0 AND MONTH(date) = MONTH(NOW()) GROUP BY date LIMIT 30");
        $this->set('dailyExpenses', $dailyExpenses);
        
        $monthlyExpense = $this->Transaction->query("SELECT SUM(amount) AS 'total', CONCAT(MONTH(date), '-', YEAR(date)) AS 'time', date, MONTH(date) AS 'month', YEAR(date) AS 'year' FROM transactions WHERE user_id = " . $this->Auth->user('id') . " AND type = 0 GROUP BY time ORDER BY date DESC");
        $this->set('monthlyExpense', $monthlyExpense);
        
        $monthlyExpenseGraph = $this->Transaction->query("SELECT SUM(amount) AS 'total', CONCAT(MONTH(date), '-', YEAR(date)) AS 'time', date, MONTH(date) AS 'month', YEAR(date) AS 'year' FROM transactions WHERE user_id = " . $this->Auth->user('id') . " AND type = 0 GROUP BY time ORDER BY date ASC");
        $this->set('monthlyExpenseGraph', $monthlyExpenseGraph);
        
        $years = $this->Transaction->query("SELECT YEAR(date) AS 'year' FROM transactions WHERE user_id = ". $this->Auth->user('id') ." AND type = 0 GROUP BY year");
        $this->set('years', $years);
        
        $this->set('itemPerPage', $this->itemPerPage);
        $this->set('title_for_layout', "Pengeluaran");
    }
    
    public function add() {
        $this->checkWhetherUserAccountIsExist();
        if ($this->request->isPost()) {
            $this->request->data['Transaction']['type'] = 0;
            $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
            $this->request->data['Transaction']['date'] = strlen($this->request->data['Transaction']['date']) == 0 ? date('Y-m-d') : $this->request->data['Transaction']['date'];
            if ($this->Transaction->save($this->request->data)) {
                $this->Session->setFlash('Data Pengeluaran Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'expenses', 'action' => 'index'));
            }
            else {
                $this->Session->setFlash('Data Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Tambah Data Pengeluaran");
        
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'category_type' => 0
           )
        ));
        $this->set('categories', $categories);
        
        $accounts = $this->Account->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        ));
        $this->set('accounts', $accounts);
    }
    
    public function edit($expense_id) {
        if ($this->request->isPost()) {
            $this->request->data['Transaction']['user_id'] = $this->Auth->user('id');
            $this->request->date['Transaction']['type'] = 0;
            if ($this->Transaction->save($this->request->data)) {
                $this->Session->setFlash('Ubah Data Pengeluaran Telah Tersimpan', 'flash_success');
                $this->redirect(array('controller' => 'expenses', 'action' => 'index'));
            }
            else {
                $this->Session->setFlash('Ubah Data Pengeluaran Gagal Tersimpan', 'flash_fail');
            }
        }
        
        $this->set('title_for_layout', "Ubah Data Pengeluaran");
        
        $expense = $this->Transaction->findByid($expense_id);
        $this->set('expense', $expense);
        
        $categories = $this->Category->find('all', array(
           'conditions' => array(
               'User.id' => $this->Auth->user('id'),
               'category_type' => 0
           )
        ));
        $this->set('categories', $categories);
        
        $accounts = $this->Account->find('all', array(
            'conditions' => array(
                'User.id' => $this->Auth->user('id')
            )
        ));
        $this->set('accounts', $accounts);
    }
    
    public function delete($expense_id) {
        $this->Transaction->delete($expense_id);
        $this->redirect(array('controller' => 'users', 'controller' => 'dashboard'));
    }
    
    public function daily($year, $month){
        $expenses = $this->Transaction->find('all', array(
            'conditions' => array(
                'MONTH(Transaction.date)' => $month,
                'YEAR(Transaction.date)' => $year,
                'type' => 0,
                'User.id' => $this->Auth->user('id')
            )
        ));
        
        $dailyExpenses = $this->Transaction->query("SELECT SUM(amount) AS 'total', date FROM transactions WHERE MONTH(date) = " . $month . " AND YEAR(date) = " . $year . " AND type = 0 AND user_id = " .$this->Auth->user('id') . " GROUP BY date");
        $this->set('dailyExpenses', $dailyExpenses);
        
        $dailyExpensesCategoryGraph = $this->Transaction->query("SELECT SUM(amount) AS 'total', date, categories.name AS 'category' FROM transactions LEFT JOIN categories ON categories.id = transactions.category_id WHERE MONTH(date) = " . $month . " AND YEAR(date) = " . $year . " AND type = 0 AND transactions.user_id = " .$this->Auth->user('id') . " GROUP BY category_id");
        $this->set('dailyExpensesCategoryGraph', $dailyExpensesCategoryGraph);
        
        $this->set('expenses', $expenses);
        $this->set('title_for_layout', 'Pengeluaran Bulan ' . $month . ' ' . $year);
        
        $this->set('parameterMonth', $month > 9 ? $month:"0" . $month);
        $this->set('parameterYear', $year);
    }
    
    public function detail($year, $month, $day){
        $expenses = $this->Transaction->find('all', array(
            'conditions' => array(
                'MONTH(Transaction.date)' => $month,
                'DAY(Transaction.date)' => $day,
                'type' => 0,
                'User.id' => $this->Auth->user('id')
            )
        ));        
        $this->set('expenses', $expenses);
        
        $detailExpensesCategoryGraph = $this->Transaction->query("SELECT SUM(amount) AS 'total', date, categories.name AS 'category' FROM transactions LEFT JOIN categories ON categories.id = transactions.category_id WHERE MONTH(date) = " . $month . " AND DAY(date) = " . $day . " AND type = 0 AND transactions.user_id = " .$this->Auth->user('id') . " GROUP BY category_id");
        $this->set('detailExpensesCategoryGraph', $detailExpensesCategoryGraph);
        
        $this->set('title_for_layout', 'Pengeluaran Tanggal '. $day .' ' . $month . ' ' . $year);
    }
    
    public function filter($period, $number){
        if(strcasecmp($period, 'month') == 0) {
            $expenses = $this->Transaction->query("SELECT SUM(amount) AS 'total', CONCAT(MONTH(date), '-', YEAR(date)) AS 'time' FROM transactions WHERE type = 0 AND user_id = " . $this->Auth->user('id') . " AND date >= DATE_SUB(CURRENT_DATE, INTERVAL " . $number . " MONTH) GROUP BY time ORDER BY date DESC ");
            $this->set('filteredExpenses', $expenses);
            $this->set('number', $number);
            $expensesCategoryGraph = $this->Transaction->query("SELECT SUM(amount) AS 'total', CONCAT(MONTH(date), '-', YEAR(date)) AS 'time', categories.name AS 'category' FROM transactions LEFT JOIN categories ON categories.id = transactions.category_id WHERE transactions.type = 0 AND transactions.user_id = " . $this->Auth->user('id') . " AND date >= DATE_SUB(CURRENT_DATE, INTERVAL ". $number ." MONTH) GROUP BY category_id ORDER BY date DESC");
            $this->set('expensesCategoryGraph', $expensesCategoryGraph);
        }
    }
}
?>
