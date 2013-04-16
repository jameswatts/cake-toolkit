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
App::uses('CtkBaseView', 'Ctk.View');
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
 * @see CtkView::addFactory()
 */
	public $factories = array();

/**
 * An array containing the names of helpers this view uses.
 *
 * @var mixed A single name as a string or a list of names as an array.
 * @see CtkView::addHelper()
 */
	public $helpers = array();

/**
 * The name of the renderer to render the content.
 *
 * @var string The name of the renderer to use.
 * @see CtkView::setRenderer()
 */
	public $renderer = 'Ctk.Web';

/**
 * The optional name of a processor to post-process the content.
 *
 * @var string The name of the post-processor to use.
 * @see CtkView::setProcessor()
 */
	public $processor = null;

/**
 * The MIME-type of the output content.
 *
 * @var string The MIME-type to use.
 * @see CtkView::setContentType()
 */
	public $contentType = 'text/html';

/**
 * The character set of the output content.
 *
 * @var string The character set to use.
 * @see CtkView::setCharset()
 */
	public $charset = 'UTF-8';

/**
 * Theme name.
 *
 * @var string
 * @see CtkView::setTheme()
 */
	public $theme = null;

/**
 * Name of the layout to use.
 *
 * @var string
 * @see CtkView::setLayout()
 */
	public $layout = null;

/**
 * Turns on or off Cake's conventional mode of applying layout files. On by default.
 * Setting to off means that layouts will not be automatically applied to rendered views.
 *
 * @var boolean
 */
	public $autoLayout = true;

/**
 * Title for the layout, resolves to $title_for_layout.
 *
 * @var string
 * @see CtkView::setTitle()
 */
	public $title = null;

/**
 * The Cache configuration View will use to store cached elements. Changing this will change
 * the default configuration elements are stored under. You can also choose a cache config
 * per element.
 *
 * @var string
 * @see View::element()
 */
	public $elementCache = null;

/**
 * Element cache settings
 *
 * @var array
 * @see View::_elementCache();
 * @see View::_renderElement
 */
	public $elementCacheSettings = null;

/**
 * Default variables for the view.
 *
 * @var array
 */
	public $viewVars = array();

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
 * @var CtkBaseView
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
 * Sets up the factories and helpers to use and populates the view variables.
 * 
 * @param CtkBaseView $baseView The base view object.
 * @throws CakeException if there is an error in the view.
 */
	final public function __construct(CtkBaseView $baseView) {
		parent::__construct();
		$this->_baseView = $baseView;
		$this->_inheritArrayProperties(array('factories', 'helpers', 'viewVars'));
		if (is_string($this->renderer)) {
			$this->setRenderer($this->renderer);
		} else if (is_array($this->renderer)) {
			foreach ($this->renderer as $renderer => $settings) {
				$this->setRenderer($renderer, $settings);
			}
		} else {
			throw new CakeException('No renderer defined');
		}
		if (isset($this->processor)) {
			if (is_string($this->processor)) {
				$this->setProcessor($this->processor);
			} else if (is_array($this->processor)) {
				foreach ($this->processor as $processor => $settings) {
					$this->setProcessor($processor, $settings);
				}
			}
		}
		$this->_factories = (empty($this->factories))? array() : Set::normalize((array) $this->factories);
		foreach ($this->_factories as $factory => $settings) {
			$this->addFactory($factory, $settings);
		}
		$helpers = HelperCollection::normalizeObjectArray(array_merge($this->_baseView->helpers, (empty($this->helpers))? array() : Set::normalize((array) $this->helpers)));
		foreach ($helpers as $name => $properties) {
			$this->addHelper($properties['class'], $properties['settings']);
		}
		if (is_string($this->contentType)) {
			$this->_baseView->response->type($this->contentType);
		}
		if (is_string($this->charset)) {
			$this->_baseView->response->charset($this->charset);
		}
		if (is_string($this->theme)) {
			$this->_baseView->theme = $this->theme;
		}
		if (is_string($this->layout)) {
			$this->_baseView->layout = $this->layout;
		}
		if (!$this->autoLayout) {
			$this->_baseView->autoLayout = false;
		}
		if (is_string($this->title)) {
			$this->viewVars['title_for_layout'] = $this->title;
		}
		if (is_string($this->elementCache)) {
			$this->_baseView->elementCache = $this->elementCache;
		}
		if (is_array($this->elementCacheSettings)) {
			$this->_baseView->elementCacheSettings = $this->elementCacheSettings;
		}
		$this->_baseView->viewVars = array_merge((array) $this->_baseView->viewVars, (array) $this->viewVars);
	}

