<?php
/**
 * Base class for JavaScript events.
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

App::uses('CtkEvent', 'Ctk.Lib');

/**
 * Abstract class representing a base event in JavaScript.
 *
 * @package       Ctk.Factory
 */
abstract class JsEvent extends CtkEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'event';

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'event';

/**
 * Removes the ending ";" to insert JavaScript code inside another.
 *
 * @param string $code The JavaScript code to modify.
 * @return string
 */
	protected function _prepareCode($code) {
		$code = trim($code);
		if (substr($code, -1) === ';') {
			return substr($code, 0, strlen($code)-1);
		} else {
			return $code;
		}
	}
}

