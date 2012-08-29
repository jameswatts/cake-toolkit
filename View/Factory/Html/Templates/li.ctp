<li id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('value')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->text; ?>
	<?php echo $this->renderChildren(); ?>
</li>
<?php echo $this->parseEvents(); ?>
