<?php
/**
 * Base class for handling cookies.
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

App::uses('JsEvent', 'Ctk.View/Factory/Js/Objects');

/**
 * Class representing the cookie object.
 *
 * @package       Ctk.Factory
 */
class JsCookie extends JsEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'cookie';

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'cookie';

/**
 * The actions to use when constructing the template.
 *
 * @var array The collection of actions.
 */
	protected $_elementActions = array();

/**
 * Determines if cookies are enabled.
 *
 * @return JsCookie
 */
	public function isEnabled() {
		$this->_elementActions[] = array('isEnabled');
		return $this;
	}

/**
 * Reads a value from the cookie.
 *
 * @param string $name The cookie name.
 * @return JsCookie
 */
	public function read($name) {
		$this->_elementActions[] = array('read', func_get_args());
		return $this;
	}

/**
 * Writes a value to the cookie.
 *
 * @param string $name The cookie name.
 * @param mixed $value The cookie value.
 * @param string $expires The optional expires date.
 * @param string $path The optional path, defaults to "/".
 * @return JsCookie
 */
	public function write($name, $value, $expires = null, $path = null) {
		$this->_elementActions[] = array('write', func_get_args());
		return $this;
	}
}

