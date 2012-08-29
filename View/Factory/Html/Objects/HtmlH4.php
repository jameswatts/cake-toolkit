<?php
/**
 * HTML object for the H4 element.
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
 * @package       Ctk.View.Factory.Html.Objects
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('HtmlH', 'Ctk.View/Factory/Html/Objects');

/**
 * Creates an object representing a H4 element in HTML.
 *
 * @package       Ctk.Factory
 */
class HtmlH4 extends HtmlH {

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'size' => 4,
		'text' => ''
	);
}

