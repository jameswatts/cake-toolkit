<?php
/**
 * Factory helper for the Cake Toolkit.
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
 * @package       Ctk.View.Helper
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Helper', 'View');
App::uses('BaseView', 'Ctk.View');
App::uses('HelperView', 'Ctk.View');
App::uses('CtkFactory', 'Ctk.Lib');
App::uses('CtkFactoryAdaptor', 'Ctk.Lib');

/**
 * Factory helper to use single CTK objects in static views.
 *
 * @package       Ctk.View.Helper
 */
class FactoryHelper extends Helper {

/**
 * Base helper settings.
 *
 * @var array
 */
	public $settings = array();

/**
 * Reference to the Response object.
 *
 * @var CakeResponse
 */
	public $response = null;

/**
 * Reference to the BaseView object.
 *
 * @var BaseView
 */
	protected $_baseView = null;

/**
 * Reference to the HelperView object.
 *
 * @var HelperView
 */
	protected $_view = null;

/**
 * Factories defined to use with the helper.
 *
 * @var array
 */
	protected $_factories = array();

/**
 * Constructor
 *
 * ### Settings
 *
 * - `configFile` A file containing an array of tags you wish to redefine.
 *
 * ### Customizing tag sets
 *
 * Using the `configFile` option you can redefine the tag HtmlHelper will use.
 * The file named should be compatible with HtmlHelper::loadConfig().
 *
 * @param View $View The View this helper is being attached to.
 * @param array $settings Configuration settings for the helper.
 */
	public function __construct(View $View, $settings = array()) {
		parent::__construct($View, $settings);
		if (is_object($this->_View->response)) {
			$this->response = $this->_View->response;
		} else {
			$this->response = new CakeResponse(array('charset' => Configure::read('App.encoding')));
		}
		if (!empty($settings['configFile'])) {
			$this->loadConfig($settings['configFile']);
		}
		$this->_baseView = new BaseView();
		$this->_view = new HelperView($this->_baseView);
		$this->_factories = (empty($settings['factories']))? array() : Hash::normalize((array) $settings['factories']);
		foreach ($this->_factories as $key => $value) {
			$isAlias = (is_array($value) && isset($value['className']));
			list($plugin, $name) = pluginSplit(($isAlias)? $value['className'] : $key);
			$class = $name . 'Factory';
			App::uses($class, ((!empty($plugin))? $plugin . '.' : '') . 'View/Factory');
			if (!class_exists($class)) {
				throw new CakeException(sprintf('Unknown factory: %s', $class));
			}
			$factory = new $class($name, $plugin, $this->_view);
			$factory->setup();
			$property = ($isAlias)? $key : $name;
			$this->$property = new CtkFactoryAdaptor($factory);
		}
	}

/**
 * Adds a factory to the helper object.
 *
 * @param string $name Name of the factory.
 * @param CtkFactoryAdaptor $factory The factory adaptor object.
 * @throws CakeException if factory has not been previously included.
 */
	final public function __set($name, $factory) {
		if (is_object($factory) && $factory instanceof CtkFactoryAdaptor) {
			$this->$name = $factory;
		} else {
			throw new CakeException(sprintf('Invalid factory: %s', $name));
		}
	}
}

