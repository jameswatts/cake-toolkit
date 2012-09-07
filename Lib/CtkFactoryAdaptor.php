<?php
/**
 * Factory adaptor for the Cake Toolkit.
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
App::uses('CtkFactory', 'Ctk.Lib');

/**
 * Factory adaptor to wrap the CtkFactory object for use in static views.
 *
 * @package       Ctk.Lib
 */
class CtkFactoryAdaptor extends CtkObject {

/**
 * Reference to the CtkFactory object
 *
 * @var CtkFactory
 */
	protected $_factory;

/**
 * Constructor
 *
 * Creates a new factory adaptor for a specific CtkFactory
 *
 * @param CtkFactory $factory The factory to interface.
 */
	public function __construct(CtkFactory $factory) {
		$this->_factory = $factory;
	}

/**
 * Returns a node as an object.
 *
 * @param string $name The name of the node.
 * @return CtkNode
 */
	public function __get($name) {
		return call_user_func_array(array($this->_factory, $name), array());
	}

/**
 * Calls a method on the CtkFactory object.
 *
 * @param string $name The method name.
 * @param string $arguments The method arguments.
 * @return mixed
 */
	public function __call($name, $arguments) {
		$object = call_user_func_array(array($this->_factory, $name), $arguments);
		return $object->render();
	}
}

