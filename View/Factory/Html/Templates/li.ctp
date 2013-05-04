<li id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('value')); ?><?php echo $this->parseClass(); ?>><?php echo (string) $this->text . $this->renderChildren(); ?></li>
<?php echo $this->parseEvents(); ?>
