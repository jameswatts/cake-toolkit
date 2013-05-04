<fieldset id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('disabled', 'form', 'name')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->renderChildren(); ?>
</fieldset>
<?php echo $this->parseEvents(); ?>
