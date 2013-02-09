<?php
/**
 * Renderer for the internal CTK schema.
 *
 * PHP 5
 *
 * Cake Toolkit (http://caketoolkit.org)
 * Copyright 2012, James Watts (http://github.com/jameswatts)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2012, James Watts (http://github.com/jameswatts)
 * @link          http://caketoolkit.org Cake Toolkit
 * @package       Ctk.View.Renderer
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkRenderer', 'Ctk.Lib');
App::uses('CtkBuildable', 'Ctk.Lib');
App::uses('CtkNode', 'Ctk.Lib');

/**
 * Creates a renderer to generate a schema based on the CTK object model.
 *
 * @package       Ctk.Lib
 */
class SchemaRenderer extends CtkRenderer {

/**
 * Renders the params as attributes of a node.
 * 
 * @param CtkObject $object The object being rendered.
 * @return string
 */
	protected function _renderAttributes(CtkObject $object) {
		$plugin = $object->getFactory()->getPlugin();
		$attributes = '';
		if (!empty($plugin)) {
			$attributes .= ' plugin="' . $plugin . '"';
		}
		$attributes .= ' template="' . $object->getTemplate() . '"';
		if ($object instanceof CtkNode) {
			$params = $object->getParams();
			foreach ($params as $param => $value) {
				$attributes .= ' ' . $param . '="' . str_replace('"', '\"', $value) . '"';
			}
		}
		return $attributes;
	}

/**
 * Renders the view objects as nodes in an abstract schema.
 * 
 * @param CtkObject $object The object being rendered.
 * @return string
 */
	public function render(CtkObject $object) {
		$baseView = $this->_view->getBaseView();
		$baseView->response->type('text/xml');
		$baseView->response->charset('UTF-8');
		$baseView->layout = 'Ctk.Xml/schema';
		$factory = $object->getFactory()->getName();
		$class = str_replace($factory, '', get_class($object));
		if ($object instanceof CtkBuildable && $object->hasChildren()) {
			$node  = '<' . $factory . ':' . $class . $this->_renderAttributes($object) . '>';
			$node .= $object->renderChildren();
			return $node . '</' . $factory . ':' . $class . '>';
		} else {
			return '<' . $factory . ':' . $class . $this->_renderAttributes($object) . '/>';
		}
	}
}

