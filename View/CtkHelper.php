<?php
/**
 * Helper adaptor for view class.
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

App::uses('Helper', 'View');
App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkBuildable', 'Ctk.Lib');
App::uses('CtkRenderable', 'Ctk.Lib');
App::uses('CtkContent', 'Ctk.Lib');
App::uses('CtkView', 'Ctk.View');

/**
 * Class used as an adaptor for Cake helpers.
 *
 * @package       Ctk.Lib
 */
class CtkHelper extends CtkObject {

/**
 * The current view requesting the helper.
 *
 * @var CtkView The current view.
 */
	protected $_view = null;

/**
 * The name of the helper
 *
 * @var string The name of the helper.
 */
	protected $_name = null;

/**
 * The helper object
 *
 * @var Helper The helper object.
 */
	protected $_helper = null;

/**
 * Contructor
 *
 * Creates an adaptor object to the original helper.
 *
 * @param string $name The helper name.
 * @param Helper $helper The helper object.
 * @param CtkView $view The view object.
 */
	final public function __construct($name, Helper $helper, CtkView $view) {
		$this->_name = (string) $name;
		$this->_helper = $helper;
		$this->_view = $view;
	}

/**
 * Returns a property from the helper.
 *
 * @param string $name The property name.
 * @return mixed
 */
	final public function __get($name) {
		return $this->_helper->$name;
	}

/**
 * Sets a property on the helper.
 *
 * @param string $name The property name.
 * @param mixed $value The property value.
 */
	final public function __set($name, $value = null) {
		$this->_helper->$name = $value;
	}

/**
 * Calls a method on the helper.
 *
 * @param string $name The method name.
 * @param array $arguments The arguments to pass.
 * @return mixed
 */
	final public function __call($name, $arguments) {
		array_walk_recursive($arguments, function(&$value, $key) {
			if (is_object($value) && $value instanceof CtkRenderable) {
				$value = $value->render();
			}
		});
		ob_start();
		$return = call_user_func_array(array($this->_helper, $name), $arguments);
		$output = ob_get_clean();
		if ($return === null && $output !== '' && $output !== false && $output !== null) {
			$return = $output;
		}
		return ($return instanceof CtkBuildable || $return instanceof CtkRenderable)? $return : new CtkContent($this->_view, $return);
	}
}

