<ol id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('reversed', 'start', 'type')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->renderChildren(); ?>
</ol>
<?php echo $this->parseEvents(); ?>
