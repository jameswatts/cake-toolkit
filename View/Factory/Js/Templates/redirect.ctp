(function(){<?php echo (isset($this->timeout) && is_int($this->timeout))? 'setTimeout(function(){location=' . $this->_resolveCode($this->location) . ';},' . $this->timeout . ')' : 'location=' . $this->_resolveCode($this->location); ?>;})()

