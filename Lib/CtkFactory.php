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
App::uses('HelperCollection', 'View');
App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkView', 'Ctk.View');
App::uses('CtkHelper', 'Ctk.View');

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
 * An array of names of element factories to include.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $factories = array();

/**
 * An array containing the names of helpers this factory uses.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $helpers = array();

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
 * Sub-factories defined to use in this factory.
 *
 * @var array
 */
	protected $_factories = array();

/**
 * The helpers available.
 *
 * @var array
 */
	protected $_helpers = array();

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
		parent::__construct();
		$this->_view = $view;
		$this->_name = (string) $name;
		$this->_plugin = (string) $plugin;
		if ($settings) {
			$this->settings = Set::merge($this->settings, (array) $settings);
		}
		$this->_inheritArrayProperties(array('factories', 'helpers'));
		$this->_factories = (empty($this->factories))? array() : Set::normalize((array) $this->factories);
		foreach ($this->_factories as $key => $value) {
			$isAlias = (is_array($value) && isset($value['className']));
			list($plugin, $name) = pluginSplit(($isAlias)? $value['className'] : $key);
			$class = $name . 'Factory';
			App::uses($class, ((!empty($plugin))? $plugin . '.' : '') . 'View/Factory');
			if (!class_exists($class)) {
				throw new CakeException(sprintf('Unknown factory: %s', $class));
			}
			$property = ($isAlias)? $key : $name;
			$this->$property = new $class($this->_view, $name, $plugin, $value);
			$this->$property->setup();
		}
		$helpers = HelperCollection::normalizeObjectArray((empty($this->helpers))? array() : Set::normalize((array) $this->helpers));
		$helperCollection = new HelperCollection($this->_view->getBaseView());
		foreach ($helpers as $name => $properties) {
			list($plugin, $class) = pluginSplit($properties['class']);
			$this->_helpers[$class] = new CtkHelper($class, $helperCollection->load($properties['class'], $properties['settings']), $this->_view);
		}
	}

/**
 * Returns a helper or setting from the factory.
 *
 * @param string $name Name of helper or setting.
 * @return mixed
 * @throws CakeException if the helper or setting is not found.
 */
	final public function __get($name) {
		if (isset($this->_helpers[(string) $name])) {
			return $this->_helpers[(string) $name];
		}
		if (isset($this->settings[(string) $name])) {
			return $this->settings[(string) $name];
		}
		throw new CakeException(sprintf('Unknown helper or setting: %s', $name));
	}

/**
 * Adds a sub-factory to this factory.
 *
 * @param string $name Name of the factory.
 * @param CtkFactory $factory The factory object.
 * @throws CakeException if factory has not been previously included.
 */
	final public function __set($name, $factory) {
		if (is_object($factory) && $factory instanceof CtkFactory) {
			$this->$name = $factory;
		} else {
			throw new CakeException(sprintf('Invalid factory: %s', $name));
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
 * Returns the sub-factories used by this factory.
 *
 * @return array
 */
	final public function getFactories() {
		return $this->_factories;
	}

/**
 * Returns the helpers used by this factory.
 *
 * @return array
 */
	final public function getHelpers() {
		return $this->_helpers;
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

