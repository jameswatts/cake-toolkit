alert(<?php echo (isset($this->code))? $this->_prepareCode((string) $this->code) : '"' . str_replace('"', '\"', $this->text) . '"'; ?>)

