<?php
/**
 * Base class for the location object.
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
 * Class representing the location object.
 *
 * @package       Ctk.Factory
 */
class JsLocation extends JsEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'location';

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'location';

/**
 * The actions to use when constructing the template.
 *
 * @var array The collection of actions.
 */
	protected $_elementActions = array();

/**
 * Gets the current hash part of the location.
 *
 * @return JsLocation
 */
	public function getHash() {
		$this->_elementActions[] = array('getHash');
		return $this;
	}

/**
 * Gets the hostname part of the location.
 *
 * @return JsLocation
 */
	public function getHostname() {
		$this->_elementActions[] = array('getHostname');
		return $this;
	}

/**
 * Gets the full hyperlink reference of the document.
 *
 * @return JsLocation
 */
	public function getHref() {
		$this->_elementActions[] = array('getHref');
		return $this;
	}

/**
 * Gets the pathname part of the location.
 *
 * @return JsLocation
 */
	public function getPathname() {
		$this->_elementActions[] = array('getPathname');
		return $this;
	}

/**
 * Gets the port part of the location.
 *
 * @return JsLocation
 */
	public function getPort() {
		$this->_elementActions[] = array('getPort');
		return $this;
	}

/**
 * Gets the protocol part of the location.
 *
 * @return JsLocation
 */
	public function getProtocol() {
		$this->_elementActions[] = array('getProtocol');
		return $this;
	}

/**
 * Gets the query string part of the location.
 *
 * @return JsLocation
 */
	public function getSearch() {
		$this->_elementActions[] = array('getSearch');
		return $this;
	}
}

