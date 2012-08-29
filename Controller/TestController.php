<?php
/**
 * Test controller for the Cake Toolkit.
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

/**
 * Test controller.
 *
 * @package       Ctk.Controller
 */
class TestController extends CtkAppController {

/**
 * Controller name.
 *
 * @var string
 */
	public $name = 'Test';

/**
 * Action for choosing a test.
 *
 * @return void
 */
	public function index() {
		$this->set('testLinks', array(
			'test/xml' => 'XML Nodes Test',
			'test/html' => 'HTML Elements Test',
			'test/css' => 'CSS Syntax Test',
			'test/js' => 'JavaScript API Test',
			'test/events' => 'Client Events Test'
		));
	}

/**
 * Action for testing the XML factory.
 *
 * @return void
 */
	public function xml() {
		$this->set('title_for_layout', 'Test - XML Nodes');
	}

/**
 * Action for testing the HTML factory.
 *
 * @return void
 */
	public function html() {
		$this->set('title_for_layout', 'Test - HTML Elements');
	}

/**
 * Action for testing the CSS factory.
 *
 * @return void
 */
	public function css() {
		$this->set('title_for_layout', 'Test - CSS Syntax');
	}

/**
 * Action for testing the JavaScript factory.
 *
 * @return void
 */
	public function js() {
		$this->set('title_for_layout', 'Test - JavaScript API');
	}

/**
 * Action for testing CTK events.
 *
 * @return void
 */
	public function events() {
		$this->set('title_for_layout', 'Test - Client Events');
	}
}

