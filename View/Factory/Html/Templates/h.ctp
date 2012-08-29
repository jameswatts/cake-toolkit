<h<?php echo $this->size; ?> id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->text; ?>
	<?php echo $this->renderChildren(); ?>
</h<?php echo $this->size; ?>>
<?php echo $this->parseEvents(); ?>
