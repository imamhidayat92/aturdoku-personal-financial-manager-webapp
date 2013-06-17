<?php

class Bill extends AppModel {
    public $name = 'Bill';
    
    public $belongsTo = array(
        'User',
        'Account'
    );
    
    public $hasOne = array(
      'Transaction'  
    );
}
?>
