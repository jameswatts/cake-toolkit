<?php
/**
 * Base class for a JavaScript DOM element.
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
 * Class representing a JavaScript DOM element.
 *
 * @package       Ctk.Factory
 */
class JsElement extends JsEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'element';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'node' => null
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'element';

/**
 * The actions to use when constructing the template.
 *
 * @var array The collection of actions.
 */
	protected $_elementActions = array();

/**
 * Shows the element.
 *
 * @return JsElement
 */
	public function show() {
		$this->_elementActions[] = array('show');
		return $this;
	}

/**
 * Hides the element.
 *
 * @return JsElement
 */
	public function hide() {
		$this->_elementActions[] = array('hide');
		return $this;
	}

/**
 * Toggles the element between visible and hidden.
 *
 * @return JsElement
 */
	public function toggle() {
		$this->_elementActions[] = array('toggle');
		return $this;
	}

/**
 * Adds a class to the element.
 *
 * @param string $class The class name to add.
 * @return JsElement
 */
	public function addClass($class) {
		$this->_elementActions[] = array('addClass', func_get_args());
		return $this;
	}

/**
 * Removes a class from the element.
 *
 * @param string $class The class name to remove.
 * @return JsElement
 */
	public function removeClass($class) {
		$this->_elementActions[] = array('removeClass', func_get_args());
		return $this;
	}

/**
 * Toggles the class of the element.
 *
 * @param string $class The class name to toggle.
 * @return JsElement
 */
	public function toggleClass($class) {
		$this->_elementActions[] = array('toggleClass', func_get_args());
		return $this;
	}

/**
 * Sets an attribute on the element.
 *
 * @param string $name The name of the attribute.
 * @param mixed $value The value of the attribute.
 * @return JsElement
 */
	public function setAttribute($name, $value) {
		$this->_elementActions[] = array('setAttribute', func_get_args());
		return $this;
	}

/**
 * Removes an attribute from the element.
 *
 * @param string $name The name of the attribute.
 * @return JsElement
 */
	public function removeAttribute($name) {
		$this->_elementActions[] = array('removeAttribute', func_get_args());
		return $this;
	}

/**
 * Toggles the attribute of the element.
 *
 * @param string $name The attribute name to toggle.
 * @return JsElement
 */
	public function toggleAttribute($name) {
		$this->_elementActions[] = array('toggleAttribute', func_get_args());
		return $this;
	}

/**
 * Gets the value of a style property on the element.
 *
 * @param string $property The name of the style property.
 * @return JsElement
 */
	public function getStyle($property) {
		$this->_elementActions[] = array('getStyle', func_get_args());
		return $this;
	}

/**
 * Sets the value of a style property on the element.
 *
 * @param string $property The name of the style property.
 * @param string $value The value of the style property.
 * @return JsElement
 */
	public function setStyle($property, $value) {
		$this->_elementActions[] = array('setStyle', func_get_args());
		return $this;
	}

/**
 * Gets the innerHTML of the element.
 *
 * @return JsElement
 */
	public function getText() {
		$this->_elementActions[] = array('getText', func_get_args());
		return $this;
	}

/**
 * Sets the innerHTML of the element.
 *
 * @param string $text The text to set in the element.
 * @return JsElement
 */
	public function setText($text) {
		$this->_elementActions[] = array('setText', func_get_args());
		return $this;
	}

/**
 * Loads content via Ajax.
 *
 * @param string $url The URL to load from.
 * @param array $params The optional params to send.
 * @param string $method The HTTP method to use, defaults to GET.
 * @param string $username The optional username.
 * @param string $password The optional password.
 * @return JsElement
 */
	public function ajax($url = '/', array $params = array(), $method = 'get', $username = null, $password = null) {
		$this->_elementActions[] = array('ajax', func_get_args());
		return $this;
	}
}

