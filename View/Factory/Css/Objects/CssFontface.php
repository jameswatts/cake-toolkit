<?php
/**
 * Base class for a CSS font-face rule.
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
 * @package       Ctk.View.Factory.Css.Objects
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CssBlock', 'Ctk.View/Factory/Css/Objects');

/**
 * Class representing a CSS font-face rule.
 *
 * @package       Ctk.Factory
 */
class CssFontface extends CssBlock {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'fontface';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'src' => null,
		'family' => null,
		'weight' => 'normal',
		'style' => 'normal',
		'stretch' => 'normal',
		'unicode' => null
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'fontface';

/**
 * Determines if the node accepts child nodes.
 *
 * @var boolean Set to FALSE to block adding child nodes.
 */
	protected $_allowChildren = false;
}

