<?php
/**
 * Base class for the history object.
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
 * Class representing the history object.
 *
 * @package       Ctk.Factory
 */
class JsHistory extends JsEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'history';

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'history';

/**
 * The actions to use when constructing the template.
 *
 * @var array The collection of actions.
 */
	protected $_elementActions = array();

/**
 * Goes to the previous page in session history, the same action as when the user clicks the browser's Back button.
 *
 * @param string $url The URL to load if history is empty.
 * @param boolean $host Optionally require the referer to be on the same domain.
 * @return JsHistory
 */
	public function back($url = null, $host = null) {
		$this->_elementActions[] = array('back', func_get_args());
		return $this;
	}

/**
 * Goes to the next page in session history, the same action as when the user clicks the browser's Forward button.
 *
 * @return JsHistory
 */
	public function forward() {
		$this->_elementActions[] = array('forward');
		return $this;
	}

/**
 * Loads a page from the session history, identified by its relative location to the current page, for example -1 for the previous page or 1 for the next page.
 *
 * @param integer $index The history index to load.
 * @return JsHistory
 */
	public function go($index) {
		$this->_elementActions[] = array('go', func_get_args());
		return $this;
	}

/**
 * Pushes the given data onto the session history stack with the specified title and, if provided, URL.
 *
 * @param string $data The DOM data to use.
 * @param string $title The history title.
 * @param string $url The optional URL.
 * @return JsHistory
 */
	public function pushState($data, $title, $url = null) {
		$this->_elementActions[] = array('pushState', func_get_args());
		return $this;
	}

/**
 * Updates the most recent entry on the history stack to have the specified data, title, and, if provided, URL.
 *
 * @param string $data The DOM data to use.
 * @param string $title The history title.
 * @param string $url The optional URL.
 * @return JsHistory
 */
	public function replaceState($data, $title, $url = null) {
		$this->_elementActions[] = array('replaceState', func_get_args());
		return $this;
	}

/**
 * Gets the number of elements in the session history, including the currently loaded page.
 *
 * @return JsHistory
 */
	public function getLength() {
		$this->_elementActions[] = array('getLength');
		return $this;
	}

/**
 * Gets the URL of the active item of the session history.
 *
 * @return JsHistory
 */
	public function getCurrent() {
		$this->_elementActions[] = array('getCurrent');
		return $this;
	}

/**
 * Gets the URL of the previous item in the session history.
 *
 * @return JsHistory
 */
	public function getPrevious() {
		$this->_elementActions[] = array('getPrevious');
		return $this;
	}

/**
 * Gets the URL of the next item in the session history.
 *
 * @return JsHistory
 */
	public function getNext() {
		$this->_elementActions[] = array('getNext');
		return $this;
	}

/**
 * Gets the state at the top of the history stack..
 *
 * @return JsHistory
 */
	public function getState() {
		$this->_elementActions[] = array('getState');
		return $this;
	}
}

