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

App::uses('CtkBindable', 'Ctk.Lib');
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
 * The name of this object.
 *
 * @var string The name of the object.
 */
	protected $_name = null;

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
 * The validation rules for configuration parameters, where the key is the parameter 
 * name and the value the rule as a string or an array.
 *
 * @var array The validation rules.
 */
	protected $_validate = array();

/**
 * The internal cache of validation sets used to validate parameters.
 *
 * @var array The validation sets.
 */
	protected $_validation = array();

/**
 * The errors logged from an invalid configuration parameter.
 *
 * @var array The validation errors.
 */
	protected $_validationErrors = array();

/**
 * Contructor
 *
 * Creates a new event with optional template configuration parameters.
 * 
 * @param CtkFactory $factory The factory that created the event.
 * @param array $params The optional configuration parameters for the template.
 */
	final public function __construct(CtkFactory $factory, array $params = array()) {
		parent::__construct();
		$this->_factory = $factory;
		$this->_name = str_replace($factory->getName(), '', get_class($this));
		$this->_inheritArrayProperties(array('_params', '_validate'));
		$this->setParams($params);
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
		if (isset($this->_validate[(string) $name])) {
			if (!$this->validateParam($name, $value)) {
				throw new CakeException(sprintf('Value of "%s" parameter for %s is invalid, ' . implode(', ', $this->_validationErrors), $name, get_class($this)));
			}
		}
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
		try {
			return $this->render();
		} catch(Exception $e) {
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
	}

/**
 * Returns the name of the object.
 *
 * @return string
 */
	final public function getName() {
		return $this->_name;
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
 * Sets additional configuration parameters for the template.
 *
 * @param array $params The configuration paramaters.
 * @return CtkBuildable
 */
	final public function setParams(array $params = array()) {
		foreach ($params as $name => $value) {
			$this->__set((string) $name, $value);
		}
		return $this;
	}

/**
 * Validates the configuration parameter.
 *
 * @param string $name Name of the configuration parameter.
 * @param mixed $value Value of the configuration parameter.
 * @return boolean
 */
	final public function validateParam($name, $value = null) {
		if (isset($this->_validate[$name])) {
			if (!isset($this->_validation[$name])) {
				$this->_validation[$name] = new CakeValidationSet($name, $this->_validate[$name]);
			}
			$errors = $this->_validation[$name]->validate(array($name => $value));
			if (count($errors) > 0) {
				foreach ($errors as $error) {
					$this->_validationErrors[] = str_replace('field', 'parameter', lcfirst($error));
				}
				return false;
			}
		}
		return true;
	}

/**
 * Binds the event to the specified node.
 *
 * @param string $type The event type.
 * @param CtkBindable $node The node to bind to.
 * @return CtkEvent
 */
	final public function bindTo($type, CtkBindable $node) {
		$node->bind($type, $this);
		return $this;
	}

/**
 * Parses the template for the event.
 *
 * @param string $path Path to the template.
 * @return string
 * @throws CakeException if template is not found.
 */
	final public function template($path) {
		if (!is_string($path)) {
			throw new CakeException('Template path must be a string');
		}
		if (is_file($path) && is_readable($path)) {
			ob_start();
			require $path;
			return ob_get_clean();
		}
		throw new CakeException(sprintf('Template not found: %s', $path));
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

