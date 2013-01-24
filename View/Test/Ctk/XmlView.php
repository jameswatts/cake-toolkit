<?php
/**
 * XML view.
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
 * XML view.
 *
 * @package       Ctk.View.Test.Ctk
 */
class XmlView extends CtkView {

/**
 * An array of names of element factories to include.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $factories = 'Ctk.Xml';

/**
 * The MIME-type of the output content.
 *
 * @var string The MIME-type to use.
 */
	public $contentType = 'text/xml';

/**
 * Defines the object-oriented structure of the view.
 */
	public function build() {
		$books = $this->Xml->Node(array('name' => 'books'));
		for ($i = 0; $i < count($this->booksCatalog); $i++) {
			$book = $this->Xml->Node(array('name' => 'book', 'value' => $this->booksCatalog[$i]['title']));
			$book->setAttribute('author', $this->booksCatalog[$i]['author']);
			$book->setAttribute('isbn', $this->booksCatalog[$i]['isbn']);
			$books->add($book);
		}
		$this->add($books);
	}
}
