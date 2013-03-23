<!DOCTYPE html>
<html>
<head>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
</head>
<body>
	<div id="container">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->fetch('content'); ?>
    </div>
	<?php /* echo $this->element('sql_dump'); */ ?>
</body>
</html>
