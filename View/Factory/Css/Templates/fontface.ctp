@font-face {
	src: <?php echo $this->src; ?>;
	font-family: <?php echo $this->family; ?>;
	font-weight: <?php echo $this->weight; ?>;
	font-style: <?php echo $this->style; ?>;
	font-stretch: <?php echo $this->stretch; ?>;
	<?php if (isset($this->unicode)): ?>
	unicode-range: <?php echo $this->unicode; ?>;
	<?php endif; ?>
}

