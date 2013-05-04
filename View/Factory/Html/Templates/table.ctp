<table id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('border')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->renderChildren(); ?>
</table>
<?php echo $this->parseEvents(); ?>
