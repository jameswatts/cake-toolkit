(function(){<?php
$params = array();
if (isset($this->params) && is_array($this->params)) {
	foreach ($this->params as $key => $value) {
		$params[] = $key . '="+' . $this->_resolveCode($value) . '+"';
	}
}
echo 'var request=(window.XMLHttpRequest)?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP");';
if (isset($this->method) && is_string($this->method) && strtolower($this->method) === 'post') {
	echo 'request.open("post",' . $this->_resolveCode($this->url) . ',' . ((isset($this->async) && $this->async)? 'true' : 'false') . ',' . $this->_resolveCode($this->username) . ',' . $this->_resolveCode($this->password) . ');request.setRequestHeader("Content-type","application/x-www-form-urlencoded");';
} else {
	$url = $this->_resolveCode($this->url) . '+""' . ((count($params))? ' + "' . ((strstr($this->url, '?'))? '&' : '?') . implode('&', $params) . '"' : '');
	echo 'request.open("get",' . $url . ',' . ((isset($this->async) && $this->async)? 'true' : 'false') . ',' . $this->_resolveCode($this->username) . ',' . $this->_resolveCode($this->password) . ');';
}
echo 'request.onreadystatechange=function(e){if(request.readyState===4&&request.status===200){(function(){' . $this->code . '}).call(request);}};request.send(' . ((count($params))? '"' . implode('&', $params) . '"' : 'null') . ');';
?>})();
