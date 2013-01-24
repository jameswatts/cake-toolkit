<?php
/**
 * Base factory class for view objects.
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
App::uses('CtkView', 'Ctk.View');

/**
 * Abstract class for defining view object factories.
 *
 * @package       Ctk.Lib
 */
abstract class CtkFactory extends CtkObject {

/**
 * The name of this factory.
 *
 * @var string The name of the factory.
 */
	protected $_name = null;

/**
 * The plugin for this factory.
 *
 * @var string The plugin for the factory.
 */
	protected $_plugin = null;

/**
 * The current view calling the factory.
 *
 * @var CtkView The current view.
 */
	protected $_view = null;

/**
 * Contructor
 *
 * Creates a new factory with a reference to the current view.
 * 
 * @param string $name The name of the factory.
 * @param CtkView $view The current view.
 */
	final public function __construct($name, $plugin, CtkView $view) {
		$this->_name = (string) $name;
		$this->_plugin = (string) $plugin;
		$this->_view = $view;
	}

/**
 * Returns a new instance of the given object name.
 *
 * @param string $name Name of object to create.
 * @param array $arguments The method arguments.
 * @return CtkNode
 * @throws CakeException if object class is not found.
 */
	final public function __call($name, $arguments) {
		$class = $this->_name . $name;
		App::uses($class, ((!empty($this->_plugin))? $this->_plugin . '.' : '') . 'View/Factory/' . $this->_name . '/Objects/');
		if (!class_exists($class)) {
			throw new CakeException(sprintf('Unknown object: %s', $class));
		}
		return new $class($this, (count($arguments) > 0)? (array) $arguments[0] : array());
	}

/**
 * Returns the name of the current factory.
 * 
 * @return string
 */
	final public function getName() {
		return $this->_name;
	}

/**
 * Returns the plugin for the current factory.
 * 
 * @return string
 */
	final public function getPlugin() {
		return $this->_plugin;
	}

/**
 * Returns the view object for this factory.
 * 
 * @return CtkView
 */
	final public function getView() {
		return $this->_view;
	}

/**
 * Abstract method used to setup additional resources for the factory.
 * 
 * @return void
 */
	abstract public function setup();
}