/**
 * Returns a helper or view variable from the controller.
 *
 * @param string $name Name of the helper or view variable.
 * @return mixed
 * @throws CakeException if helper or view variable is not found.
 */
	final public function __get($name) {
		if (isset($this->_helpers[(string) $name])) {
			return $this->_helpers[(string) $name];
		}
		if (isset($this->_baseView->viewVars[(string) $name])) {
			return $this->_baseView->viewVars[(string) $name];
		}
		throw new CakeException(sprintf('Unknown helper or view variable: %s', $name));
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
 * Adds a factory for use in this view.
 *
 * @param string $factory The factory to load.
 * @param array $settings The optional settings for the factory.
 * @return CtkView
 */
	final public function addFactory($factory, $settings = array()) {
		$isAlias = (is_array($settings) && isset($settings['className']));
		list($plugin, $name) = pluginSplit(($isAlias)? $settings['className'] : $factory);
		$class = $name . 'Factory';
		App::uses($class, ((!empty($plugin))? $plugin . '.' : '') . 'View/Factory');
		if (!class_exists($class)) {
			throw new CakeException(sprintf('Unknown factory: %s', $class));
		}
		$property = ($isAlias)? $factory : $name;
		$this->$property = new $class($this, $name, $plugin, $settings);
		$this->$property->setup();
		$this->$property->load();
		return $this;
	}

/**
 * Returns the helpers loaded for this view.
 *
 * @return array
 */
	final public function getHelpers() {
		return $this->_helpers;
	}

/**
 * Adds a helper for use in this view.
 *
 * @param string $helper The helper to load.
 * @param array $settings The optional settings for the helper.
 * @return CtkView
 */
	final public function addHelper($helper, $settings = array()) {
		list($plugin, $class) = pluginSplit($helper);
		$this->_helpers[$class] = new CtkHelper($class, $this->_baseView->Helpers->load($helper, $settings), $this);
		return $this;
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
 * Sets the renderer for this view.
 *
 * @param string $renderer The renderer to use.
 * @param array $settings The optional settings for the renderer.
 * @return CtkView
 */
	final public function setRenderer($renderer, $settings = array()) {
		$this->renderer = (string) $renderer;
		$isAlias = (is_array($settings) && isset($settings['className']));
		list($plugin, $name) = pluginSplit(($isAlias)? $settings['className'] : $renderer);
		$class = $name . 'Renderer';
		App::uses($class, ((!empty($plugin))? $plugin . '.' : '') . 'View/Renderer');
		if (!class_exists($class)) {
			throw new CakeException(sprintf('Unknown renderer: %s', $class));
		}
		$this->_renderer = new $class($this, $name, $plugin, $settings);
		$this->_renderer->setup();
		$this->_renderer->load();
		return $this;
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
 * Sets the post-processor for this view.
 *
 * @param string $processor The post-processor to use.
 * @param array $settings The optional settings for the processor.
 * @return CtkView
 */
	final public function setProcessor($processor, $settings = array()) {
		$this->processor = (string) $processor;
		$isAlias = (is_array($settings) && isset($settings['className']));
		list($plugin, $name) = pluginSplit(($isAlias)? $settings['className'] : $processor);
		$class = $name . 'Processor';
		App::uses($class, ((!empty($plugin))? $plugin . '.' : '') . 'View/Processor');
		if (!class_exists($class)) {
			throw new CakeException(sprintf('Unknown processor: %s', $class));
		}
		$this->_processor = new $class($this, $name, $plugin, $settings);
		$this->_processor->setup();
		$this->_processor->load();
		return $this;
	}

/**
 * Returns the base view object.
 *
 * @return CtkBaseView
 */
	final public function getBaseView() {
		return $this->_baseView;
	}

/**
 * Returns the request object.
 *
 * @return CakeRequest
 */
	final public function getRequest() {
		return $this->_baseView->request;
	}

/**
 * Returns the response object.
 *
 * @return CakeResponse
 */
	final public function getResponse() {
		return $this->_baseView->response;
	}

/**
 * Returns the arguments sent with the URL.
 *
 * @return array
 */
	final public function getArguments() {
		return $this->_baseView->passedArgs;
	}

/**
 * Returns the current errors for the model validation.
 *
 * @return array
 */
	final public function getValidationErrors() {
		return $this->_baseView->validationErrors;
	}

/**
 * Returns the Content-Type used for this view.
 *
 * @return string
 */
	final public function getContentType() {
		return $this->contentType;
	}

/**
 * Sets the Content-Type to use for this view.
 *
 * @param string $contentType The Content-Type to use.
 * @return CtkView
 */
	final public function setContentType($contentType) {
		$this->contentType = (string) $contentType;
		$this->_baseView->response->type($this->contentType);
		return $this;
	}

/**
 * Returns the character set used for this view.
 *
 * @return string
 */
	final public function getCharset() {
		return $this->charset;
	}

/**
 * Sets the character set to use for this view.
 *
 * @param string $charset The character set to use.
 * @return CtkView
 */
	final public function setCharset($charset) {
		$this->charset = (string) $charset;
		$this->_baseView->response->charset($this->charset);
		return $this;
	}

/**
 * Returns the theme used for this view.
 *
 * @return string
 */
	final public function getTheme() {
		return $this->_baseView->theme;
	}

/**
 * Sets the theme to use for this view.
 *
 * @param string $theme The theme to use.
 * @return CtkView
 */
	final public function setTheme($theme) {
		$this->_baseView->theme = $this->theme = (string) $theme;
		return $this;
	}

/**
 * Returns the layout used for this view.
 *
 * @return string
 */
	final public function getLayout() {
		return $this->_baseView->layout;
	}

/**
 * Sets the layout to use for this view.
 *
 * @param string $layout The layout to use.
 * @return CtkView
 */
	final public function setLayout($layout) {
		$this->_baseView->layout = $this->layout = (string) $layout;
		return $this;
	}

/**
 * Returns the title for the layout.
 *
 * @return string
 */
	final public function getTitle() {
		return (array_key_exists('title_for_layout', $this->_baseView->viewVars))? $this->_baseView->viewVars['title_for_layout'] : '';
	}

/**
 * Sets the title for the layout.
 *
 * @param string $title The title to set for the layout.
 * @return CtkView
 */
	final public function setTitle($title) {
		$this->_baseView->viewVars['title_for_layout'] = $this->title = (string) $title;
		return $this;
	}

/**
 * Determines if the view has child nodes.
 *
 * @return boolean
 */
	final public function hasChildren() {
		return (count($this->_childNodes) > 0);
	}

/**
 * Determines if a node is a child of the view.
 *
 * @return boolean
 */
	final public function hasChild(CtkBuildable $node) {
		if ($this !== $node) {
			for ($i = 0; $i < count($this->_childNodes); $i++) {
				if ($this->_childNodes[$i] === $node) {
					return true;
				}
			}
		}
		return false;
	}

/**
 * Returns the child nodes of the view as an array.
 *
 * @return array
 */
	final public function getChildren() {
		return $this->_childNodes;
	}

/**
 * Returns the first child node of the view.
 *
 * @return CtkBuildable or null if no children exist
 */
	final public function getFirst() {
		if ($this->hasChildren()) {
			return $this->_childNodes[0];
		}
		return null;
	}

/**
 * Returns the last child node of the view.
 *
 * @return CtkBuildable or null if no children exist
 */
	final public function getLast() {
		if ($this->hasChildren()) {
			return $this->_childNodes[count($this->_childNodes)-1];
		}
		return null;
	}

/**
 * Returns the previous node before this node in the view.
 *
 * @return CtkBuildable or null if no node before this node
 */
	final public function getPrevious() {
		$children = $this->getChildren();
		$count = count($children);
		if ($count > 1) {
			for ($i = 0; $i < $count; $i++) {
				if ($children[$i] === $this) {
					return ($i < 1)? null : $children[$i-1];
				}
			}
		}
		return null;
	}

/**
 * Returns the next node after this node in the view.
 *
 * @return CtkBuildable or null if no node after this node
 */
	final public function getNext() {
		$count = count($this->_childNodes);
		if ($count > 1) {
			for ($i = 0; $i < $count; $i++) {
				if ($this->_childNodes[$i] === $this) {
					return ($i == $count-1)? null : $this->_childNodes[$i+1];
				}
			}
		}
		return null;
	}

/**
 * Executes a callback function on each of the child nodes.
 *
 * @param callable $callback The callback function to use.
 * @param array $data The optional array of data to be used by the callback function.
 * @param boolean|int $deep Determines if applies to all children of children, or if an integer, defines the max depth.
 * @return CtkBuildable
 * @throws CakeException if the callback function is not callable.
 */
	final public function each($callback, array $data = array(), $deep = false) {
		if (!is_callable($callback)) {
			throw new CakeException('Callback function must be callable');
		}
		if ($this->hasChildren()) {
			for ($i = 0; $i < count($this->_childNodes); $i++) {
				$break = call_user_func_array($callback, array($this->_childNodes[$i], $this, $this, $data, $i));
				if (!is_null($break) && $break === true) {
					break;
				}
				if ($deep && $this->_childNodes[$i]->hasChildren()) {
					$this->_childNodes[$i]->each($callback, $data, (is_bool($deep))? true : $deep-1);
				}
			}
		}
		return $this;
	}

/**
 * Adds a node to the children of the view object.
 *
 * @param CtkBuildable $node The node object, must be buildable.
 * @return CtkBuildable
 */
	final public function add(CtkBuildable $node) {
		$node->setParent(null);
		$this->_childNodes[] = $node;
		return $node;
	}

/**
 * Adds a node before the specified node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $before Node to add before.
 * @return CtkBuildable
 * @throws CakeException if the specified node is not a child.
 */
	final public function addBefore(CtkBuildable $node, CtkBuildable $before) {
		if ($this === $node || $this === $before) {
			throw new CakeException('Cannot reference view as a child');
		}
		if ($this->hasChild($node)) {
			$this->removeChild($node);
		}
		for ($i = 0; $i < count($this->_childNodes); $i++) {
			if ($this->_childNodes[$i] === $before) {
				array_splice($this->_childNodes, $i-1, 0, $node);
				return $node;
			}
		}
		throw new CakeException(sprintf('Unknown child %s', get_class($before)));
	}

/**
 * Adds a node after the specified node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $after Node to add after.
 * @return CtkBuildable
 * @throws CakeException if the specified node is not a child.
 */
	final public function addAfter(CtkBuildable $node, CtkBuildable $after) {
		if ($this === $node || $this === $after) {
			throw new CakeException('Cannot reference view as a child');
		}
		if ($this->hasChild($node)) {
			$this->removeChild($node);
		}
		for ($i = 0; $i < count($this->_childNodes); $i++) {
			if ($this->_childNodes[$i] === $after) {
				array_splice($this->_childNodes, $i+1, 0, $node);
				return $node;
			}
		}
		throw new CakeException(sprintf('Unknown child %s', get_class($after)));
	}

/**
 * Adds an array of nodes to the view as children.
 *
 * @param array $nodes The child nodes.
 * @return CtkView
 * @throws CakeException if an object in the array does not implement CtkBuildable.
 */
	final public function addMany(array $nodes) {
		foreach ($nodes as $name => &$node) {
			if ($node instanceof CtkBuildable) {
				$this->add($node);
			} else {
				throw new CakeException(sprintf('Unknown child %s', (is_object($node))? get_class($node) : (string) $node));
			}
		}
		return $this;
	}

/**
 * Inherits the children of a node.
 *
 * @param CtkBuildable $node The node to inherit from.
 * @param boolean $prepend Nodes should be added before existing children.
 * @return CtkView
 */
	final public function addFrom(CtkBuildable $node, $prepend = false) {
		$count = count($this->_childNodes);
		if ($prepend && $count > 0) {
			$first = $node->getFirst();
			for ($i = $count-1; $i >= 0; $i--) {
				$first = $this->addBefore($this->_childNodes[$i], $first);
			}
		} else {
			for ($i = 0; $i < $count; $i++) {
				$this->add($this->_childNodes[$i]);
			}
		}
		return $this;
	}

/**
 * Conditionally adds a node to the view as a child.
 *
 * @param boolean $condition The boolean value or expression.
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable or null if condition is false
 */
	final public function addIf($condition = false, CtkBuildable $node) {
		return ((bool) $condition === true)? $this->add($node) : null;
	}

/**
 * Adds a node to the view as a child while the callback function returns a node.
 *
 * @param callable $callback The callback function to return nodes.
 * @param array $data The optional array of data to be used by the callback function.
 * @return CtkView
 * @throws CakeException if the callback function is not callable.
 */
	final public function addWhile($callback, array $data = array()) {
		if (!is_callable($callback)) {
			throw new CakeException('Callback function must be callable');
		}
		$i = 0;
		$node = call_user_func_array($callback, array($this, $this, $data, $i));
		while (is_object($node) && $node instanceof CtkBuildable) {
			$this->add($node);
			$node = call_user_func_array($callback, array($this, $this, $data, ++$i));
		}
		return $this;
	}

/**
 * Replaces the specified node with the given node.
 *
 * @param CtkBuildable $node Child node.
 * @param CtkBuildable $replace Node to replace.
 * @return CtkView
 * @throws CakeException if the specified node is not a child.
 */
	final public function replaceChild(CtkBuildable $node, CtkBuildable $replace) {
		if ($this === $node || $this === $replace) {
			throw new CakeException('Cannot reference view as a child');
		}
		if (!$this->hasChild($replace)) {
			throw new CakeException(sprintf('Unknown child %s', get_class($replace)));
		}
		if ($this->hasChild($node)) {
			$this->removeChild($node);
		}
		for ($i = 0; $i < count($this->_childNodes); $i++) {
			if ($this->_childNodes[$i] === $replace) {
				$replace->setParent(null);
				$this->_childNodes[$i] = $node;
				return $this;
			}
		}
	}

/**
 * Removes and returns a child node from the view.
 *
 * @param CtkBuildable $node Child node.
 * @return CtkBuildable
 * @throws CakeException if the specified node is not a child.
 */
	final public function removeChild(CtkBuildable $node) {
		if ($this === $node) {
			throw new CakeException('Cannot reference view as a child');
		}
		for ($i = 0; $i < count($this->_childNodes); $i++) {
			if ($this->_childNodes[$i] === $node) {
				$node->setParent(null);
				array_splice($this->_childNodes, $i, 1);
				return $node;
			}
		}
		throw new CakeException(sprintf('Unknown child %s', get_class($node)));
	}

/**
 * Removes all children from the view.
 *
 * @return CtkView
 */
	final public function clearChildren() {
		foreach ($this->_childNodes as &$node) {
			$node->setParent(null);
		}
		$this->_childNodes = array();
		return $this;
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

