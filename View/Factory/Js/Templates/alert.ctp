alert(<?php echo (isset($this->code))? $this->prepareCode((string) $this->code) : '"' . str_replace('"', '\"', $this->text) . '"'; ?>);
