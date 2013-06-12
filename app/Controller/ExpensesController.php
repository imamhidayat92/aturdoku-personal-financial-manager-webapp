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
        
        $monthlyExpense = $this->Transaction->query("SELECT SUM(amount) AS 'total', CONCAT(MONTH(date), ' - ', YEAR(date)) AS 'time', date, MONTH(date) AS 'month', YEAR(date) AS 'year' FROM transactions WHERE user_id = " . $this->Auth->user('id') . " AND type = 0 GROUP BY time ORDER BY date DESC");
        $this->set('monthlyExpense', $monthlyExpense);      
        
        $years = $this->Transaction->query("SELECT YEAR(date) AS 'year' FROM transactions WHERE user_id = ". $this->Auth->user('id') ." AND type = 0 GROUP BY year");
        $this->set('years', $years);
        
        $this->set('itemPerPage', $this->itemPerPage);
        $this->set('title_for_layout', "Pengeluaran");
    }
    
    public function add() {
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
    }
    
    public function delete($expense_id) {
        $this->Transaction->delete($expense_id);
        $this->redirect(array('controller' => 'users', 'controller' => 'dashboard'));
    }
    
    public function daily($year, $month){
        $expenses = $this->Transaction->find('all', array(
            'conditions' => array(
                'MONTH(Transaction.date)' => $month,
                'type' => 0,
                'User.id' => $this->Auth->user('id')
            )
        ));        
        $this->set('expenses', $expenses);
        $this->set('title_for_layout', 'Pengeluaran Bulan ' . $month . ' ' . $year);
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
        $this->set('title_for_layout', 'Pengeluaran Tanggal '. $day .' ' . $month . ' ' . $year);
    }
}
?>
