<?php
/**
 * Base class for HTML elements.
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
 * @package       Ctk.View.Factory.Html.Objects
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('CtkNode', 'Ctk.Lib');
App::uses('CtkEvent', 'Ctk.Lib');

/**
 * Abstract class representing a base element in HTML.
 *
 * @package       Ctk.Factory
 */
abstract class HtmlElement extends CtkNode {

/**
 * The template to use for this object.
 *
 * @var string The name of the template.
 */
	protected $_template = 'element';

/**
 * The configuration parameters used by the template for this object.
 *
 * @var array The template configuration parameters.
 */
	protected $_params = array(
		'accesskey' => null,
		'class' => null,
		'contenteditable' => null,
		'contextmenu' => null,
		'dir' => null,
		'draggable' => null,
		'dropzone' => null,
		'events' => null,
		'hidden' => null,
		'lang' => null,
		'spellcheck' => null,
		'style' => null,
		'tabindex' => null,
		'title' => null
	);

/**
 * The type of element this object represents.
 *
 * @var string The element type.
 */
	protected $_nodeType = 'element';

/**
 * The collection of attributes for the HTML element.
 *
 * @var array The element attributes.
 */
	protected $_attributes = array();

/**
 * The collection of events for the HTML element.
 *
 * @var array The element events.
 */
	protected $_events = array();

/**
 * Determines if a given attribute has been set.
 *
 * @param string $name Name of the attribute.
 * @return boolean
 */
	final public function hasAttribute($name) {
		return isset($this->_attributes[strtolower($name)]);
	}

/**
 * Returns an attribute set on the element.
 *
 * @param string $name Name of the attribute.
 * @return mixed
 * @throws CakeException if attribute has not been previously set.
 */
	final public function getAttribute($name) {
		if ($this->hasAttribute($name)) {
			return $this->_attributes[strtolower($name)];
		}
		throw new CakeException(sprintf('Unknown attribute: %s', $name));
	}

/**
 * Sets an attribute on the element.
 *
 * @param string $name Name of the attribute.
 * @param mixed $value Value of the attribute.
 * @return HtmlElement
 */
	final public function setAttribute($name, $value = null) {
		$this->_attributes[strtolower($name)] = $value;
		return $this;
	}

/**
 * Removes a previously set attribute from the element.
 *
 * @param string $name Name of the attribute.
 * @return HtmlElement
 */
	final public function removeAttribute($name) {
		unset($this->_attributes[strtolower($name)]);
		return $this;
	}

/**
 * Removes all attributes previously set on the element.
 *
 * @return HtmlElement
 */
	final public function clearAttributes() {
		$this->_attributes = array();
		return $this;
	}

/**
 * Gets the content for the attributes for the template.
 *
 * @param array $params The params to create as attributes if a value is set.
 * @return string
 */
	final public function parseAttributes($params = array()) {
		$content = '';
		foreach ($params as $name) {
			if (isset($this->$name)) {
				$content .= ' ' . $name . '="' . str_replace('"', '\"', $this->$name) . '"';
			}
		}
		foreach ($this->_attributes as $name => $value) {
			if ($name !== 'class') {
				$content .= ' ' . $name . '="' . str_replace('"', '\"', $value) . '"';
			}
		}
		return $content;
	}

/**
 * Gets the content for the class attribute for the template.
 *
 * @return string
 */
	final public function parseClass() {
		$content = ' class="html-element html-' . $this->_nodeType;
		if ($this->__isset('class')) {
			$content .= ' ' . $this->__get('class');
		}
		if ($this->hasAttribute('class')) {
			$content .= ' ' . $this->_attributes['class'];
		}
		return $content . '"';
	}

/**
 * Gets the content for the events for the template.
 *
 * @return string
 */
	final public function parseEvents() {
		$content = '';
		if ($this->hasEvents() || (isset($this->events) && $this->_allowEvents)) {
			$content .= '<script type="text/javascript">(function(){';
		}
		if ($this->hasEvents()) {
			foreach ($this->_events as $type => $events) {
				foreach ($events as $event) {
					$code = $event->render();
					$callback = uniqid('JS_');
					$content .= "var node=document.getElementById('{$this->getId()}'),{$callback}=function(){{$code}};if(node.addEventListener){node.addEventListener('{$type}',function(){return {$callback}.apply(node,arguments);});}else if(node.attachEvent){node.attachEvent('on{$type}',function(){return {$callback}.apply(node,arguments);});}else{node['on{$type}']=function(){return {$callback}.apply(node,arguments);};}";
				}
			}
		}
		if (isset($this->events)) {
			if ($this->_allowEvents) {
				foreach ($this->events as $type => $event) {
					$code = ($event instanceof CtkEvent)? $event->render() : (string) $event;
					$callback = uniqid('JS_');
					$content .= "var node=document.getElementById('{$this->getId()}'),{$callback}=function(){{$code}};if(node.addEventListener){node.addEventListener('{$type}',function(){return {$callback}.apply(node,arguments);});}else if(node.attachEvent){node.attachEvent('on{$type}',function(){return {$callback}.apply(node,arguments);});}else{node['on{$type}']=function(){return {$callback}.apply(node,arguments);};}";
				}
			}
		}
		if ($this->hasEvents() || (isset($this->events) && $this->_allowEvents)) {
			$content .= '})();</script>';
		}
		return $content;
	}
}

