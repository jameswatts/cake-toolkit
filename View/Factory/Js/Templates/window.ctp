(function(){<?php
foreach ($this->_elementActions as $action) {
	switch ($action[0]) {
		case 'getName':
			echo 'return window.name;';
			break;
		case 'isClosed':
			echo 'return window.closed;';
			break;
	}
}
?>})();
