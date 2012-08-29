<!DOCTYPE html>
<html>
	<head>
		<?php echo $this->Html->charset(); ?>
		<title><?php echo $title_for_layout; ?></title>
		<?php echo $this->fetch('meta'); ?>
		<?php echo $this->fetch('css'); ?>
		<?php echo $this->fetch('script'); ?>
	</head>
	<body>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		<?php echo $this->element('sql_dump'); ?>
	</body>
</html>

