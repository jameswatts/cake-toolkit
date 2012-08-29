<td id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('colspan', 'headers', 'rowspan')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->text; ?>
	<?php echo $this->renderChildren(); ?>
</td>
<?php echo $this->parseEvents(); ?>
