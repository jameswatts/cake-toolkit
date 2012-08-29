(function(){<?php
foreach ($this->_elementActions as $action) {
	switch ($action[0]) {
		case 'getUrl':
			echo 'return document.URL;';
			break;
		case 'getDomain':
			echo 'return document.domain;';
			break;
		case 'getTitle':
			echo 'return document.title;';
			break;
	}
}
?>})();
