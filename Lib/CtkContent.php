<?php
/**
 * Node object for content generated without a factory.
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
App::uses('CtkView', 'Ctk.View');

/**
 * Class representing non-factory generated content.
 *
 * @package       Ctk.Lib
 */
class CtkContent extends CtkObject implements CtkBuildable,CtkRenderable {

/**
 * The current view requesting the content.
 *
 * @var CtkView The current view.
 */
	protected $_view = null;

/**
 * The raw content for this object.
 *
 * @var string The raw content.
 */
	protected $_content = null;

/**
 * The parent node for this object.
 *
 * @var CtkBuildable The parent node object.
 */
	protected $_parentNode = null;

/**
 * Contructor
 *
 * Creates an object for raw content.
 */
	final public function __construct(CtkView $view, $content = '') {
		$this->_view = $view;
		$this->_content = (string) $content;
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
 * @return string
 */
	final public function getFactory() {
		return null;
	}

/**
 * Returns the name of the template for the node.
 *
 * @return string
 */
	final public function getTemplate() {
		return '';
	}

/**
 * Determines if the node allows a parent node.
 *
 * @return boolean
 */
	final public function allowsParent() {
		return true;
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
 */
	final public function setParent(CtkBuildable $node = null) {
		$this->_parentNode = $node;
		return $this;
	}

/**
 * Determines if the node is allowed children.
 *
 * @return boolean
 */
	final public function allowsChildren() {
		return false;
	}

/**
 * Determines if the node has child nodes.
 *
 * @return boolean
 */
	final public function hasChildren() {
		return false;
	}

/**
 * Determines if a node is a child of this node.
 *
 * @return boolean
 */
	final public function hasChild(CtkBuildable $node) {
		return false;
	}

/**
 * Returns the child nodes of this node as an array.
 *
 * @return array
 */
	final public function getChildren() {
		return array();
	}

/**
 * Returns the first child node of this node.
 *
 * @return CtkBuildable
 * @throws CakeException if node has no children.
 */
	final public function getFirst() {
		throw new CakeException('Node has no children');
	}

/**
 * Returns the last child node of this node.
 *
 * @return CtkBuildable
 * @throws CakeException if node has no children.
 */
	final public function getLast() {
		throw new CakeException('Node has no children');
	}

/**
 * Returns the previous node before this node in the common parent.
 *
 * @return CtkBuildable
 */
	final public function getPrevious() {
		return null;
	}

/**
 * Returns the next node after this node in the common parent.
 *
 * @return CtkBuildable
 */
	final public function getNext() {
		return null;
	}

/**
 * Adds a node to this node as a child.
 *
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable
 * @throws CakeException if the child node class is not allowed or this node does not allow children.
 */
	final public function add(CtkBuildable $node) {
		throw new CakeException('Cannot add children to node');
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
		throw new CakeException(sprintf('Unknown child %s', get_class($replace)));
	}

/**
 * Removes and returns a child node from this node.
 *
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable
 * @throws CakeException if the specified node is not a child.
 */
	final public function removeChild(CtkBuildable $node) {
		throw new CakeException(sprintf('Unknown child %s', get_class($node)));
	}

/**
 * Removes all children from this node.
 *
 * @return CtkBuildable
 */
	final public function clearChildren() {
		return $this;
	}

/**
 * Determines if the node is allowed events.
 *
 * @return boolean
 */
	final public function allowsEvents() {
		return false;
	}

/**
 * Determines if any event types or a specific event type has been set.
 *
 * @param string $type The event type.
 * @return boolean
 */
	final public function hasEvents($type = null) {
		return false;
	}

/**
 * Returns the events for a specific event type.
 *
 * @param string $type The event type.
 * @return array
 */
	final public function getEvents($type) {
		return array();
	}

/**
 * Adds an event to the node.
 *
 * @param string $type The event type.
 * @param CtkEvent $event The event object.
 * @return CtkBuildable
 */
	final public function addEvent($type, CtkEvent $event) {
		throw new CakeException('Cannot add events to node');
	}

/**
 * Removes a previously set event from the element.
 *
 * @param string $type The event type.
 * @return CtkBuildable
 */
	final public function removeEvents($type) {
		return $this;
	}

/**
 * Removes all events previously set on the element.
 *
 * @param string $type The event type.
 * @return CtkBuildable
 */
	final public function clearEvents($type = null) {
		return $this;
	}

/**
 * Loads the template for the node.
 *
 * @param string $path Path to the template.
 * @return string
 */
	final public function load($path) {
		return '';
	}

/**
 * Renders the node using the the view renderer.
 *
 * @return string
 */
	final public function render() {
		return $this->_content;
	}

/**
 * Renders the child nodes of this node.
 *
 * @return string
 */
	final public function renderChildren() {
		return '';
	}
}

