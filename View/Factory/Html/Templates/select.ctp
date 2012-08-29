<select id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('autofocus', 'disabled', 'form', 'multiple', 'name', 'size')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->renderChildren(); ?>
</select>
<?php echo $this->parseEvents(); ?>
