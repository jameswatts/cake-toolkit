<?php
/**
 * CSS view.
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
 * @package       Ctk.View.Test.Ctk
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkView', 'Ctk.View');

/**
 * CSS view.
 *
 * @package       Ctk.View.Test.Ctk
 */
class CssView extends CtkView {

/**
 * An array of names of element factories to include.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $factories = 'Ctk.Css';

/**
 * Defines the object-oriented structure of the view.
 */
	public function build() {
		$this->add($this->Css->Fontface(array('src' => 'local', 'family' => 'Arial')));
		$media = $this->Css->Media(array('type' => 'all'));
		$rule = $this->Css->Rule(array('selector' => '#example'));
		$rule->add($this->Css->Declaration(array(
			'property' => 'display',
			'value' => 'none'
		)));
		$media->add($rule);
		$this->add($media);
	}
}

