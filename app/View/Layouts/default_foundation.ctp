<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title_for_layout; ?></title>
    
    <?php
        $this->Html->css('foundation.min');
        $this->Html->css('app');
    ?>
</head>
<body>
	<div class="container">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
	<?php /* echo $this->element('sql_dump'); */ ?>
    
    <?php
        $this->Html->script('jquery.min');
        $this->Html->script('jquery.jqplot.min');        
    ?>
</body>
</html>
