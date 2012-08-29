<th id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('colspan', 'headers', 'rowspan', 'scope')); ?><?php echo $this->parseClass(); ?>>
	<?php echo $this->text; ?>
	<?php echo $this->renderChildren(); ?>
</th>
<?php echo $this->parseEvents(); ?>
