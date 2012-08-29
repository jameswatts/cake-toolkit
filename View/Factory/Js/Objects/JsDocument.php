<?php
/**
 * Base class for the document object.
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
 * Class representing the document object.
 *
 * @package       Ctk.Factory
 */
class JsDocument extends JsEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'document';

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'document';

/**
 * The actions to use when constructing the template.
 *
 * @var array The collection of actions.
 */
	protected $_elementActions = array();

/**
 * Gets the current URL of the document.
 *
 * @return JsDocument
 */
	public function getUrl() {
		$this->_elementActions[] = array('getUrl');
		return $this;
	}

/**
 * Gets the current domain of the document.
 *
 * @return JsDocument
 */
	public function getDomain() {
		$this->_elementActions[] = array('getDomain');
		return $this;
	}

/**
 * Gets the title of the document.
 *
 * @return JsDocument
 */
	public function getTitle() {
		$this->_elementActions[] = array('getTitle');
		return $this;
	}

/**
 * Gets the location object for the document.
 *
 * @return JsLocation
 */
	public function getLocation() {
		return $this->getFactory()->Location();
	}
}

