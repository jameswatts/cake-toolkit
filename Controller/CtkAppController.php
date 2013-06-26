<?php
/**
 * Base class for creating a Ctk controller.
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
 * @package       Ctk.Controller
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Abstract CTK controller.
 *
 * @package       Ctk.Controller
 */
abstract class CtkAppController extends AppController {

/**
 * Controller name.
 *
 * @var string
 */
	public $name = 'CtkApp';

/**
 * An array containing the names of helpers this controller uses.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $helpers = array('Session', 'Cache');

/**
 * The view class to use.
 *
 * @var string
 */
	public $viewClass = 'Ctk.CtkBase';

/**
 * The layout to use
 *
 * @var string
 */
	public $layout = 'Ctk.default';
}

