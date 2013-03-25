<em id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(); ?><?php echo $this->parseClass(); ?>><?php echo (string) $this->text . $this->renderChildren(); ?></em>
<?php echo $this->parseEvents(); ?>
