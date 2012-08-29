<small id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->text; ?>
	<?php echo $this->renderChildren(); ?>
</small>
<?php echo $this->parseEvents(); ?>
