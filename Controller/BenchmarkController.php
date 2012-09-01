<?php
/**
 * Benchmark controller for the Cake Toolkit.
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
 * Benchmark controller.
 *
 * @package       Ctk.Controller
 */
class BenchmarkController extends CtkAppController {

/**
 * Controller name.
 *
 * @var string
 */
	public $name = 'Benchmark';

/**
 * The layout to use.
 *
 * @var string
 */
	public $layout = 'Ctk.Xml/default';

/**
 * Action for choosing a benchmark.
 *
 * @return void
 */
	public function index() {
		$this->layout = 'Ctk.default'; // switch layout to use CTK default
		$this->set('benchmarkLinks', array(
			$this->here . ((substr($this->here, -1) == '/')? '' : '/') . 'single' => 'Single 1 Dimension',
			$this->here . ((substr($this->here, -1) == '/')? '' : '/') . 'lineal' => 'Lineal Relations',
			$this->here . ((substr($this->here, -1) == '/')? '' : '/') . 'exponential' => 'Exponential Relations',
			$this->here . ((substr($this->here, -1) == '/')? '' : '/') . 'matrix' => 'Data Matrix'
		));
	}

/**
 * Action for testing one dimensional XML node generation.
 *
 * @param int $count The number of nodes to create. Defaults to 99.
 * @return void
 */
	public function single($count = 99) {
		$this->set('title_for_layout', 'Benchmark - Single 1 Dimension');
		$this->set('count', (int) $count);
	}

/**
 * Action for testing multi-dimensional lineal XML node generation.
 *
 * @param int $count The number of nodes to create recursively. Defaults to 99.
 * @return void
 */
	public function lineal($count = 99) {
		$this->set('title_for_layout', 'Benchmark - Lineal Relations');
		$this->set('count', (int) $count);
	}

/**
 * Action for testing multi-dimensional exponential XML node generation.
 * 
 * The following shows the # of XML nodes created based on a value of $count from 1-9.
 *
 * 1 = 1 node
 * 2 = 3 nodes
 * 3 = 9 nodes
 * 4 = 33 nodes
 * 5 = 153 nodes
 * 6 = 873 nodes
 * 7 = 5913 nodes
 * 8 = 46233 nodes
 * 9 = 409113 nodes
 * 
 * @param int $count The exponential factor to use to create the XML nodes. Defaults to 6.
 * @return void
 */
	public function exponential($count = 6) { // by default this will generate 873 nodes
		$this->set('title_for_layout', 'Benchmark - Exponential Relations');
		$this->set('count', (int) $count);
	}

/**
 * Action for testing a matrix layout using HTML nodes.
 *
 * @param int $rows The number of rows to generate. Defaults to 999.
 * @param int $cells The number of cells to generate. Defaults to 9.
 * @return void
 */
	public function matrix($rows = 999, $cells = 9) {
		$this->layout = 'Ctk.Html/html5'; // switch layout to use HTML5
		$this->set('title_for_layout', 'Cake Toolkit (CTK) - Benchmark - Data Matrix');
		$this->set('rows', (int) $rows);
		$this->set('cells', (int) $cells);
	}
}

