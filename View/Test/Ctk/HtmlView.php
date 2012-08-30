<?php
/**
 * HTML view.
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
 * HTML view.
 *
 * @package       Ctk.View.Test.Ctk
 */
class HtmlView extends CtkView {

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
		$this->add($this->Html->A(array('href' => 'http://cakephp.org', 'target' => '_blank', 'text' => 'CakePHP')));
		$this->add($this->Html->Abbr(array('text' => __('This is an abrreviation'))));
		$this->add($this->Html->Address(array('text' => __('This is an address'))));
		$this->add($this->Html->B(array('text' => __('This is bold text'))));
		$this->add($this->Html->Bdo(array('name' => 'value')));
		$this->add($this->Html->Blockquote(array('text' => __('This is a block quote'))));
		$this->add($this->Html->Br());
		$this->add($this->Html->Button(array('value' => __('This is a button'))));
		$this->add($this->Html->Cite(array('text' => __('This is a citation'))));
		$this->add($this->Html->Code(array('text' => __('This is a code block'))));
		$this->add($this->Html->Comment(array('text' => __('This is a comment'))));
		$this->add($this->Html->Del(array('text' => __('This is deleted text'))));
		$this->add($this->Html->Dfn(array('text' => __('This is a definition'))));
		$this->add($this->Html->Div(array('text' => __('This is a division'))));
		$dl = $this->Html->Dl(array('text' => __('This is a defined list')));
		$dl->add($this->Html->Dt(array('text' => __('This is a definition title'))));
		$dl->add($this->Html->Dd(array('text' => __('This is a definition data'))));
		$this->add($dl);
		$this->add($this->Html->Em(array('text' => __('This is text with emphasis'))));
		$form = $this->Html->Form(array('name' => 'example'));
			$fieldset = $this->Html->Fieldset();
			$fieldset->add($this->Html->Legend(array('text' => __('This is a legend of a fieldset'))));
			$fieldset->add($this->Html->Label(array('text' => __('This is a label'))));
			$fieldset->add($this->Html->Input(array('name' => 'text', 'type' => 'text', 'value' => __('This is a text input'))));
			$fieldset->add($this->Html->Input(array('name' => 'password', 'type' => 'password', 'value' => __('This is a password input'))));
			$fieldset->add($this->Html->Input(array('name' => 'radio', 'type' => 'radio', 'value' => 'radio')));
			$fieldset->add($this->Html->Input(array('name' => 'checkbox', 'type' => 'checkbox', 'value' => 'checkbox')));
			$fieldset->add($this->Html->Textarea(array('name' => 'textarea', 'text' => __('This is a textarea'))));
				$select = $this->Html->Select(array('name' => 'select'));
					$optgroup = $this->Html->Optgroup(array('label' => __('This is an option group')));
					$optgroup->add($this->Html->Option(array('value' => 123, 'text' => __('This is an option'))));
				$select->add($optgroup);
			$fieldset->add($select);
		$form->add($fieldset);
		$this->add($form);
		$this->add($this->Html->Hr());
		$this->add($this->Html->I(array('text' => __('This is text in italics'))));
		$this->add($this->Html->Iframe(array('name' => 'ctk', 'src' => 'https://github.com/jameswatts/cake-toolkit')));
		$this->add($this->Html->Img(array('src' => 'http://cakephp.org/img/cake-logo.png', 'alt' => 'CakePHP')));
		$this->add($this->Html->Ins(array('text' => __('This is inserted text'))));
		$this->add($this->Html->Kbd(array('text' => __('This is keyboard text'))));
		$map = $this->Html->Map();
		$map->add($this->Html->Area());
		$this->add($map);
		$this->add($this->Html->Noscript(array('text' => __('This is displayed if you do not have JavaScript enabled'))));
		$object = $this->Html->Object();
		$object->add($this->Html->Param(array('name' => 'example', 'value' => 123)));
		$this->add($object);
		$this->add($this->Html->P(array('text' => __('This is a paragraph of text'))));
		$this->add($this->Html->Pre(array('text' => __('This is preformatted text'))));
		$this->add($this->Html->Q(array('text' => __('This is a quotation'))));
		$this->add($this->Html->S(array('text' => __('This is a strike-through text'))));
		$this->add($this->Html->Samp(array('text' => __('This is a sample text'))));
		$this->add($this->Html->Small(array('text' => __('This is small text'))));
		$this->add($this->Html->Span(array('text' => __('This is a span'))));
		$this->add($this->Html->Strong(array('text' => __('This is a strong text'))));
		$this->add($this->Html->Style(array('name' => 'value')));
		$this->add($this->Html->Sub(array('text' => __('This is a sub-text'))));
		$this->add($this->Html->Sup(array('text' => __('This is a super-text'))));
		$table = $this->Html->Table(array('border' => 1));
		$table->add($this->Html->Caption(array('text' => __('This is a table caption'))));
			$colgroup = $this->Html->Colgroup();
			$colgroup->add($this->Html->Col(array('span' => 1)));
			$colgroup->add($this->Html->Col(array('span' => 1)));
			$tbody = $this->Html->Tbody();
				$tr = $this->Html->Tr();
				$tr->add($this->Html->Th(array('text' => __('This is a table header'))));
				$tr->add($this->Html->Td(array('text' => __('This is a table data'))));
			$tbody->add($tr);
		$table->add($colgroup);
		$table->add($tbody);
		$this->add($table);
		$ol = $this->Html->Ol();
		$ol->add($this->Html->Li(array('text' => __('This is an ordered list item'))));
		$this->add($ol);
		$ul = $this->Html->Ul();
		$ul->add($this->Html->Li(array('text' => __('This is an unordered list item'))));
		$this->add($ul);
		$this->add($this->Html->Var(array('text' => __('This is a variable'))));
	}
}

