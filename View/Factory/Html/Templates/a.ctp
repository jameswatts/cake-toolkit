<a id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('href', 'hreflang', 'media', 'rel', 'target', 'title', 'type')); ?><?php echo $this->parseClass(); ?>><?php echo (string) $this->text . $this->renderChildren(); ?></a>
<?php echo $this->parseEvents(); ?>
