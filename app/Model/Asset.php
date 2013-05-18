<?php

class Asset extends AppModel {
    public $name = "Asset";
    
    public $belongsTo = array(
        'User'
    );
    
}
?>
