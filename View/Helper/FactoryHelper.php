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
 * Base helper settings
 *
 * @var array
 */
	public $settings = array();

/**
 * Reference to the Response object
 *
 * @var CakeResponse
 */
	public $response;

/**
 * Reference to the BaseView object
 *
 * @var BaseView
 */
	protected $_baseView;

/**
 * Reference to the HelperView object
 *
 * @var HelperView
 */
	protected $_view;

/**
 * Collection of already instanciated CtkFactory objects
 *
 * @var array
 */
	protected $_factories;

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
	}

/**
 * Loads a CtkFactory object or returns it from the factories collection.
 *
 * @param string $name The name of the factory.
 * @return FactoryHelper
 */
	public function __get($name) {
		if (isset($this->_factories[$name]) && $this->_factories[$name] instanceof CtkFactoryAdaptor) {
			return $this->_factories[$name];
		}
		$class = $name . 'Factory';
		App::uses($class, 'Ctk.View/Factory');
		if (!class_exists($class)) {
			throw new CakeException(sprintf('Unknown factory: %s', $class));
		}
		$factory = new $class($name, $this->_view);
		$factory->setup();
		$this->_factories[$name] = new CtkFactoryAdaptor($factory);
		return $this->_factories[$name];
	}
}

