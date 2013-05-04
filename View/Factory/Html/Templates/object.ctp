<object id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('data', 'form', 'height', 'name', 'type', 'usemap', 'width')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->renderChildren(); ?>
</object>
<?php echo $this->parseEvents(); ?>
