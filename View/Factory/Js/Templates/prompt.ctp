(function(){var input=prompt(<?php echo (isset($this->code))? $this->_prepareCode((string) $this->code) : '"' . str_replace('"', '\"', $this->text) . '"'; ?>);(input)?(function(){<?php echo $this->input; ?>})():(function(){<?php echo $this->cancel; ?>})();})()

