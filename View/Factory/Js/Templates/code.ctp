(function(){var node=<?php echo (isset($this->node) && is_object($this->node) && $this->node instanceof CtkBuildable)? 'document.getElementById("' . $this->node->getId() . '")' : 'window'; ?>;return (function(){<?php echo (isset($this->code) && is_array($this->code))? implode(';', $this->code) : $this->code; ?>}).apply(node,arguments);})()

