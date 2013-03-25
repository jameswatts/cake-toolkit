<th id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('colspan', 'headers', 'rowspan', 'scope')); ?><?php echo $this->parseClass(); ?>><?php echo (string) $this->text . $this->renderChildren(); ?></th>
<?php echo $this->parseEvents(); ?>
