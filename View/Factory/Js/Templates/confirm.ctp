(confirm(<?php echo (isset($this->code))? $this->_prepareCode((string) $this->code) : '"' . str_replace('"', '\"', $this->text) . '"'; ?>))?(function(){<?php echo $this->ok; ?>})():(function(){<?php echo $this->cancel; ?>})()

