(function(){<?php
foreach ($this->_elementActions as $action) {
	switch ($action[0]) {
		case 'back':
			echo 'if(history.length>1){history.back();}else{' . ((isset($action[1][0]))? 'location=' . $this->_resolveCode($action[1][0]) : 'history.go()') . ';}';
			break;
		case 'forward':
			echo 'history.forward();';
			break;
		case 'go':
			echo 'history.go(' . $this->_resolveCode($action[1][0]) . ');';
			break;
		case 'pushState':
			echo 'return history.pushState(' . $this->_resolveCode($action[1][0]) . ',' . $this->_resolveCode($action[1][1]) . ((isset($action[1][2]))? ',' . $this->_resolveCode($action[1][2]) : '') . ');';
			break;
		case 'replaceState':
			echo 'return history.replaceState(' . $this->_resolveCode($action[1][0]) . ',' . $this->_resolveCode($action[1][1]) . ((isset($action[1][2]))? ',' . $this->_resolveCode($action[1][2]) : '') . ');';
			break;
		case 'getLength':
			echo 'return history.length;';
			break;
		case 'getCurrent':
			echo 'return history.current;';
			break;
		case 'getPrevious':
			echo 'return history.previous;';
			break;
		case 'getNext':
			echo 'return history.next;';
			break;
		case 'getState':
			echo 'return history.state;';
			break;
	}
}
?>})()

