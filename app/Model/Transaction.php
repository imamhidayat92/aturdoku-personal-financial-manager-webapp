<?php
class Transaction extends AppModel {
    public $name = "Transaction";
    
    public $belongsTo = array(
        'User'
    );
}
?>
