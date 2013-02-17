<?php
/**
 * Interface for objects that can have children.
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
 * Interface for buildable objects..
 *
 * @package       Ctk.Lib
 */
interface CtkBuildable {

/**
 * Determines if the node has a parent node.
 *
 * @return boolean
 */
	public function hasParent();

/**
 * Returns the parent node of this node.
 *
 * @return CtkBuildable
 */
	public function getParent();

/**
 * Sets the parent node for this node.
 *
 * @param CtkBuildable $node The parent node.
 * @return CtkBuildable
 */
	public function setParent(CtkBuildable $node = null);

/**
 * Determines if the node has child nodes.
 *
 * @return boolean
 */
	public function hasChildren();

/**
 * Determines if a node is a child of this node.
 *
 * @return boolean
 */
	public function hasChild(CtkBuildable $node);

/**
 * Returns the child nodes of this node.
 *
 * @return array
 */
	public function getChildren();

/**
 * Returns the first child node of this node.
 *
 * @return CtkBuildable
 */
	public function getFirst();

/**
 * Returns the last child node of this node.
 *
 * @return CtkBuildable
 */
	public function getLast();

/**
 * Returns the previous node before this node in the common parent.
 *
 * @return CtkBuildable
 */
	public function getPrevious();

/**
 * Returns the next node after this node in the common parent.
 *
 * @return CtkBuildable
 */
	public function getNext();

/**
 * Adds a node to this node as a child.
 *
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable
 */
	public function add(CtkBuildable $node);

/**
 * Adds a node before the specified node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $before Node to add before.
 * @return CtkBuildable
 */
	public function addBefore(CtkBuildable $node, CtkBuildable $before);

/**
 * Adds a node after the specified node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $after Node to add after.
 * @return CtkBuildable
 */
	public function addAfter(CtkBuildable $node, CtkBuildable $after);

/**
 * Adds an array of nodes to this node as children.
 *
 * @param array $nodes The child nodes.
 * @return CtkBuildable
 */
	public function addMany(array $nodes);

/**
 * Inherits the children of another node.
 *
 * @param CtkBuildable $node The node to inherit from.
 * @param boolean $prepend Nodes should be added before existing children.
 * @return CtkBuildable
 */
	public function addFrom(CtkBuildable $node, $prepend = false);

/**
 * Replaces the specified node with the given node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $replace Node to replace.
 * @return CtkBuildable
 */
	public function replaceChild(CtkBuildable $node, CtkBuildable $replace);

/**
 * Removes and returns a child node from this node.
 *
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable
 */
	public function removeChild(CtkBuildable $node);

/**
 * Removes all children from this node.
 *
 * @return CtkBuildable
 */
	public function clearChildren();

/**
 * Determines if any event types or a specific event type has been set.
 *
 * @param string $type The event type.
 * @return boolean
 */
	public function hasEvents($type = null);

/**
 * Returns the events for a specific event type.
 *
 * @param string $type The event type.
 * @return array
 */
	public function getEvents($type);

/**
 * Adds an event to the node.
 *
 * @param string $type The event type.
 * @param CtkEvent $event The event object.
 * @return CtkBuildable
 */
	public function addEvent($type, CtkEvent $event);

/**
 * Removes a previously set event from the element.
 *
 * @param string $type The event type.
 * @return CtkBuildable
 */
	public function removeEvents($type);

/**
 * Removes all events previously set on the element.
 *
 * @param string $type The event type.
 * @return CtkBuildable
 */
	public function clearEvents($type = null);
}

