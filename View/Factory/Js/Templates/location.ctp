(function(){<?php
foreach ($this->_elementActions as $action) {
	switch ($action[0]) {
		case 'getHash':
			echo 'return document.location.hash;';
			break;
		case 'getHostname':
			echo 'return document.location.hostname;';
			break;
		case 'getHref':
			echo 'return document.location.href;';
			break;
		case 'getPathname':
			echo 'return document.location.pathname;';
			break;
		case 'getPort':
			echo 'return document.location.port;';
			break;
		case 'getProtocol':
			echo 'return document.location.protocol;';
			break;
		case 'getSearch':
			echo 'return document.location.search;';
			break;
	}
}
?>})();
