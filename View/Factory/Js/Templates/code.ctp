(function(){var node=<?php echo (isset($this->node) && is_object($this->node) && $this->node instanceof CtkBuildable)? 'document.getElementById("' . $this->node->getId() . '")' : 'window'; ?>;return (function(){<?php echo $this->code; ?>}).apply(node,arguments);})()

