<?php
/**
 * Index view.
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
 * @package       Ctk.View.Ctk.Ctk
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkView', 'Ctk.View');

/**
 * Index view.
 *
 * @package       Ctk.View.Ctk.Ctk
 */
class IndexView extends CtkView {

/**
 * An array of names of element factories to include.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $factories = array('Html', 'Css', 'Js');

/**
 * Defines the object-oriented structure of the view.
 */
	public function build() {
		$this->add($this->Html->H2(array('text' => __('Cake Toolkit Home'))));
		$this->add($this->Html->P(array('text' => __('Welcome to the Cake Toolkit home. From here you can find everything related to CTK.'))));
		$pluginList = $this->Html->Ul();
		foreach ($this->pluginLinks as $url => $text) {
			$pluginListItem = $this->Html->Li();
			$pluginListItem->add($this->Html->A(array('href' => $url, 'text' => $text, 'target' => '_blank')));
			$pluginList->add($pluginListItem);
		}
		$this->add($pluginList);
	}
}

