(function(){var node=<?php echo (isset($this->node) && is_object($this->node) && $this->node instanceof CtkBuildable)? 'document.getElementById("' . $this->node->getId() . '")' : 'window'; ?>,callback=function(){<?php echo $this->code; ?>};return function(){return callback.apply(node,arguments);}})()

