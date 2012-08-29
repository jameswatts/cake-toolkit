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
 * Returns the parent node of this node.
 */
	public function getParent();

/**
 * Sets the parent node for this node.
 *
 * @param CtkBuildable $node The parent node.
 */
	public function setParent(CtkBuildable $node = null);

/**
 * Determines if the node has child nodes.
 */
	public function hasChildren();

/**
 * Returns the child nodes of this node.
 */
	public function getChildren();

/**
 * Returns the first child node of this node.
 */
	public function getFirst();

/**
 * Returns the last child node of this node.
 */
	public function getLast();

/**
 * Adds a node to this node as a child.
 *
 * @param CtkBuildable $node Child node.
 */
	public function add(CtkBuildable $node);

/**
 * Determines if any event types or a specific event type has been set.
 *
 * @param string $type The event type.
 */
	public function hasEvents($type = null);

/**
 * Returns the events for a specific event type.
 *
 * @param string $type The event type.
 */
	public function getEvents($type);

/**
 * Adds an event to the node.
 *
 * @param string $type The event type.
 * @param CtkEvent $event The event object.
 */
	public function addEvent($type, CtkEvent $event);

/**
 * Removes a previously set event from the element.
 *
 * @param string $type The event type.
 */
	public function removeEvents($type);

/**
 * Removes all events previously set on the element.
 *
 * @param string $type The event type.
 */
	public function clearEvents($type = null);
}

