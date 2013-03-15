(function(){var node=document.getElementById("<?php echo $this->node->getId(); ?>");<?php
foreach ($this->_elementActions as $action) {
	switch ($action[0]) {
		case 'show':
			echo 'node.style.display="";';
			break;
		case 'hide':
			echo 'node.style.display="none";';
			break;
		case 'toggle':
			echo 'node.style.display=(node.style.display=="")?"none":"";';
			break;
		case 'addClass':
			echo 'if(node.className.indexOf(' . $this->_resolveCode($action[1][0]) . ')===-1){node.className+=" "+' . $this->_resolveCode($action[1][0]) . ';}';
			break;
		case 'removeClass':
			echo 'if(node.className.indexOf(' . $this->_resolveCode($action[1][0]) . ')!==-1){node.className=node.className.replace(' . $this->_resolveCode($action[1][0]) . ',"");}';
			break;
		case 'toggleClass':
			echo 'if(node.className.indexOf(' . $this->_resolveCode($action[1][0]) . ')===-1){node.className+=" "+' . $this->_resolveCode($action[1][0]) . ';}else{node.className=node.className.replace(' . $this->_resolveCode($action[1][0]) . ',"");}';
			break;
		case 'setAttribute':
			echo 'node.setAttribute(' . $this->_resolveCode($action[1][0]) . ',' . $this->_resolveCode($action[1][1]) . ');';
			break;
		case 'removeAttribute':
			echo 'node.removeAttribute(' . $this->_resolveCode($action[1][0]) . ');';
			break;
		case 'toggleAttribute':
			echo 'if(node.hasAttribute(' . $this->_resolveCode($action[1][0]) . ')){node.removeAttribute(' . $this->_resolveCode($action[1][0]) . ');}else{node.setAttribute(' . $this->_resolveCode($action[1][0]) . ',' . $this->_resolveCode($action[1][1]) . ');}';
			break;
		case 'getStyle':
			echo 'return node.style[' . $this->_resolveCode($action[1][0]) . '];';
			break;
		case 'setStyle':
			echo 'node.style[' . $this->_resolveCode($action[1][0]) . ']=' . $this->_resolveCode($action[1][1]) . ';';
			break;
		case 'getText':
			echo 'return node.innerHTML;';
			break;
		case 'setText':
			echo 'node.innerHTML=' . $this->_resolveCode($action[1][0]) . ';';
			break;
		case 'ajax':
			$params = array();
			if (isset($action[1][1]) && is_array($action[1][1])) {
				foreach ($action[1][1] as $key => $value) {
					$params[] = $key . '="+' . $this->_resolveCode($value) . '+"';
				}
			}
			echo 'var request=(window.XMLHttpRequest)?new XMLHttpRequest():new ActiveXObject("Microsoft.XMLHTTP");';
			if (isset($action[1][2]) && is_string($action[1][2]) && strtolower($action[1][2]) === 'post') {
				echo 'request.open("post",' . $this->_resolveCode($action[1][0]) . ',true,' . ((isset($action[1][3]))? $this->_resolveCode($action[1][3]) : '""') . ',' . ((isset($action[1][4]))? $this->_resolveCode($action[1][4]) : '""') . ');request.setRequestHeader("Content-type","application/x-www-form-urlencoded");';
			} else {
				if (isset($action[1][0])) {
					$url = $this->_resolveCode($action[1][0]) . '+""' . ((count($params))? ' + "' . ((strstr($action[1][0], '?'))? '&' : '?') . implode('&', $params) . '"' : '');
				} else {
					$url = '"/' . ((count($params))? ((strstr($action[1][0], '?'))? '&' : '?') . implode('&', $params) : '') . '"';
				}
				echo 'request.open("get",' . $url . ',true,' . ((isset($action[1][3]))? $this->_resolveCode($action[1][3]) : '""') . ',' . ((isset($action[1][4]))? $this->_resolveCode($action[1][4]) : '""') . ');';
			}
			echo 'request.onreadystatechange=function(e){if(request.readyState===4&&request.status===200){node.innerHTML=request.responseText;}};request.send(' . ((count($params))? '"' . implode('&', $params) . '"' : 'null') . ');';
			break;
	}
}
?>})()

