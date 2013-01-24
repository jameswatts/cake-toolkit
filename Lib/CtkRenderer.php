<?php
/**
 * Base renderer class for rendering the view objects.
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
 * @package       Ctk.Lib
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkNode', 'Ctk.Lib');
App::uses('CtkView', 'Ctk.View');

/**
 * Abstract class for defining view renderers.
 *
 * @package       Ctk.Lib
 */
abstract class CtkRenderer extends CtkObject {

/**
 * The name of this renderer.
 *
 * @var string The name of the renderer.
 */
	protected $_name = null;

/**
 * The current view calling the renderer.
 *
 * @var CtkView The current view.
 */
	protected $_view = null;

/**
 * The node reference for the template.
 * 
 * @var CtkNode The node reference.
 */
	protected $_node = null;

/**
 * Contructor
 *
 * Creates a new renderer with a reference to the current view.
 * 
 * @param string $name The name of the renderer.
 * @param CtkView $view The current view.
 */
	final public function __construct($name, CtkView $view) {
		$this->_name = (string) $name;
		$this->_view = $view;
	}

/**
 * Abstract method used to render the view objects and return the generated content.
 * 
 * @param CtkObject $object The object being rendered.
 * @return string
 */
	abstract public function render(CtkObject $object);
}

