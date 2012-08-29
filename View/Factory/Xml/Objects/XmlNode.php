<?php
/**
 * XML object for a node.
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

App::uses('CtkNode', 'Ctk.Lib');

/**
 * Creates an object representing an XML node.
 *
 * @package       Ctk.Factory
 */
class XmlNode extends CtkNode {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'node';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'name' => 'node',
		'cdata' => false,
		'value' => null
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'node';

/**
 * The collection of attributes for the XML node.
 *
 * @var array The node attributes.
 */
	protected $_attributes = array();

/**
 * Determines if a given attribute has been set.
 *
 * @param string $name Name of the attribute.
 * @return boolean
 */
	final public function hasAttribute($name) {
		return isset($this->_attributes[strtolower($name)]);
	}

/**
 * Returns an attribute set on the node.
 *
 * @param string $name Name of the attribute.
 * @return mixed
 * @throws CakeException if attribute has not been previously set.
 */
	final public function getAttribute($name) {
		if ($this->hasAttribute($name)) {
			return $this->_attributes[strtolower($name)];
		}
		throw new CakeException(sprintf('Unknown attrbiute: %s', $name));
	}

/**
 * Sets an attribute on the node.
 *
 * @param string $name Name of the attribute.
 * @param mixed $value Value of the attribute.
 * @return XmlNode
 */
	final public function setAttribute($name, $value = null) {
		$this->_attributes[strtolower($name)] = $value;
		return $this;
	}

/**
 * Removes a previously set attribute from the node.
 *
 * @param string $name Name of the attribute.
 * @return XmlNode
 */
	final public function removeAttribute($name) {
		unset($this->_attributes[strtolower($name)]);
		return $this;
	}

/**
 * Removes all attributes previously set on the node.
 *
 * @return XmlNode
 */
	final public function clearAttributes() {
		$this->_attributes = array();
		return $this;
	}

/**
 * Gets the content for the attributes for the template.
 *
 * @return string
 */
	final public function parseAttributes() {
		$content = '';
		foreach ($this->_attributes as $name => $value) {
			$content .= ' ' . $name . '="' . str_replace('"', '\"', $value) . '"';
		}
		return $content;
	}
}

