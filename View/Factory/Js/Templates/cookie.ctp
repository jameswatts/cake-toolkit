(function(){<?php
foreach ($this->_elementActions as $action) {
	switch ($action[0]) {
		case 'isEnabled':
			echo 'return navigator.cookieEnabled;';
			break;
		case 'read':
			echo 'if(navigator.cookieEnabled){var name=' . $this->_resolveCode($action[1][0]) . '+"=",cookie=document.cookie;return (cookie.indexOf(name)!==-1)?cookie.substring(cookie.indexOf(name)+name.length).split(";",2)[0]:null;}else{return null;}';
			break;
		case 'write':
			echo 'if(navigator.cookieEnabled){document.cookie=' . $this->_resolveCode($action[1][0]) . '+"="+' . $this->_resolveCode($action[1][1]) . '+' . ((isset($action[1][2]) && !empty($action[1][2]))? '"; expires="+' . $this->_resolveCode($action[1][2]) : '""') . '+"; path="+' . ((isset($action[1][3]) && !empty($action[1][3]))? $this->_resolveCode($action[1][3]) : '"/"') . ';}';
			break;
	}
}
?>})()

