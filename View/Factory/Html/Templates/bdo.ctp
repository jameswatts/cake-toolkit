<bdo id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('dir')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->text; ?>
	<?php echo $this->renderChildren(); ?>
</bdo>
<?php echo $this->parseEvents(); ?>
