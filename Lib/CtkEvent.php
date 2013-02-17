<?php
/**
 * Base node object for defining events.
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

App::uses('CtkRenderable', 'Ctk.Lib');
App::uses('CtkObject', 'Ctk.Lib');

/**
 * Abstract class representing an event.
 *
 * @package       Ctk.Lib
 */
abstract class CtkEvent extends CtkObject implements CtkRenderable {

/**
 * The factory used to instanciate this event.
 *
 * @var CtkFactory The instance of the factory.
 */
	protected $_factory = null;

/**
 * The template to use for this event.
 *
 * @var string The name of the template.
 */
	protected $_template = null;

/**
 * The configuration parameters used by the template for this event.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array();

/**
 * Contructor
 *
 * Creates a new event with optional template configuration parameters.
 * 
 * @param CtkFactory $factory The factory that created the event.
 * @param array $params The optional configuration parameters for the template.
 */
	final public function __construct(CtkFactory $factory, array $params = array()) {
		$this->_factory = $factory;
		foreach ($params as $name => $value) {
			$this->_params[(string) $name] = $value;
		}
	}

/**
 * Returns a view variable from the controller.
 *
 * @param string $name Name of view variable.
 * @return string
 * @throws CakeException if view variable is not found.
 */
	final public function __get($name) {
		if (isset($this->_params[(string) $name])) {
			return $this->_params[(string) $name];
		} else {
			throw new CakeException(sprintf('Undefined param: %s', $name));
		}
	}

/**
 * Returns a view variable from the controller.
 *
 * @param string $name Name of view variable.
 * @return string
 * @throws CakeException if view variable is not found.
 */
	final public function __set($name, $value = null) {
		$this->_params[(string) $name] = $value;
	}

/**
 * Determines if a configuration parameter has been defined.
 *
 * @param string $name Name of the configuration parameter.
 * @return mixed
 */
	final public function __isset($name) {
		return (isset($this->_params[(string) $name]));
	}

/**
 * Renders the event if called as a string.
 *
 * @return string
 */
	final public function __toString() {
		return $this->render();
	}

/**
 * Returns the factory which created the event.
 *
 * @return CtkFactory
 */
	final public function getFactory() {
		return $this->_factory;
	}

/**
 * Returns the name of the template for the event.
 *
 * @return string
 */
	final public function getTemplate() {
		return $this->_template;
	}

/**
 * Returns the configuration parameters for the template.
 *
 * @return array
 */
	final public function getParams() {
		return $this->_params;
	}

/**
 * Loads the template for the event.
 *
 * @param string $path Path to the template.
 * @return string
 * @throws CakeException if template is not found.
 */
	final public function load($path) {
		if (is_file($path) && is_readable($path)) {
			ob_start();
			require $path;
			return ob_get_clean();
		} else {
			throw new CakeException(sprintf('Template not found: %s', $path));
		}
	}

/**
 * Renders the event using the the view renderer.
 *
 * @return string
 */
	final public function render() {
		return $this->_factory->getView()->getRenderer()->render($this);
	}

/**
 * Renders the child nodes of this event.
 *
 * @return string
 */
	final public function renderChildren() {
		return '';
	}
}

