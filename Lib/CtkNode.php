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

App::uses('CakeValidationSet', 'Model/Validator');
App::uses('CtkBuildable', 'Ctk.Lib');
App::uses('CtkBindable', 'Ctk.Lib');
App::uses('CtkRenderable', 'Ctk.Lib');
App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkFactory', 'Ctk.Lib');
App::uses('CtkEvent', 'Ctk.Lib');
App::uses('CtkHelperView', 'Ctk.View');

/**
 * Abstract class representing a node object.
 *
 * @package       Ctk.Lib
 */
abstract class CtkNode extends CtkObject implements CtkBuildable, CtkBindable, CtkRenderable {

/**
 * The factory used to instanciate this object.
 *
 * @var CtkFactory The instance of the factory.
 */
	protected $_factory = null;

/**
 * The name of this object.
 *
 * @var string The name of the object.
 */
	protected $_name = null;

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
 * The validation rules for configuration parameters, where the key is the parameter 
 * name and the value the rule as a string or an array.
 *
 * @var array The validation rules.
 */
	protected $_validate = array();

/**
 * The internal cache of validation sets used to validate parameters.
 *
 * @var array The validation sets.
 */
	protected $_validation = array();

/**
 * The errors logged from an invalid configuration parameter.
 *
 * @var array The validation errors.
 */
	protected $_validationErrors = array();

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
 * The events registered on this object.
 *
 * @var array Collection of event types and objects.
 */
	protected $_nodeEvents = array();

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
	protected $_limitParent = array();

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
	protected $_limitChildren = array();

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
	final public function __construct(CtkFactory $factory, array $params = array()) {
		parent::__construct();
		$this->_factory = $factory;
		$this->_name = str_replace($factory->getName(), '', get_class($this));
		$this->_nodeId = uniqid('ID_');
		$this->_inheritArrayProperties(array('_params', '_validate', '_limitParent', '_limitChildren'));
		$this->setParams($params);
	}

/**
 * Returns a template configuration parameter.
 *
 * @param string $name Name of the configuration parameter.
 * @return mixed
 * @throws CakeException if the configuration parameter is undefined.
 */
	final public function __get($name) {
		if (array_key_exists($name, $this->_params)) {
			return $this->_params[$name];
		} else {
			$factory = $this->getFactory();
			if (property_exists($factory, $name) || array_key_exists($name, $factory->getHelpers())) {
				return $factory->$name;
			}
		}
		throw new CakeException(sprintf('Undefined parameter: %s', $name));
	}

/**
 * Set the value of a template configuration parameter. Accepts some special parameter names 
 * which match to internals of the object. These include:
 *
 * - "_type" string $value The node type to pass to setType().
 * - "_id" string $value The unique ID to pass to setId().
 * - "_parent" CtkBuildable $value The node to pass to setParent().
 * - "_children" array $value An array of nodes or definitions to pass to addMany().
 * - "_events" array $value An array of events, where keys are types and values CtkEvent objects.
 *
 * @param string $name Name of the configuration parameter.
 * @param mixed $value Value of the configuration parameter.
 * @throws CakeException if the value for "_events" is not an array or they specified value does not validate.
 */
	final public function __set($name, $value = null) {
		if ($name === '_type') {
			$this->setType($value);
		} else if ($name === '_id') {
			$this->setId($value);
		} else if ($name === '_parent') {
			$this->setParent($value);
		} else if ($name === '_children') {
			$this->addMany($value);
		} else if ($name === '_events') {
			if (is_array($value)) {
				foreach ($value as $type => $event) {
					$this->bind($type, $event);
				}
			} else {
				throw new CakeException('Value for "_events" parameter must be an array');
			}
		} else {
			if (isset($this->_validate[(string) $name])) {
				if (!$this->validateParam($name, $value)) {
					throw new CakeException(sprintf('Value of "%s" parameter for %s is invalid, ' . implode(', ', $this->_validationErrors), $name, get_class($this)));
				}
			}
			$this->_params[(string) $name] = $value;
		}
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
 * Requests an instance of an object on the common factory.
 *
 * @param string $name Name of object to create.
 * @param array $arguments The method arguments.
 * @return CtkBuildable
 */
	final public function __call($name, $arguments) {
		return $this->add(call_user_func_array(array($this->_factory, $name), $arguments));
	}

/**
 * Renders the node if called as a string.
 *
 * @return string
 */
	final public function __toString() {
		try {
			if ($this->hasParent()) {
				$parent = $this->getParent();
				while ($parent->hasParent()) {
					$parent = $parent->getParent();
				}
				return $parent->render();
			}
			return $this->render();
		} catch(Exception $e) {
			trigger_error($e->getMessage(), E_USER_ERROR);
		}
	}

/**
 * Returns the name of the object.
 *
 * @return string
 */
	final public function getName() {
		return $this->_name;
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
 * Sets additional configuration parameters for the template.
 *
 * @param array $params The configuration paramaters.
 * @return CtkBuildable
 */
	final public function setParams(array $params = array()) {
		foreach ($params as $name => $value) {
			$this->__set((string) $name, $value);
		}
		return $this;
	}

/**
 * Validates the configuration parameter.
 *
 * @param string $name Name of the configuration parameter.
 * @param mixed $value Value of the configuration parameter.
 * @return boolean
 */
	final public function validateParam($name, $value = null) {
		if (isset($this->_validate[$name])) {
			if (!isset($this->_validation[$name])) {
				$this->_validation[$name] = new CakeValidationSet($name, $this->_validate[$name]);
			}
			$errors = $this->_validation[$name]->validate(array($name => $value));
			if (count($errors) > 0) {
				foreach ($errors as $error) {
					$this->_validationErrors[] = str_replace('field', 'parameter', lcfirst($error));
				}
				return false;
			}
		}
		return true;
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
 * Determines if the node allows a parent node.
 *
 * @return boolean
 */
	final public function allowsParent() {
		return $this->_allowParent;
	}

/**
 * Determines if the node has a parent node.
 *
 * @return boolean
 */
	final public function hasParent() {
		return ($this->_parentNode !== null);
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
 * @throws CakeException if node is not allowed a parent or the parent node class is not allowed.
 */
	final public function setParent(CtkBuildable $node = null) {
		if (!$this->_allowParent) {
			throw new CakeException(sprintf('Parent %s not allowed for %s', get_Class($node), get_Class($this)));
		} else if (is_array($this->_limitParent) && count($this->_limitParent) > 0 && !in_array(get_class($node), $this->_limitParent)) {
			throw new CakeException(sprintf('Invalid parent %s for %s, must be %s', get_class($node), get_class($this), implode(', ', $this->_limitParent)));
		} else if ($this === $node) {
			throw new CakeException('Child cannot be parent of itself');
		} else {
			$this->_parentNode = $node;
		}
		return $this;
	}

/**
 * Determines if the node is allowed children.
 *
 * @return boolean
 */
	final public function allowsChildren() {
		return $this->_allowChildren;
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
 * Determines if a node is a child of this node.
 *
 * @return boolean
 */
	final public function hasChild(CtkBuildable $node) {
		if ($this !== $node) {
			for ($i = 0; $i < count($this->_childNodes); $i++) {
				if ($this->_childNodes[$i] === $node) {
					return true;
				}
			}
		}
		return false;
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
 * @return CtkBuildable or null if no children exist
 */
	final public function getFirst() {
		if ($this->hasChildren()) {
			return $this->_childNodes[0];
		}
		return null;
	}

/**
 * Returns the last child node of this node.
 *
 * @return CtkBuildable or null if no children exist
 */
	final public function getLast() {
		if ($this->hasChildren()) {
			return $this->_childNodes[count($this->_childNodes)-1];
		}
		return null;
	}

/**
 * Returns the previous node before this node in the common parent.
 *
 * @return CtkBuildable or null if no node before this node
 */
	final public function getPrevious() {
		$children = $this->getParent()->getChildren();
		$count = count($children);
		if ($count > 1) {
			for ($i = 0; $i < $count; $i++) {
				if ($children[$i] === $this) {
					return ($i < 1)? null : $children[$i-1];
				}
			}
		}
		return null;
	}

/**
 * Returns the next node after this node in the common parent.
 *
 * @return CtkBuildable or null if no node after this node
 */
	final public function getNext() {
		$children = $this->getParent()->getChildren();
		$count = count($children);
		if ($count > 1) {
			for ($i = 0; $i < $count; $i++) {
				if ($children[$i] === $this) {
					return ($i == $count-1)? null : $children[$i+1];
				}
			}
		}
		return null;
	}

/**
 * Executes a callback function on each of the child nodes.
 *
 * @param callable $callback The callback function to use.
 * @param array $data The optional array of data to be used by the callback function.
 * @param boolean|int $deep Determines if applies to all children of children, or if an integer, defines the max depth.
 * @return CtkBuildable
 * @throws CakeException if the callback function is not callable.
 */
	final public function each($callback, array $data = array(), $deep = false) {
		if (!is_callable($callback)) {
			throw new CakeException('Callback function must be callable');
		}
		if ($this->hasChildren()) {
			$children = $this->getChildren();
			$view = $this->_factory->getView();
			for ($i = 0; $i < count($children); $i++) {
				$break = call_user_func_array($callback, array($children[$i], $this, $view, $data, $i));
				if (!is_null($break) && $break === true) {
					break;
				}
				if ($deep && $children[$i]->hasChildren()) {
					$children[$i]->each($callback, $data, (is_bool($deep))? true : $deep-1);
				}
			}
		}
		return $this;
	}

/**
 * Returns a duplicate of the node with a unique ID.
 *
 * @param array $params The optional configuration parameters to merge with exisitng values.
 * @return CtkBuildable
 */
	final public function copy(array $params = null) {
		$node = clone $this;
		$node->setId(uniqid('ID_'));
		if (is_array($params)) {
			$node->setParams($params);
		}
		$children = $node->getChildren();
		$node->clearChildren();
		for ($i = 0; $i < count($children); $i++) {
			$node->add($children[$i]->copy());
		}
		return $node;
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
			if (!$this->hasChild($node)) {
				if ($this === $node) {
					throw new CakeException('Cannot add child to itself');
				}
				if (is_array($this->_limitChildren) && count($this->_limitChildren) > 0) {
					if (in_array(get_class($node), $this->_limitChildren)) {
						$node->setParent($this);
						$this->_childNodes[] = $node;
					} else {
						throw new CakeException(sprintf('Invalid child %s for %s, must be %s', get_class($node), get_class($this), implode(', ', $this->_limitChildren)));
					}
				} else {
					$node->setParent($this);
					$this->_childNodes[] = $node;
				}
			}
			return $node;
		}
		throw new CakeException(sprintf('Cannot add children to %s', get_class($this)));
	}

/**
 * Adds a node before the specified node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $before Node to add before.
 * @return CtkBuildable
 * @throws CakeException if the specified node is not a child or this node does not allow children.
 */
	final public function addBefore(CtkBuildable $node, CtkBuildable $before) {
		if ($this->_allowChildren) {
			if ($this === $node || $this === $before) {
				throw new CakeException('Cannot reference parent as a child');
			}
			if ($this->hasChild($node)) {
				$this->removeChild($node);
			}
			for ($i = 0; $i < count($this->_childNodes); $i++) {
				if ($this->_childNodes[$i] === $before) {
					array_splice($this->_childNodes, $i-1, 0, $node);
					return $node;
				}
			}
			throw new CakeException(sprintf('Unknown child %s', get_class($before)));
		}
		throw new CakeException(sprintf('Cannot add children to %s', get_class($this)));
	}

/**
 * Adds a node after the specified node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $after Node to add after.
 * @return CtkBuildable
 * @throws CakeException if the specified node is not a child or this node does not allow children.
 */
	final public function addAfter(CtkBuildable $node, CtkBuildable $after) {
		if ($this->_allowChildren) {
			if ($this === $node || $this === $after) {
				throw new CakeException('Cannot reference parent as a child');
			}
			if ($this->hasChild($node)) {
				$this->removeChild($node);
			}
			for ($i = 0; $i < count($this->_childNodes); $i++) {
				if ($this->_childNodes[$i] === $after) {
					array_splice($this->_childNodes, $i+1, 0, $node);
					return $node;
				}
			}
			throw new CakeException(sprintf('Unknown child %s', get_class($after)));
		}
		throw new CakeException(sprintf('Cannot add children to %s', get_class($this)));
	}

/**
 * Adds an array of nodes to this node as children.
 *
 * @param array $nodes The child nodes.
 * @return CtkBuildable
 * @throws CakeException if this node does not allow children.
 */
	final public function addMany(array $nodes) {
		if ($this->_allowChildren) {
			foreach ($nodes as $name => &$node) {
				if ($node instanceof CtkBuildable) {
					$this->add($node);
				} else if (is_string($node)) {
					$this->$node();
				} else if (is_array($node)) {
					$this->add(call_user_func_array(array($this->_factory, $name), array($node)));
				} else {
					throw new CakeException(sprintf('Unknown child %s', (is_object($node))? get_class($node) : (string) $node));
				}
			}
			return $this;
		}
		throw new CakeException(sprintf('Cannot add children to %s', get_class($this)));
	}

/**
 * Inherits the children of another node.
 *
 * @param CtkBuildable $node The node to inherit from.
 * @param boolean $prepend Nodes should be added before existing children.
 * @return CtkBuildable
 * @throws CakeException if this node does not allow children.
 */
	final public function addFrom(CtkBuildable $node, $prepend = false) {
		if ($this->_allowChildren) {
			$children = $node->getChildren();
			$count = count($children);
			if ($prepend && $count > 0) {
				$first = $node->getFirst();
				for ($i = $count-1; $i >= 0; $i--) {
					$first = $this->addBefore($children[$i], $first);
				}
			} else {
				for ($i = 0; $i < $count; $i++) {
					$this->add($children[$i]);
				}
			}
			return $this;
		}
		throw new CakeException(sprintf('Cannot add children to %s', get_class($this)));
	}

/**
 * Conditionally adds a node to this node as a child.
 *
 * @param boolean $condition The boolean value or expression.
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable or null if condition is false
 * @throws CakeException if this node does not allow children.
 */
	final public function addIf($condition = false, CtkBuildable $node) {
		if ($this->_allowChildren) {
			return ((bool) $condition === true)? $this->add($node) : null;
		}
		throw new CakeException(sprintf('Cannot add children to %s', get_class($this)));
	}

/**
 * Adds a node to this node as a child while the callback function returns a node.
 *
 * @param callable $callback The callback function to return nodes.
 * @param array $data The optional array of data to be used by the callback function.
 * @return CtkBuildable
 * @throws CakeException if the callback function is not callable or if this node does not allow children.
 */
	final public function addWhile($callback, array $data = array()) {
		if (!is_callable($callback)) {
			throw new CakeException('Callback function must be callable');
		}
		if ($this->_allowChildren) {
			$i = 0;
			$view = $this->_factory->getView();
			$node = call_user_func_array($callback, array($this, $view, $data, $i));
			while (is_object($node) && $node instanceof CtkBuildable) {
				$this->add($node);
				$node = call_user_func_array($callback, array($this, $view, $data, ++$i));
			}
			return $this;
		}
		throw new CakeException(sprintf('Cannot add children to %s', get_class($this)));
	}

/**
 * Replaces the specified node with the given node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $replace Node to replace.
 * @return CtkBuildable
 * @throws CakeException if the specified node is not a child.
 */
	final public function replaceChild(CtkBuildable $node, CtkBuildable $replace) {
		if ($this === $node || $this === $replace) {
			throw new CakeException('Cannot reference parent as a child');
		}
		if (!$this->hasChild($replace)) {
			throw new CakeException(sprintf('Unknown child %s', get_class($replace)));
		}
		if ($this->hasChild($node)) {
			$this->removeChild($node);
		}
		for ($i = 0; $i < count($this->_childNodes); $i++) {
			if ($this->_childNodes[$i] === $replace) {
				$replace->setParent(null);
				$this->_childNodes[$i] = $node;
				return $this;
			}
		}
	}

/**
 * Removes and returns a child node from this node.
 *
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable
 * @throws CakeException if the specified node is not a child.
 */
	final public function removeChild(CtkBuildable $node) {
		if ($this === $node) {
			throw new CakeException('Cannot reference parent as a child');
		}
		for ($i = 0; $i < count($this->_childNodes); $i++) {
			if ($this->_childNodes[$i] === $node) {
				$node->setParent(null);
				array_splice($this->_childNodes, $i, 1);
				return $node;
			}
		}
		throw new CakeException(sprintf('Unknown child %s', get_class($node)));
	}

/**
 * Removes all children from this node.
 *
 * @return CtkBuildable
 */
	final public function clearChildren() {
		foreach ($this->_childNodes as &$node) {
			$node->setParent(null);
		}
		$this->_childNodes = array();
		return $this;
	}

/**
 * Determines if the node is allowed events.
 *
 * @return boolean
 */
	final public function allowsEvents() {
		return $this->_allowEvents;
	}

/**
 * Determines if any event types or a specific event type has been bound.
 *
 * @param string $type The event type.
 * @return boolean
 */
	final public function hasEvents($type = null) {
		return (is_string($type))? isset($this->_nodeEvents[strtolower($type)]) : (bool) count($this->_nodeEvents);
	}

/**
 * Returns the events for a specific event type.
 *
 * @param string $type The optional event type to filter the registered events.
 * @return array
 */
	final public function getEvents($type = null) {
		if (is_string($type)) {
			if ($this->hasEvents($type)) {
				return $this->_nodeEvents[strtolower($type)];
			}
			return array();
		}
		return $this->_nodeEvents;
	}

/**
 * Binds an event to the node.
 *
 * @param string $type The event type.
 * @param CtkEvent $event The event object.
 * @return CtkBuildable
 * @throws CakeException if events are not allowed on this node.
 */
	final public function bind($type, CtkEvent $event) {
		if (!is_string($type)) {
			throw new CakeException('Event type must be a string');
		}
		if ($this->_allowEvents) {
			$this->_nodeEvents[strtolower($type)][] = $event;
			return $this;
		}
		throw new CakeException('Cannot bind event to node');
	}

/**
 * Removes a previously bound event from the node.
 *
 * @param string $type The event type.
 * @return CtkBuildable
 */
	final public function removeEvents($type) {
		unset($this->_nodeEvents[strtolower($type)]);
		return $this;
	}

/**
 * Removes all events previously bound to the node.
 *
 * @param string $type The event type.
 * @return CtkBuildable
 */
	final public function clearEvents($type = null) {
		if (is_string($type)) {
			if ($this->hasEvents($type)) {
				unset($this->_nodeEvents[strtolower($type)]);
			}
		} else {
			$this->_nodeEvents = array();
		}
		return $this;
	}

/**
 * Loads the template for the node.
 *
 * @param string $path Path to the template.
 * @return string
 * @throws CakeException if template is not found.
 */
	final public function load($path) {
		if (!is_string($path)) {
			throw new CakeException('Template path must be a string');
		}
		if (is_file($path) && is_readable($path)) {
			ob_start();
			require $path;
			return ob_get_clean();
		}
		throw new CakeException(sprintf('Template not found: %s', $path));
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

