<?php
/**
 * Base processor class for post-processing content.
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

App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkView', 'Ctk.View');

/**
 * Abstract class for defining content post-processors.
 *
 * @package       Ctk.Lib
 */
abstract class CtkProcessor extends CtkObject {

/**
 * The name of this processor.
 *
 * @var string The name of the processor.
 */
	protected $_name = null;

/**
 * The current view calling the processor.
 *
 * @var CtkView The current view.
 */
	protected $_view = null;

/**
 * Contructor
 *
 * Creates a new processor with a reference to the current view.
 * 
 * @param string $name The name of the processor.
 * @param CtkView $view The current view.
 */
	final public function __construct($name, CtkView $view) {
		$this->_name = (string) $name;
		$this->_view = $view;
	}

/**
 * Abstract method used to post-process the generated content.
 * 
 * @param string $content The content to process.
 * @return string
 */
	abstract public function process($content);
}

