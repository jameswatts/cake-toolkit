<?php
/**
 * Interface for objects that can have events.
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

App::uses('CtkEvent', 'Ctk.Lib');

/**
 * Interface for bindable objects.
 *
 * @package       Ctk.Lib
 */
interface CtkBindable {

/**
 * Determines if any event types or a specific event type has been bound.
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
 * Binds an event to the node.
 *
 * @param string $type The event type.
 * @param CtkEvent $event The event object.
 * @return CtkBindable
 */
	public function bind($type, CtkEvent $event);

/**
 * Removes a previously bound event from the node.
 *
 * @param string $type The event type.
 * @return CtkBindable
 */
	public function removeEvents($type);

/**
 * Removes all events previously bound to the node.
 *
 * @param string $type The event type.
 * @return CtkBindable
 */
	public function clearEvents($type = null);
}
