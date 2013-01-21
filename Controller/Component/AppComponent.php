<?php
/**
 * Component for providing a AppController with Ctk capabilities.
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
 * @package       Ctk.Controller.Component
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Component', 'Controller');

class AppComponent extends Component {

/**
 * An array containing the names of helpers this controller uses. The array elements should
 * not contain the "Helper" part of the classname.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $helpers = null;

/**
 * The name of the layout file to render the view inside of. The name specified
 * is the filename of the layout in /app/View/Layouts without the .ctp
 * extension.
 *
 * @var string
 */
	public $layout = null;

/**
 * Used to define methods a controller that will be cached. To cache a
 * single action, the value is set to an array containing keys that match
 * action names and values that denote cache expiration times (in seconds).
 *
 * $cacheAction can also be set to a strtotime() compatible string. This
 * marks all the actions in the controller for view caching.
 *
 * @var mixed
 */
	public $cacheAction = false;

/**
 * Determines which actions of the controller should not have their views rendered 
 * using the `Ctk` base view. Can be a single action as a string, or an array of 
 * actions to ignore.
 *
 * @var mixed
 */
	public $ignoreAction = null;

/**
 * Called before the Controller::beforeRender(), and before 
 * the view class is loaded, and before Controller::render()
 *
 * @param Controller $controller Controller with components to beforeRender
 * @return void
 */
	public function beforeRender(Controller $controller) {
		if (!$this->ignoreAction || ((is_string($this->ignoreAction) && $this->ignoreAction != $controller->action) || (is_array($this->ignoreAction) && !in_array($controller->action, $this->ignoreAction)))) {
			$controller->viewClass = 'Ctk.Base';
			if (is_array($this->helpers)) {
				if (!is_array($controller->helpers)) {
					$controller->helpers = $this->helpers;
				} else {
					array_merge($controller->helpers, $this->helpers);
				}
			}
			if (is_string($this->layout)) {
				$controller->layout = $this->layout;
			} else {
				$controller->layout = 'Ctk.default';
			}
			if (is_array($this->cacheAction)) {
				if (!is_array($controller->cacheAction)) {
					$controller->cacheAction = $this->cacheAction;
				} else {
					array_merge($controller->cacheAction, $this->cacheAction);
				}
			}
		}
	}
}

