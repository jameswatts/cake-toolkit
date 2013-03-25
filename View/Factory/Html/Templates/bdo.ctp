<bdo id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('dir')); ?><?php echo $this->parseClass(); ?>><?php echo (string) $this->text . $this->renderChildren(); ?></bdo>
<?php echo $this->parseEvents(); ?>
