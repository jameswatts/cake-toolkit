<?php
/**
 * Factory for XML elements.
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
 * Creates a factory to generate XML elements.
 *
 * @package       Ctk.View.Factory
 *
 * @method \XmlNode Node($params = array())
 */
class XmlFactory extends CtkFactory {

/**
 * Method used to setup additional resources for the factory.
 * 
 * @return void
 */
	public function setup() {}

}

