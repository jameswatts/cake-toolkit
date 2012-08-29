(function(){var node=document.getElementById("<?php echo $this->node->getId(); ?>");<?php
foreach ($this->_elementActions as $action) {
	switch ($action[0]) {
		case 'show':
			echo 'node.style.display="";node.style.visibility="visible";';
			break;
		case 'hide':
			echo 'node.style.display="none";node.style.visibility="hidden";';
			break;
		case 'toggle':
			echo 'node.style.display=(node.style.display=="none")?"":"none";node.style.visibility=(node.style.visibility=="hidden")?"visible":"hidden";';
			break;
		case 'addClass':
			echo 'if(node.className.indexOf("' . str_replace('"', '\"', $action[1][0]) . '")===-1){node.className+=" ' . str_replace('"', '\"', $action[1][0]) . '";}';
			break;
		case 'removeClass':
			echo 'if(node.className.indexOf("' . str_replace('"', '\"', $action[1][0]) . '")!==-1){node.className=node.className.replace("' . str_replace('"', '\"', $action[1][0]) . '","");}';
			break;
		case 'toggleClass':
			echo 'if(node.className.indexOf("' . str_replace('"', '\"', $action[1][0]) . '")===-1){node.className+=" ' . str_replace('"', '\"', $action[1][0]) . '";}else{node.className=node.className.replace("' . str_replace('"', '\"', $action[1][0]) . '","");}';
			break;
		case 'setAttribute':
			echo 'node.setAttribute("' . str_replace('"', '\"', $action[1][0]) . '","' . str_replace('"', '\"', $action[1][2]) . '");';
			break;
		case 'removeAttribute':
			echo 'node.removeAttribute("' . str_replace('"', '\"', $action[1][0]) . '");';
			break;
		case 'setStyle':
			echo 'node.style["' . str_replace('"', '\"', $action[1][0]) . '"]="' . str_replace('"', '\"', $action[1][1]) . '";';
			break;
	}
}
?>})();
