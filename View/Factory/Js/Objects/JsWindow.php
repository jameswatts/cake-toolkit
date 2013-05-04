<?php
/**
 * Base class for the window object.
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
 * @package       Ctk.View.Factory.Js.Objects
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkBuildable', 'Ctk.Lib');
App::uses('JsEvent', 'Ctk.View/Factory/Js/Objects');

/**
 * Class representing the window object.
 *
 * @package       Ctk.Factory
 */
class JsWindow extends JsEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'window';

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'window';

/**
 * The actions to use when constructing the template.
 *
 * @var array The collection of actions.
 */
	protected $_elementActions = array();

/**
 * Gets the name of the window.
 *
 * @return JsWindow
 */
	public function getName() {
		$this->_elementActions[] = array('getName');
		return $this;
	}

/**
 * Gets the closed state of the window.
 *
 * @return JsWindow
 */
	public function isClosed() {
		$this->_elementActions[] = array('isClosed');
		return $this;
	}

/**
 * Gets the document object for the window.
 *
 * @return JsDocument
 */
	public function getDocument() {
		return $this->getFactory()->Document();
	}

/**
 * Gets the location object for the window.
 *
 * @return JsLocation
 */
	public function getLocation() {
		return $this->getFactory()->Location();
	}

/**
 * Gets the navigator object for the window.
 *
 * @return JsNavigator
 */
	public function getNavigator() {
		return $this->getFactory()->Navigator();
	}
}

