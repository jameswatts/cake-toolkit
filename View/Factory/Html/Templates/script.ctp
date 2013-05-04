<script type="<?php echo $this->type; ?>"<?php echo (isset($this->src))? ' src="' . $this->src . '"' : ''; ?>><?php echo (!isset($this->src) && isset($this->code))? $this->code : ''; ?></script>
