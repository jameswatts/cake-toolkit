<?php
/**
 * Base processor class for post-processing content.
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
App::uses('CtkView', 'Ctk.View');

/**
 * Abstract class for defining content post-processors.
 *
 * @package       Ctk.Lib
 */
abstract class CtkProcessor extends CtkObject implements CtkLoadable {

/**
 * Settings for this processor.
 *
 * @var array
 */
	public $settings = array();

/**
 * The current view calling the processor.
 *
 * @var CtkView The current view.
 */
	protected $_view = null;

/**
 * The name of this processor.
 *
 * @var string The name of the processor.
 */
	protected $_name = null;

/**
 * The plugin for this processor.
 *
 * @var string The plugin for the processor.
 */
	protected $_plugin = null;

/**
 * Contructor
 *
 * Creates a new processor with a reference to the current view.
 * 
 * @param CtkView $view The current view.
 * @param string $name The name of the processor.
 * @param string $plugin The name of the plugin if it exists.
 * @param array $settings Configuration settings for the processor.
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
 * Returns the view object for this processor.
 * 
 * @return CtkView
 */
	final public function getView() {
		return $this->_view;
	}

/**
 * Returns the name of the current processor.
 * 
 * @return string
 */
	final public function getName() {
		return $this->_name;
	}

/**
 * Returns the plugin for the current processor.
 * 
 * @return string
 */
	final public function getPlugin() {
		return $this->_plugin;
	}

/**
 * Sets the processor as loaded.
 * 
 * @return void
 */
	final public function load() {
		self::registerClass($this);
	}

/**
 * Determines if the processor has been previously loaded.
 * 
 * @return boolean
 */
	final public function isLoaded() {
		return self::isClassRegistered($this);
	}

/**
 * Abstract method used to setup additional resources for the processor.
 * 
 * @return void
 */
	abstract public function setup();

/**
 * Abstract method used to post-process the generated content.
 * 
 * @param string $content The content to process.
 * @return string
 */
	abstract public function process($content);
}

