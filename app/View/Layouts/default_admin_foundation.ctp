<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title_for_layout; ?> - aturdoku.com</title>
    
    <!-- Styles -->
    <?php
        echo $this->Html->css('foundation.min');
        echo $this->Html->css('aturdoku.app');
        echo $this->Html->css('jquery.jqplot.min');
    ?>
    
    <!-- Scripts -->
    <?php
        echo $this->Html->script('jquery.min');
        echo $this->Html->script('jquery.jqplot.min');        
    ?>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200' rel='stylesheet' type='text/css'>
</head>
<body style="background-color: #2ba6cb">
	<div class="container">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
        <div class="row">
            <div class="large-12 columns" style="background-color: #c1c2c2; font-size: 0.8em; margin-top: 0.5em;">
                <p align="center" style="color: #ebebeb;">&copy; 2013 - aturdoku.com | Development Teams</p>
            </div>
        </div>
    </div>
	<?php /* echo $this->element('sql_dump'); */ ?>
</body>
</html>
