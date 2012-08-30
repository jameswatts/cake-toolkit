<?php
/**
 * JavaScript view.
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
 * JavaScript view.
 *
 * @package       Ctk.View.Test.Ctk
 */
class JsView extends CtkView {

/**
 * An array of names of element factories to include.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $factories = array('Html', 'Js');

/**
 * Defines the object-oriented structure of the view.
 */
	public function build() {
		$alertButton = $this->Html->Button(array('value' => 'Alert'));
		$alertButton->addEvent('click', $this->Js->Alert(array('text' => __('This is an alert'))));
		$confirmButton = $this->Html->Button(array('value' => 'Confirm'));
		$confirmButton->addEvent('click', $this->Js->Confirm(array(
			'text' => __('This is a confirm'),
			'ok' => $this->Js->Alert(array('text' => __('Confirmed'))),
			'cancel' => $this->Js->Alert(array('text' => __('Cancelled')))
		)));
		$promptButton = $this->Html->Button(array('value' => 'Prompt'));
		$promptButton->addEvent('click', $this->Js->Prompt(array(
			'text' => __('This is a prompt'),
			'input' => $this->Js->Alert(array('code' => '"You said: " + input'))
		)));
		$locationButton = $this->Html->button(array('value' => 'Location'));
		$locationButton->addEvent('click', $this->Js->Alert(array('code' => '"Location: " + ' . $this->Js->Document()->getLocation()->getHref())));
		$useragentButton = $this->Html->button(array('value' => 'User Agent'));
		$useragentButton->addEvent('click', $this->Js->Alert(array('code' => '"User Agent: " + ' . $this->Js->Window()->getNavigator()->getUserAgent())));
		$span = $this->Html->Span(array('text' => 'Hello World'));
		$elementButton = $this->Html->button(array('value' => 'Show/Hide Element'));
		$elementButton->addEvent('click', $this->Js->Element(array('node' => $span))->toggle());
		$this->add($alertButton);
		$this->add($confirmButton);
		$this->add($promptButton);
		$this->add($locationButton);
		$this->add($useragentButton);
		$this->add($elementButton);
		$this->add($span);
	}
}

