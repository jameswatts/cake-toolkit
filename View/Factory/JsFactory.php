<?php
/**
 * Factory for JavaScript snippets.
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
 * @package       Ctk.View.Factory
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkFactory', 'Ctk.Lib');

/**
 * Creates a factory to generate JavaScript snippets.
 *
 * @package       Ctk.View.Factory
 *
 * @method \JsAjax Ajax($params = array())
 * @method \JsAlert Alert($params = array())
 * @method \JsCallback Callback($params = array())
 * @method \JsCode Code($params = array())
 * @method \JsConfirm Confirm($params = array())
 * @method \JsCookie Cookie($params = array())
 * @method \JsDocument Document($params = array())
 * @method \JsElement Element($params = array())
 * @method \JsEvent Event($params = array())
 * @method \JsHistory History($params = array())
 * @method \JsJson Json($params = array())
 * @method \JsLocation Location($params = array())
 * @method \JsNavigator Navigator($params = array())
 * @method \JsPrompt Prompt($params = array())
 * @method \JsRedirect Redirect($params = array())
 * @method \JsWindow Window($params = array())
 */
class JsFactory extends CtkFactory {

/**
 * Method used to setup additional resources for the factory.
 * 
 * @return void
 */
	public function setup() {}

/**
 * Method used to return an Instance of a JSElement to avoid passing non-valid variables to JS methods
 * such as binding
 * @param CtkNode $node
 * @return JsElement Element to be used for processing JS with
 */
	public function getElement(CtkNode $node) {
		return $this->Element(array('node' => $node));
	}

}

