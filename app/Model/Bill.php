<?php

class Bill extends AppModel {
    public $name = 'Bill';
    
    public $belongsTo = array(
        'User',        
    );
    
    public $hasOne = array(
      'Transaction'  
    );
}
?>
