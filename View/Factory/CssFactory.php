<?php
/**
 * Factory for CSS definitions.
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
 * @package       Ctk.View.Factory
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkFactory', 'Ctk.Lib');

/**
 * Creates a factory to generate CSS definitions.
 *
 * @package       Ctk.View
 *
 * @method \CssBlock Block($params = array())
 * @method \CssDeclaration Declaration($params = array())
 * @method \CssFontface Fontface($params = array())
 * @method \CssMedia Media($params = array())
 * @method \CssRule Rule($params = array())
 */
class CssFactory extends CtkFactory {

	public function setup() {}

}

