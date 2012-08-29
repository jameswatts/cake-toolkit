<?php
/**
 * HTML object for the IFRAME element.
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
 * Creates an object representing an IFRAME element in HTML.
 *
 * @package       Ctk.Factory
 */
class HtmlIframe extends HtmlElement {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'iframe';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'height' => null,
		'name' => null,
		'sandbox' => null,
		'seamless' => null,
		'src' => null,
		'srcdoc' => null,
		'width' => null
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'iframe';

/**
 * Determines if the node accepts child nodes.
 *
 * @var boolean Set to FALSE to block adding child nodes.
 */
	protected $_allowChildren = false;
}

