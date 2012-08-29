<?php
/**
 * Interface for objects that can be rendered.
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
 * Interface for renderable objects.
 *
 * @package       Ctk.Lib
 */
interface CtkRenderable {

/**
 * Loads the template for the node.
 *
 * @param string $path Path to the template.
 * @return string
 */
	public function load($path);

/**
 * Renders the node using the the view renderer.
 *
 * @return string
 */
	public function render();

/**
 * Renders the child nodes of this node.
 *
 * @return string
 */
	public function renderChildren();
}

