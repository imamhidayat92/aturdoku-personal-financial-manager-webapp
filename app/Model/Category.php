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
}
?>
