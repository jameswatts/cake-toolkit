<?php
/**
 * HTML object for the INPUT element.
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
 * Creates an object representing an INPUT element in HTML.
 *
 * @package       Ctk.Factory
 */
class HtmlInput extends HtmlElement {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'input';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'accept' => null,
		'alt' => null,
		'autocomplete' => null,
		'autofocus' => null,
		'checked' => null,
		'disabled' => null,
		'form' => null,
		'formaction' => null,
		'formenctype' => null,
		'formmethod' => null,
		'formnovalidate' => null,
		'formtarget' => null,
		'framename' => null,
		'height' => null,
		'list' => null,
		'max' => null,
		'maxlength' => null,
		'min' => null,
		'multiple' => null,
		'name' => null,
		'pattern' => null,
		'placeholder' => null,
		'readonly' => null,
		'required' => null,
		'size' => null,
		'src' => null,
		'step' => null,
		'type' => 'text',
		'value' => '',
		'width' => null
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'input';

/**
 * Determines if the node accepts child nodes.
 *
 * @var boolean Set to FALSE to block adding child nodes.
 */
	protected $_allowChildren = false;
}

