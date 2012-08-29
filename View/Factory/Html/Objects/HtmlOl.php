<?php
/**
 * HTML object for the OL element.
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

App::uses('HtmlElement', 'Ctk.View/Factory/Html/Objects');

/**
 * Creates an object representing a OL element in HTML.
 *
 * @package       Ctk.Factory
 */
class HtmlOl extends HtmlElement {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'ol';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'reversed' => null,
		'start' => null,
		'type' => null
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'ol';

/**
 * Limits the children allowed on this node.
 *
 * @var array List of children allowed by name, or NULL for no limit.
 */
	protected $_limitChildren = array('HtmlLi');
}

