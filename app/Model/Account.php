<?php

class Account extends AppModel {
    public $name = 'Account';
    
    public $belongsTo = array(
        'User'
    );    
}
?>
