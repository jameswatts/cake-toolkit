<?php
/**
 * Matrix view.
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
 * @package       Ctk.View.Benchmark.Ctk
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkView', 'Ctk.View');

/**
 * Matrix view.
 *
 * @package       Ctk.View.Benchmark.Ctk
 */
class MatrixView extends CtkView {

/**
 * An array of names of element factories to include.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $factories = 'Html';

/**
 * Defines the object-oriented structure of the view.
 */
	public function build() {
		$table = $this->Html->Table(array('border' => 1));
		$tbody = $this->Html->Tbody();
		for ($i = 0; $i < $this->rows; $i++) {
			$tr = $this->Html->Tr();
			for ($j = 0; $j < $this->cells; $j++) {
				$tr->add($this->Html->Td(array('text' => uniqid())));
			}
			$tbody->add($tr);
			unset($tr);
		}
		$table->add($tbody);
		$this->add($table);
		unset($table, $tbody);
	}
}

