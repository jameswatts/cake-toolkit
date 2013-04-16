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

App::uses('CtkLoadable', 'Ctk.Lib');
App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkNode', 'Ctk.Lib');
App::uses('CtkView', 'Ctk.View');

/**
 * Abstract class for defining view renderers.
 *
 * @package       Ctk.Lib
 */
abstract class CtkRenderer extends CtkObject implements CtkLoadable {

/**
 * Settings for this renderer.
 *
 * @var array
 */
	public $settings = array();

/**
 * The current view calling the renderer.
 *
 * @var CtkView The current view.
 */
	protected $_view = null;

/**
 * The name of this renderer.
 *
 * @var string The name of the renderer.
 */
	protected $_name = null;

/**
 * The plugin for this renderer.
 *
 * @var string The plugin for the renderer.
 */
	protected $_plugin = null;

/**
 * Contructor
 *
 * Creates a new renderer with a reference to the current view.
 * 
 * @param CtkView $view The current view.
 * @param string $name The name of the renderer.
 * @param string $plugin The name of the plugin if it exists.
 * @param array $settings Configuration settings for the renderer.
 */
	final public function __construct(CtkView $view, $name, $plugin = null, $settings = null) {
		parent::__construct();
		$this->_view = $view;
		$this->_name = (string) $name;
		$this->_plugin = (string) $plugin;
		if ($settings) {
			$this->settings = Set::merge($this->settings, (array) $settings);
		}
	}

/**
 * Returns the view object for this renderer.
 * 
 * @return CtkView
 */
	final public function getView() {
		return $this->_view;
	}

/**
 * Returns the name of the current renderer.
 * 
 * @return string
 */
	final public function getName() {
		return $this->_name;
	}

/**
 * Returns the plugin for the current renderer.
 * 
 * @return string
 */
	final public function getPlugin() {
		return $this->_plugin;
	}

/**
 * Sets the renderer as loaded.
 * 
 * @return void
 */
	final public function load() {
		self::registerClass($this);
	}

/**
 * Determines if the renderer has been previously loaded.
 * 
 * @return boolean
 */
	final public function isLoaded() {
		return self::isClassRegistered($this);
	}

/**
 * Abstract method used to setup additional resources for the renderer.
 * 
 * @return void
 */
	abstract public function setup();

/**
 * Abstract method used to render the view objects and return the generated content.
 * 
 * @param CtkObject $object The object being rendered.
 * @return string
 */
	abstract public function render(CtkObject $object);
}

