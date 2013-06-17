<?php

class SubCategory extends AppModel {
    public $name = "SubCategory";
    
    public $belongsTo = array(
        'Category'
    );
}
?>
