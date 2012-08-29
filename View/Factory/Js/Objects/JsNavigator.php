<?php
/**
 * Base class for the navigator object.
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
 * @package       Ctk.View.Factory.Js.Objects
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkBuildable', 'Ctk.Lib');
App::uses('JsEvent', 'Ctk.View/Factory/Js/Objects');

/**
 * Class representing the navigator object.
 *
 * @package       Ctk.Factory
 */
class JsNavigator extends JsEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'navigator';

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'navigator';

/**
 * The actions to use when constructing the template.
 *
 * @var array The collection of actions.
 */
	protected $_elementActions = array();

/**
 * Gets the application code name of the client.
 *
 * @return JsNavigator
 */
	public function getAppCodeName() {
		$this->_elementActions[] = array('getAppCodeName');
		return $this;
	}

/**
 * Gets the application name of the client.
 *
 * @return JsNavigator
 */
	public function getAppName() {
		$this->_elementActions[] = array('getAppName');
		return $this;
	}

/**
 * Gets the application version of the client.
 *
 * @return JsNavigator
 */
	public function getAppVersion() {
		$this->_elementActions[] = array('getAppVersion');
		return $this;
	}

/**
 * Determines if cookies are enabled on the client.
 *
 * @return JsNavigator
 */
	public function isCookieEnabled() {
		$this->_elementActions[] = array('isCookieEnabled');
		return $this;
	}

/**
 * Gets the platform name of the client.
 *
 * @return JsNavigator
 */
	public function getPlatform() {
		$this->_elementActions[] = array('getPlatform');
		return $this;
	}

/**
 * Gets the product name of the client.
 *
 * @return JsNavigator
 */
	public function getProduct() {
		$this->_elementActions[] = array('getProduct');
		return $this;
	}

/**
 * Gets the product subname of the client.
 *
 * @return JsNavigator
 */
	public function getProductSub() {
		$this->_elementActions[] = array('getProductSub');
		return $this;
	}

/**
 * Gets the user agent for the client.
 *
 * @return JsNavigator
 */
	public function getUserAgent() {
		$this->_elementActions[] = array('getUserAgent');
		return $this;
	}

/**
 * Gets the vendor name of the client.
 *
 * @return JsNavigator
 */
	public function getVendor() {
		$this->_elementActions[] = array('getVendor');
		return $this;
	}

/**
 * Gets the vendor subname of the client.
 *
 * @return JsNavigator
 */
	public function getVendorSub() {
		$this->_elementActions[] = array('getVendorSub');
		return $this;
	}
}

