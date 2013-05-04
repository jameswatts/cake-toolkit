<textarea id="<?php echo $this->getId(); ?>"<?php echo $this->parseAttributes(array('autofocus', 'cols', 'disabled', 'form', 'maxlength', 'name', 'placeholder', 'readonly', 'required', 'rows', 'wrap')); ?><?php echo $this->parseClass(); ?>><?php echo (string) $this->text; ?></textarea>
<?php echo $this->parseEvents(); ?>
