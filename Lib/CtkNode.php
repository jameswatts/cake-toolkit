<?php
/**
 * Base node object for defining elements.
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

App::uses('CtkBuildable', 'Ctk.Lib');
App::uses('CtkRenderable', 'Ctk.Lib');
App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkFactory', 'Ctk.Lib');
App::uses('CtkEvent', 'Ctk.Lib');

/**
 * Abstract class representing a node object.
 *
 * @package       Ctk.Lib
 */
abstract class CtkNode extends CtkObject implements CtkBuildable,CtkRenderable {

/**
 * The factory used to instanciate this object.
 *
 * @var CtkFactory The instance of the factory.
 */
	protected $_factory = null;

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = null;

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array();

/**
 * The type of node this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'node';

/**
 * The unique ID of the node.
 *
 * @var string The unique ID.
 */
	protected $_nodeId = null;

/**
 * The parent node for this object.
 *
 * @var CtkNode The parent node object.
 */
	protected $_parentNode = null;

/**
 * The child nodes on this object.
 *
 * @var array Collection of child node objects.
 */
	protected $_childNodes = array();

/**
 * Determines if the node can have a parent.
 *
 * @var boolean Set to FALSE to block adding to other nodes.
 */
	protected $_allowParent = true;

/**
 * Limits the parent allowed for this node.
 *
 * @var array List of parents allowed by name, or NULL for no limit.
 */
	protected $_limitParent = null;

/**
 * Determines if the node accepts child nodes.
 *
 * @var boolean Set to FALSE to block adding child nodes.
 */
	protected $_allowChildren = true;

/**
 * Limits the children allowed on this node.
 *
 * @var array List of children allowed by name, or NULL for no limit.
 */
	protected $_limitChildren = null;

/**
 * Determines if the node accepts events.
 *
 * @var boolean Set to FALSE to block adding events.
 */
	protected $_allowEvents = true;

/**
 * Contructor
 *
 * Creates a new node with a unique ID and optional template configuration parameters.
 * 
 * @param CtkFactory $factory The factory that created the node.
 * @param array $params The optional configuration parameters for the template.
 */
	final public function __construct(CtkFactory $factory, $params = array()) {
		$this->_factory = $factory;
		$this->_nodeId = uniqid('ID_');
		foreach ($params as $name => $value) {
			$this->_params[(string) $name] = $value;
		}
	}

/**
 * Returns a template configuration parameter.
 *
 * @param string $name Name of the configuration parameter.
 * @return mixed
 */
	final public function __get($name) {
		if (isset($this->_params[(string) $name])) {
			return $this->_params[(string) $name];
		} else {
			throw new CakeException(sprintf('Undefined param %s', $name));
		}
	}

/**
 * Set the value of a template configuration parameter.
 *
 * @param string $name Name of the configuration parameter.
 * @param mixed $value Value of the configuration parameter.
 */
	final public function __set($name, $value = null) {
		$this->_params[(string) $name] = $value;
	}

/**
 * Determines if a template configuration parameter has been defined.
 *
 * @param string $name Name of the configuration parameter.
 * @return mixed
 */
	final public function __isset($name) {
		return (isset($this->_params[(string) $name]));
	}

/**
 * Renders the node if called as a string.
 *
 * @return string
 */
	final public function __toString() {
		return $this->render();
	}

/**
 * Returns the factory which created the node.
 *
 * @return CtkFactory
 */
	final public function getFactory() {
		return $this->_factory;
	}

/**
 * Returns the name of the template for the node.
 *
 * @return string
 */
	final public function getTemplate() {
		return $this->_template;
	}

/**
 * Returns the configuration parameters for the template.
 *
 * @return array
 */
	final public function getParams() {
		return $this->_params;
	}

/**
 * Returns the node type.
 *
 * @return string
 */
	final public function getType() {
		return $this->_nodeType;
	}

/**
 * Sets the node type.
 *
 * @param string $type Node type.
 * @return CtkBuildable
 */
	final public function setType($type) {
		$this->_nodeType = (string) $type;
		return $this;
	}

/**
 * Gets the unique ID for this element.
 *
 * @return string
 */
	final public function getId() {
		return $this->_nodeId;
	}

/**
 * Sets the unique ID for the element.
 *
 * @param string $id The unique ID for this element.
 * @return CtkBuildable
 */
	final public function setId($id) {
		$this->_nodeId = (string) $id;
		return $this;
	}

/**
 * Returns the parent node of this node.
 *
 * @return CtkBuildable
 */
	final public function getParent() {
		return $this->_parentNode;
	}

/**
 * Sets the parent node for this node.
 *
 * @param CtkBuildable $node The parent node.
 * @return CtkBuildable
 * @throws CakeException if node is not allowed a parent.
 */
	final public function setParent(CtkBuildable $node = null) {
		if (!$this->_allowParent) {
			throw new CakeException(sprintf('Parent %s not allowed for %s', get_Class($node), get_Class($this)));
		} else if (is_array($this->_limitParent) && count($this->_limitParent) > 0 && !in_array(get_class($node), $this->_limitParent)) {
			throw new CakeException(sprintf('Invalid parent %s for %s, must be: %s', get_class($node), get_class($this), implode(', ', $this->_limitParent)));
		} else {
			$this->_parentNode = $node;
		}
		return $this;
	}

/**
 * Determines if the node has child nodes.
 *
 * @return boolean
 */
	final public function hasChildren() {
		return (count($this->_childNodes) > 0);
	}

/**
 * Returns the child nodes of this node as an array.
 *
 * @return array
 */
	final public function getChildren() {
		return $this->_childNodes;
	}

/**
 * Returns the first child node of this node.
 *
 * @return CtkBuildable
 * @throws CakeException if node has no children.
 */
	final public function getFirst() {
		if ($this->hasChildren()) {
			return $this->_childNodes[0];
		} else {
			throw new CakeException(sprintf('Node %s has no children', get_class($this)));
		}
	}

/**
 * Returns the last child node of this node.
 *
 * @return CtkBuildable
 * @throws CakeException if node has no children.
 */
	final public function getLast() {
		if ($this->hasChildren()) {
			return $this->_childNodes[count($this->_childNodes)-1];
		} else {
			throw new CakeException(sprintf('Node %s has no children', get_class($this)));
		}
	}

/**
 * Adds a node to this node as a child.
 *
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable
 * @throws CakeException if the child node class is not allowed or this node does not allow children.
 */
	final public function add(CtkBuildable $node) {
		if ($this->_allowChildren) {
			if (is_array($this->_limitChildren) && count($this->_limitChildren) > 0) {
				if (in_array(get_class($node), $this->_limitChildren)) {
					$node->setParent($this);
					$this->_childNodes[] = $node;
				} else {
					throw new CakeException(sprintf('Invalid child %s for %s, must be: %s', get_class($node), get_class($this), implode(', ', $this->_limitChildren)));
				}
			} else {
				$node->setParent($this);
				$this->_childNodes[] = $node;
			}
			return $node;
		} else {
			throw new CakeException(sprintf('Cannot add children to %s', get_class($this)));
		}
	}

/**
 * Determines if any event types or a specific event type has been set.
 *
 * @param string $type The event type.
 * @return boolean
 */
	final public function hasEvents($type = null) {
		return (is_string($type))? isset($this->_events[strtolower($type)]) : (bool) count($this->_events);
	}

/**
 * Returns the events for a specific event type.
 *
 * @param string $type The event type.
 * @return array
 */
	final public function getEvents($type) {
		if (is_string($type)) {
			if ($this->hasEvents($type)) {
				return $this->_events[strtolower($type)];
			}
		} else {
			return $this->_events;
		}
	}

/**
 * Adds an event to the node.
 *
 * @param string $type The event type.
 * @param CtkEvent $event The event object.
 * @return CtkBuildable
 */
	final public function addEvent($type, CtkEvent $event) {
		if ($this->_allowEvents) {
			$this->_events[strtolower($type)][] = $event;
			return $this;
		} else {
			throw new CakeException('Cannot add events to node');
		}
	}

/**
 * Removes a previously set event from the element.
 *
 * @param string $type The event type.
 * @return CtkBuildable
 */
	final public function removeEvents($type) {
		unset($this->_events[strtolower($type)]);
		return $this;
	}

/**
 * Removes all events previously set on the element.
 *
 * @param string $type The event type.
 * @return CtkBuildable
 */
	final public function clearEvents($type = null) {
		if (is_string($type)) {
			if ($this->hasEvents($type)) {
				unset($this->_events[strtolower($type)]);
			}
		} else {
			$this->_events = array();
		}
		return $this;
	}

/**
 * Loads the template for the node.
 *
 * @param string $path Path to the template.
 * @return string
 */
	final public function load($path) {
		if (is_file($path) && is_readable($path)) {
			ob_start();
			require $path;
			return ob_get_clean();
		} else {
			throw new CakeException(sprintf('Template not found: %s', $path));
		}
	}

/**
 * Renders the node using the the view renderer.
 *
 * @return string
 */
	final public function render() {
		return $this->_factory->getView()->getRenderer()->render($this);
	}

/**
 * Renders the child nodes of this node.
 *
 * @return string
 */
	final public function renderChildren() {
		$content = '';
		foreach ($this->_childNodes as $node) {
			$content .= $node->render();
		}
		return $content;
	}
}

