<button id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(); ?><?php echo $this->parseClass(); ?>><?php echo (string) $this->value . $this->renderChildren(); ?></button>
<?php echo $this->parseEvents(); ?>
