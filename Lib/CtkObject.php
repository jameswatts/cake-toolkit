<?php
/**
 * Base object for the Cake Toolkit.
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
 * @package       Ctk.Lib
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Represents an object for the Cake Toolkit.
 *
 * @package       Ctk.Lib
 */
abstract class CtkObject extends Object {

/**
 * Gets an instance of the current class.
 *
 * @param array $arguments Optional arguments for the class constructor.
 * @return CtkObject
 */
	final public static function getInstance(array $arguments = null) {
		if (is_array($arguments)) {
			$class = new ReflectionClass(get_called_class());
			return $class->newInstanceArgs($arguments);
		} else {
			return new static();
		}
	}
}

