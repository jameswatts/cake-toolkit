<?php
/**
 * Base class for creating a Ctk view.
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
 * @package       Ctk.View
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Set', 'Utility');
App::uses('HelperCollection', 'View');
App::uses('BaseView', 'Ctk.View');
App::uses('CtkHelper', 'Ctk.View');
App::uses('CtkBuildable', 'Ctk.Lib');
App::uses('CtkRenderable', 'Ctk.Lib');
App::uses('CtkObject', 'Ctk.Lib');
App::uses('CtkFactory', 'Ctk.Lib');
App::uses('CtkNode', 'Ctk.Lib');
App::uses('CtkElement', 'Ctk.Lib');

/**
 * View, the V in the MVC triad. View interacts with Helpers and view variables passed
 * in from the controller to render the results of the controller action.  Often this is HTML,
 * but can also take the form of JSON, XML, PDF's or streaming files.
 *
 * CakePHP uses a two-step-view pattern.  This means that the view content is rendered first,
 * and then inserted into the selected layout.  This also means you can pass data from the view to the
 * layout using `$this->set()`
 *
 * @package       Ctk.View
 */
abstract class CtkView extends CtkObject {

/**
 * An array of names of element factories to include.
 *
 * @var mixed A single name as a string or a list of names as an array.
 */
	public $factories = array('Ctk.Html', 'Ctk.Css', 'Ctk.Js');

/**
 * The name of the renderer to render the content.
 *
 * @var string The name of the renderer to use.
 */
	public $renderer = 'Ctk.Web';

/**
 * The optional name of a processor to post-process the content.
 *
 * @var string The name of the post-processor to use.
 */
	public $processor = null;

/**
 * The MIME-type of the output content.
 *
 * @var string The MIME-type to use.
 */
	public $contentType = 'text/html';

/**
 * The character set of the output content.
 *
 * @var string The character set to use.
 */
	public $charset = 'UTF-8';

/**
 * The instance of the content renderer.
 *
 * @var CtkRenderer
 */
	protected $_renderer = null;

/**
 * The instance of the post-processor.
 *
 * @var CtkProcessor
 */
	protected $_processor = null;

/**
 * The base view object.
 *
 * @var BaseView
 */
	protected $_baseView = null;

/**
 * Factories defined to use with the view.
 *
 * @var array
 */
	protected $_factories = array();

/**
 * The helpers available.
 *
 * @var array
 */
	protected $_helpers = array();

/**
 * Variables for the view.
 *
 * @var array
 */
	protected $_viewVars = array();

/**
 * The blocks to be added.
 *
 * @var array
 */
	protected $_blocks = array();

/**
 * An array of base child nodes on the view object.
 *
 * @var array An array of child nodes.
 */
	protected $_childNodes = array();

/**
 * Contructor
 *
 * Sets up the factories to use for elements and populates the view variables.
 * 
 * Also calls the CtkView::build() method to generate the object-oriented structure.
 * 
 * @param BaseView $baseView The base view object.
 * @throws CakeException if there is an error in the view.
 */
	final public function __construct(BaseView $baseView) {
		$this->_baseView = $baseView;
		if (is_string($this->renderer)) {
			list($plugin, $name) = pluginSplit($this->renderer);
			$class = $name . 'Renderer';
			App::uses($class, ((!empty($plugin))? $plugin . '.' : '') . 'View/Renderer');
			if (!class_exists($class)) {
				throw new CakeException(sprintf('Unknown renderer: %s', $class));
			}
			$this->_renderer = new $class($this->renderer, $this);
		} else {
			throw new CakeException('No renderer defined');
		}
		if (is_string($this->processor)) {
			list($plugin, $name) = pluginSplit($this->processor);
			$class = $name . 'Processor';
			App::uses($class, ((!empty($plugin))? $plugin . '.' : '') . 'View/Processor');
			if (!class_exists($class)) {
				throw new CakeException(sprintf('Unknown processor: %s', $class));
			}
			$this->_processor = new $class($this->processor, $this);
		}
		$this->_factories = (empty($this->factories))? array() : Set::normalize((array) $this->factories);
		foreach ($this->_factories as $key => $value) {
			$isAlias = (is_array($value) && isset($value['className']));
			list($plugin, $name) = pluginSplit(($isAlias)? $value['className'] : $key);
			$class = $name . 'Factory';
			App::uses($class, ((!empty($plugin))? $plugin . '.' : '') . 'View/Factory');
			if (!class_exists($class)) {
				throw new CakeException(sprintf('Unknown factory: %s', $class));
			}
			$property = ($isAlias)? $key : $name;
			$this->$property = new $class($this, $name, $plugin, $value);
			$this->$property->setup();
		}
		$helpers = HelperCollection::normalizeObjectArray($this->_baseView->helpers);
		foreach ($helpers as $name => $properties) {
			list($plugin, $class) = pluginSplit($properties['class']);
			$this->_helpers[$class] = new CtkHelper($class, $this->_baseView->Helpers->load($properties['class'], $properties['settings']), $this);
		}
		$this->build();
	}

/**
 * Returns a view variable or helper from the controller.
 *
 * @param string $name Name of view variable.
 * @return mixed
 * @throws CakeException if view variable is not found.
 */
	final public function __get($name) {
		if (isset($this->_helpers[(string) $name])) {
			return $this->_helpers[(string) $name];
		}
		if (isset($this->_baseView->viewVars[(string) $name])) {
			return $this->_baseView->viewVars[(string) $name];
		}
		throw new CakeException(sprintf('Unknown variable or helper: %s', $name));
	}

/**
 * Adds a factory to the view object.
 *
 * @param string $name Name of the factory.
 * @param CtkFactory $factory The factory object.
 * @throws CakeException if factory has not been previously included.
 */
	final public function __set($name, $factory) {
		if (is_object($factory) && $factory instanceof CtkFactory) {
			$this->$name = $factory;
		} else {
			throw new CakeException(sprintf('Invalid factory: %s', $name));
		}
	}

/**
 * Determines if a view variable has been defined.
 *
 * @param string $name Name of the view variable.
 * @return mixed
 */
	final public function __isset($name) {
		return (isset($this->_baseView->viewVars[(string) $name]));
	}

/**
 * Returns the factories for this view.
 *
 * @return array
 */
	final public function getFactories() {
		return $this->_factories;
	}

/**
 * Returns the renderer for this view.
 *
 * @return CtkRenderer
 */
	final public function getRenderer() {
		return $this->_renderer;
	}

/**
 * Returns the post-processor for this view.
 *
 * @return CtkProcessor
 */
	final public function getProcessor() {
		return $this->_processor;
	}

/**
 * Returns the base view object.
 *
 * @return BaseView
 */
	final public function getBaseView() {
		return $this->_baseView;
	}

/**
 * Adds a node to the children of the view object.
 *
 * @param CtkBuildable $node The node object, must be buildable.
 * @return CtkNode
 */
	final public function add(CtkBuildable $node) {
		$node->setParent(null);
		$this->_childNodes[] = $node;
		return $node;
	}

/**
 * Returns the specified Element.
 * 
 * This realizes the concept of Elements, (or "partial layouts") and the $params array is used to send
 * data to be used in the element. Elements can be cached improving performance by using the `cache` option.
 * 
 * @param string $name Name of template file in the/app/View/Elements/ folder,
 *   or `MyPlugin.template` to use the template element from MyPlugin.  If the element
 *   is not found in the plugin, the normal view path cascade will be searched.
 * @param array $data Array of data to be made available to the rendered view (i.e. the Element)
 * @param array $options Array of options. Possible keys are:
 * - `cache` - Can either be `true`, to enable caching using the config in View::$elementCache. Or an array
 *   If an array, the following keys can be used:
 *   - `config` - Used to store the cached element in a custom cache configuration.
 *   - `key` - Used to define the key used in the Cache::write().  It will be prefixed with `element_`
 * - `plugin` - Load an element from a specific plugin.  This option is deprecated, see below.
 * - `callbacks` - Set to true to fire beforeRender and afterRender helper callbacks for this element.
 *   Defaults to false.
 * @return CtkElement
 */
	final public function element($name, $data = array(), $options = array()) {
		return new CtkElement($this, $name, $data, $options);
	}

/**
 * Set the node for a block. This will overwrite any existing nodes.
 *
 * @param string $name Name of the block
 * @param CtkRenderable $node The node object, must be renderable.
 * @return CtkView
 */
	final public function assign($name, CtkRenderable $node) {
		$this->_blocks[(string) $name] = array($node);
		return $this;
	}

/**
 * Append a node to an existing or new block. Appending to a new block will create the block.
 *
 * @param string $name Name of the block
 * @param CtkRenderable $node The node object, must be renderable.
 * @return CtkView
 */
	final public function append($name, CtkRenderable $node) {
		$this->_blocks[(string) $name][] = $node;
		return $this;
	}

/**
 * Fetch the nodes for a block. If a block is empty or undefined an empty array will be returned.
 *
 * @param string $name Name of the block
 * @return array
 */
	final public function fetch($name) {
		if (isset($this->_blocks[(string) $name])) {
			return $this->_blocks[(string) $name];
		} else {
			return array();
		}
	}

/**
 * Fetch all the defined blocks.
 *
 * @return array
 */
	final public function fetchAll() {
		return $this->_blocks;
	}

/**
 * Renders the templates recursively for all nodes and child nodes, including nodes in view blocks.
 *
 * @return string Rendered content
 */
	final public function render() {
		foreach ($this->_blocks as $block => $nodes) {
			foreach ($nodes as $node) {
				$this->_baseView->append((string) $block, $node->render());
			}
		}
		$content = '';
		foreach ($this->_childNodes as $node) {
			$content .= $node->render();
		}
		return $content;
	}

/**
 * Runs the registered post processor after rendering.
 *
 * @param string $content The rendered content.
 * @return string Processed content
 */
	final public function process($content) {
		if (isset($this->_processor)) {
			$content = $this->_processor->process($content);
		}
		return $content;
	}

/**
 * Abstract method used to define the object-oriented structure of the view.
 *
 * The method may call subsequent methods which contain blocks of nodes or process content.
 */
	abstract public function build();
}

