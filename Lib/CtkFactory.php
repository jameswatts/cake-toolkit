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

App::uses('Set', 'Utility');
App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkView', 'Ctk.View');

/**
 * Abstract class for defining view object factories.
 *
 * @package       Ctk.Lib
 */
abstract class CtkFactory extends CtkObject {

/**
 * Settings for this factory.
 *
 * @var array
 */
	public $settings = array();

/**
 * The current view calling the factory.
 *
 * @var CtkView The current view.
 */
	protected $_view = null;

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
 * Contructor
 *
 * Creates a new factory with a reference to the current view.
 * 
 * @param CtkView $view The current view.
 * @param string $name The name of the factory.
 * @param string $plugin The name of the plugin if it exists.
 * @param array $settings Configuration settings for the factory.
 */
	final public function __construct(CtkView $view, $name, $plugin = null, $settings = null) {
		$this->_view = $view;
		$this->_name = (string) $name;
		$this->_plugin = (string) $plugin;
		if ($settings) {
			$this->settings = Set::merge($this->settings, (array) $settings);
		}
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
 * Returns the view object for this factory.
 * 
 * @return CtkView
 */
	final public function getView() {
		return $this->_view;
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
 * Abstract method used to setup additional resources for the factory.
 * 
 * @return void
 */
	abstract public function setup();
}

