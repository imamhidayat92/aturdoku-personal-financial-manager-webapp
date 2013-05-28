<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title_for_layout; ?> - aturdoku.com</title>
    
    <!-- Styles -->
    <?php
        echo $this->Html->css('foundation.min');
        echo $this->Html->css('aturdoku.app');
        echo $this->Html->css('jquery.jqplot.min');
        echo $this->Html->css('themes/base/jquery-ui');
        echo $this->Html->css('themes/base/jquery.ui.datepicker');
    ?>
    
    <!-- Scripts -->
    <?php
        echo $this->Html->script('jquery');
        echo $this->Html->script('jquery.jqplot.min');        
        echo $this->Html->script('plugins/jqplot.barRenderer.min.js');        
        echo $this->Html->script('plugins/jqplot.categoryAxisRenderer.min.js');
        echo $this->Html->script('plugins/jqplot.dateAxisRenderer.min.js');
        echo $this->Html->script('ui/jquery-ui');
        echo $this->Html->script('ui/jquery.ui.datepicker');
        echo $this->Html->script('foundation.min')
    ?>
    
    <!-- Google Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,200' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="large-12 columns">
                <?php echo $this->Session->flash(); ?>
            </div>
        </div>
        <?php echo $this->fetch('content'); ?>
        <div class="row" style="background-color: #000000; padding: 10px 0 10px 0;">
            <div class="large-5 columns large-offset-4" style="font-size: 0.8em; margin-top: 0.5em;">
                <p align="right" style="color: #ffffff;"><strong>&copy; 2013 - Aturdoku.com, <em>Development Team</em></strong></p>
                <p align="right" style="color: #ffffff;">Aturdoku adalah aplikasi proyek akhir mata kuliah Manajemen Proyek Sistem Informasi, Universitas Paramadina.</p>
            </div>
            <div class="large-3 columns" style="text-align: right">
                <?php echo $this->Html->image('white-logo.png'); ?>
            </div>
        </div>
    </div>
	<?php /* echo $this->element('sql_dump'); */ ?>
</body>
</html>
