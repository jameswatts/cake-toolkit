(function(){<?php
foreach ($this->_elementActions as $action) {
	switch ($action[0]) {
		case 'getAppCodeName':
			echo 'return navigator.appCodeName;';
			break;
		case 'getAppName':
			echo 'return navigator.appName;';
			break;
		case 'getAppVersion':
			echo 'return navigator.appVersion;';
			break;
		case 'isCookieEnabled':
			echo 'return navigator.cookieEnabled;';
			break;
		case 'getPlatform':
			echo 'return navigator.platform;';
			break;
		case 'getProduct':
			echo 'return navigator.product;';
			break;
		case 'getProductSub':
			echo 'return navigator.productSub;';
			break;
		case 'getUserAgent':
			echo 'return navigator.userAgent;';
			break;
		case 'getVendor':
			echo 'return navigator.vendor;';
			break;
		case 'getVendorSub':
			echo 'return navigator.vendorSub;';
			break;
	}
}
?>})()

