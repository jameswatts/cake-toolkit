<button id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->value; ?>
	<?php echo $this->renderChildren(); ?>
</button>
<?php echo $this->parseEvents(); ?>
