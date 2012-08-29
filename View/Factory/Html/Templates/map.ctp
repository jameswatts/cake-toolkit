<map id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('name')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->renderChildren(); ?>
</map>
<?php echo $this->parseEvents(); ?>
