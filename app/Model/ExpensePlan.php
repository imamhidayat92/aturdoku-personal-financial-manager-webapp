<?php
class ExpensePlan extends AppModel {
    public $name = "ExpensePlan";
    
    public $belongsTo = array('Category');
}
?>
