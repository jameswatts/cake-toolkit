<?php
/**
 * Home controller for the Cake Toolkit.
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

App::uses('CtkAppController', 'Ctk.Controller');

class TestingController extends CtkAppController {
	

}

class CtkAppControllerTest extends CakeTestCase {

/**
 * Test if controller was enable to load AppController
 * 
 * @return void
 */
	public function testInstanceOfAppController() {
		$controller = new TestingController();
		$this->assertInstanceOf('AppController', $controller);
		$this->assertInstanceOf('CtkAppController', $controller);
	}

}