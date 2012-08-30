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
 * Called before the Controller::beforeRender(), and before 
 * the view class is loaded, and before Controller::render()
 *
 * @param Controller $controller Controller with components to beforeRender
 * @return void
 */
	public function beforeRender(Controller $controller) {
		$controller->viewClass = 'Ctk.Base';
		if (!$controller->helpers) {
			$controller->helpers = array('Session', 'Cache');
		}
		if (!$controller->layout) {
			$controller->layout = 'Ctk.default';
		}
	}
}

