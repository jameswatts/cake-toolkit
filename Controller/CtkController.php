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

/**
 * Home controller.
 *
 * @package       Ctk.Controller
 */
class CtkController extends CtkAppController {

/**
 * Controller name.
 *
 * @var string
 */
	public $name = 'Ctk';

/**
 * Action for choosing an option.
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout', 'Home');
		$this->set('pluginLinks', array(
			'https://github.com/jameswatts/cake-toolkit' => 'Source Code',
			'https://github.com/jameswatts/cake-toolkit/wiki' => 'Documentation',
			'https://github.com/jameswatts/cake-toolkit/issues' => 'Support',
			'test.php?plugin=Ctk' => 'Test Suite',
			'ctk/test' => 'Runtime Tests',
			'ctk/benchmark' => 'Benchmarks',
			'mailto:james.watts@cakedc.com?subject=Cake Toolkit Feedback' => 'Feedback'
		));
	}
}

