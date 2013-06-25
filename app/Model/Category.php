<?php

class Category extends AppModel {
    public $name = "Category";
    
    public $belongsTo = array(
        'User'
    );
    
    public $hasMany = array(
        'Transaction',
        'ExpensePlan',
        'SubCategory'
    );
    
    public function getTotalExpense($categoryId, $month, $year) {
        $sql = "SELECT SUM(amount) AS 'total', date, categories.name AS 'category' FROM transactions LEFT JOIN categories ON categories.id = transactions.category_id WHERE MONTH(date) = " . $month . " AND YEAR(date) = " . $year . " AND type = 0 AND transactions.user_id = " . AuthComponent::user('id') . " AND category_id = " . $categoryId . " GROUP BY category_id";
        $result = $this->query($sql);
        
        return $result[0]['total'];
    }
}
?>
