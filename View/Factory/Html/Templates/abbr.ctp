<abbr id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('title')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->text; ?>
	<?php echo $this->renderChildren(); ?>
</abbr>
<?php echo $this->parseEvents(); ?>
