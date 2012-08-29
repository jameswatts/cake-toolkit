<<?php echo $this->name; ?><?php echo $this->parseAttributes(); ?>>
	<?php
	if (isset($this->value)) {
		if ($this->cdata) {
			echo '<![CDATA[' . $this->value . ']]>';
		} else {
			echo htmlentities($this->value);
		}
	}
	?>
	<?php echo $this->renderChildren(); ?>
</<?php echo $this->name; ?>>
