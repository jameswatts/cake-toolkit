<label id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('for', 'form')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->text; ?>
	<?php echo $this->renderChildren(); ?>
</label>
<?php echo $this->parseEvents(); ?>
