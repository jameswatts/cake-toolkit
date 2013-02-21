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
 * The collection of singleton instances.
 *
 * @var array
 */
	protected static $_instanceCollection = array();

/**
 * Gets a singleton of the current class.
 *
 * @param array $arguments Optional arguments for the class constructor.
 * @return CtkObject
 */
	final public static function getSingleton(array $arguments = array()) {
		$name = get_called_class();
		if (isset(self::$_instanceCollection[$name])) {
			return self::$_instanceCollection[$name];
		}
		$class = new ReflectionClass($name);
		self::$_instanceCollection[$name] = $class->newInstanceArgs($arguments);
		return self::$_instanceCollection[$name];
	}

/**
 * Gets an instance of the current class.
 *
 * @param array $arguments Optional arguments for the class constructor.
 * @return CtkObject
 */
	final public static function getInstance(array $arguments = array()) {
		if (sizeof($arguments)) {
			$class = new ReflectionClass(get_called_class());
			return $class->newInstanceArgs($arguments);
		} else {
			return new static();
		}
	}

/**
 * Inherits the values of common array properties in the class inheritence chain.
 *
 * @param array $properties The array properties to inherit.
 * @param boolean $typeSafe Optional request that inherited values are of the same type.
 * @return CtkObject
 */
	final protected function _inheritArrayProperties(array $properties = array(), $typeSafe = false) {
		if (sizeof($properties)) {
			$class = new ReflectionClass(get_called_class());
			$chain = array();
			while (($class = $class->getParentClass()) !== false) {
				if ($class->getName() === __CLASS__) {
					break;
				}
				$chain[] = $class;
			}
			array_reverse($chain);
			foreach ($chain as $i => $class) {
				$defaultProperties = $class->getDefaultProperties();
				foreach ($properties as $j => $property) {
					if (is_array($this->$property) && isset($defaultProperties[$property]) && is_array($defaultProperties[$property])) {
						foreach ($defaultProperties[$property] as $key => $value) {
							if (!isset($this->{$property}[$key])) {
								$this->{$property}[$key] = $value;
							}
						}
						for ($k = 0; $k < count($defaultProperties[$property]); $k++) {
							if (isset($defaultProperties[$property][$k]) && !in_array($defaultProperties[$property][$k], $this->$property)) {
								$this->{$property}[] = $defaultProperties[$property][$k];
							}
						}
					}
				}
			}
		}
		return $this;
	}
}

