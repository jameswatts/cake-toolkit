<?php
/**
 * Renderer for web content.
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

/**
 * Creates a renderer to generate the content.
 *
 * @package       Ctk.Lib
 */
class WebRenderer extends CtkRenderer {

/**
 * Renders the view objects and returns the generated content.
 * 
 * @param CtkObject $object The object being rendered.
 * @return string
 */
	public function render(CtkObject $object) {
		$path = dirname(__DIR__) . DS . 'Factory' . DS . $object->getFactory()->getName() . DS . 'Templates' . DS . $object->getTemplate() . '.ctp';
		return $object->load($path);
	}
}

