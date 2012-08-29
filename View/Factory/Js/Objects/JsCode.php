<?php
/**
 * Base class for raw JavaScript code.
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

App::uses('JsEvent', 'Ctk.View/Factory/Js/Objects');

/**
 * Class representing raw JavaScript code.
 *
 * @package       Ctk.Factory
 */
class JsCode extends JsEvent {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'code';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'id' => null,
		'code' => 'return false'
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'code';
}

