<form id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('accept-charset', 'action', 'autocomplete', 'enctype', 'method', 'name', 'novalidate', 'target')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->renderChildren(); ?>
</form>
<?php echo $this->parseEvents(); ?>
