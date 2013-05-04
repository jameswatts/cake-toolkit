<?php
/**
 * Extended View class for generating object-oriented views.
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

App::uses('View', 'View');

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
class CtkBaseView extends View {

/**
 * Sub-directory for this view file.  This is often used for extension based routing.
 *
 * @var string
 */
	public $subDir = 'Ctk';

/**
 * Name of layout to use with this View.
 *
 * @var string
 */
	public $layout = 'Ctk.default';

/**
 * Internal performance statistics.
 *
 * @var array
 */
	public $stats = array();

/**
 * Reference to the controller.
 *
 * @var CtkController
 */
	protected $_controller = null;

/**
 * The class name of the view object.
 *
 * @var string
 */
	protected $_viewClass = null;

/**
 * The view object to be rendered.
 *
 * @var CtkView
 */
	protected $_viewObject = null;

/**
 * Overrides the extension as Cake doesn't allow different $ext between views and layouts.
 * 
 * This is reset to false upon calling _getExtensions().
 * 
 * @var boolean
 */
	protected $_overrideExtType = false;

/**
 * Constructor
 *
 * @param Controller $controller A controller object to pull View::_passedVars from.
 */
	public function __construct(Controller $controller = null) {
		$this->_helpersLoaded = true; // avoids loading of helpers
		parent::__construct($controller);
		$this->_controller = $controller;
	}

/**
 * Get the class name of the view object.
 *
 * @return string The class name of the view object.
 */
	public function getViewClass() {
		return $this->_viewClass;
	}

/**
 * Get the view object to be rendered.
 *
 * @return CtkView The view object to be rendered.
 */
	public function getViewObject() {
		return $this->_viewObject;
	}

/**
 * Renders view for given view file and layout.
 *
 * If View::$autoRender is false and no `$layout` is provided, the view will be returned bare.
 *
 * View and layout names can point to plugin views/layouts.  Using the `Plugin.view` syntax
 * a plugin view/layout can be used instead of the app ones.  If the chosen plugin is not found
 * the view will be located along the regular view path cascade.
 *
 * @param string $view Name of view file to use.
 * @param string $layout Layout to use.
 * @return string Rendered Element
 * @throws CakeException if there is an error in the view.
 */
	public function render($view = null, $layout = null) {
		if ($this->hasRendered) {
			return true;
		}
		if ($view) {
			$this->view = $view;
		}
		if (!$this->_helpersLoaded) {
			$this->loadHelpers();
		}
		$this->assign('content', '');
		$this->_overrideExtType = true;
		if ($view !== false && $viewFileName = $this->_getViewClassFileName(Inflector::camelize($this->view) . 'View')) {
			$this->_currentType = self::TYPE_VIEW;
			$this->getEventManager()->dispatch(new CakeEvent('View.beforeRender', $this, array($viewFileName)));
			$this->assign('content', $this->_build($viewFileName));
			$this->getEventManager()->dispatch(new CakeEvent('View.afterRender', $this, array($viewFileName)));
		}
		if ($layout === null) {
			$layout = $this->layout;
		}
		if ($layout && $this->autoLayout) {
			$this->assign('content', $this->renderLayout('', $layout));
		}
		$this->hasRendered = true;
		return $this->fetch('content');
	}

/**
 * Builds the object-oriented structure for given view file.
 *
 * Build triggers helper callbacks, which are fired before and after the view is built,
 * as well as before and after the layout.  The helper callbacks are called:
 *
 * - `beforeRender`
 * - `afterRender`
 * - `beforeLayout`
 * - `afterLayout`
 *
 * @param string $viewFile Path to the view file.
 * @return string Rendered Elements
 * @throws CakeException if there is an error in the view.
 */
	protected function _build($viewFile) {
		$this->_current = $viewFile;
		$this->getEventManager()->dispatch(new CakeEvent('View.beforeRenderFile', $this, array($viewFile)));
		ob_start();
		include($viewFile);
		ob_end_clean();
		if ((int) Configure::read('debug') > 0) {
			$this->stats['memoryBefore'] = memory_get_usage();
			$this->stats['startTime'] = explode(' ', microtime());
		}
		$this->_viewClass = Inflector::camelize($this->view) . 'View';
		$class = $this->_viewClass;
		$this->_viewObject = new $class($this);
		$this->_viewObject->build();
		$content = $this->_viewObject->render();
		$content = $this->_viewObject->process($content);
		if ((int) Configure::read('debug') > 0) {
			$this->stats['endTime'] = explode(' ', microtime());
			$this->stats['memoryAfter'] = memory_get_usage();
			$unit = array('bytes', 'KB', 'MB', 'GB');
			$this->stats['renderTime'] = round(($this->stats['endTime'][1]+$this->stats['endTime'][0])-($this->stats['startTime'][1]+$this->stats['startTime'][0]), 3);
			$this->stats['totalMemory'] = round($this->stats['memoryAfter']/pow(1024, ($i = floor(log($this->stats['memoryAfter'], 1024)))), 2) . ((isset($unit[$i]))? $unit[$i] : $unit[2]);
			$this->stats['memoryUsage'] = round(($this->stats['memoryAfter']-$this->stats['memoryBefore'])/pow(1024, ($i = floor(log(($this->stats['memoryAfter']-$this->stats['memoryBefore']), 1024)))), 2) . ((isset($unit[$i]))? $unit[$i] : $unit[2]);
			$this->_controller->response->header('Ctk-Info', 'controller=' . $this->name . ', action=' . $this->view . ', render-time=' . $this->stats['renderTime'] . ', total-memory=' . $this->stats['totalMemory'] . ', memory-usage=' . $this->stats['memoryUsage']);
		}
		$this->assign('content', $content);
		$afterEvent = new CakeEvent('View.afterRenderFile', $this, array($viewFile, $content));
		//TODO: For BC puporses, set extra info in the event object. Remove when appropriate
		$afterEvent->modParams = 1;
		$this->getEventManager()->dispatch($afterEvent);
		$content = $afterEvent->data[1];
		return $content;
	}

/**
 * Returns filename of given action's view class (.php) as a string.
 * Under_scored action names will be CamelCased! This means that you can have
 * long_action_names that refer to LongActionNamesView.php views.
 *
 * @param string $name Controller action to find view class filename for
 * @return string View class filename
 * @throws MissingViewException when a view file could not be found.
 */
	protected function _getViewClassFileName($name = null) {
		$subDir = null;
		if (!is_null($this->subDir)) {
			$subDir = $this->subDir . DS;
		}
		if ($name === null) {
			$name = $this->view;
		}
		$name = str_replace('/', DS, $name);
		list($plugin, $name) = $this->pluginSplit($name);
		if (strpos($name, DS) === false && $name[0] !== '.') {
			$name = $this->viewPath . DS . $subDir . $name;
		} elseif (strpos($name, DS) !== false) {
			if ($name[0] === DS || $name[1] === ':') {
				if (is_file($name)) {
					return $name;
				}
				$name = trim($name, DS);
			} elseif ($name[0] === '.') {
				$name = substr($name, 3);
			} elseif (!$plugin || $this->viewPath !== $this->name) {
				$name = $this->viewPath . DS . $subDir . $name;
			}
		}
		$paths = $this->_paths($plugin);
		$exts = $this->_getExtensions();
		foreach ($exts as $ext) {
			foreach ($paths as $path) {
				if (file_exists($path . $name . $ext)) {
					return $path . $name . $ext;
				}
			}
		}
		$defaultPath = $paths[0];
		if ($this->plugin) {
			$pluginPaths = App::path('plugins');
			foreach ($paths as $path) {
				if (strpos($path, $pluginPaths[0]) === 0) {
					$defaultPath = $path;
					break;
				}
			}
		}
		throw new MissingViewException(array('file' => $defaultPath . $name . $this->ext));
	}

/**
 * Get the extensions that view files can use.
 * 
 * If _overrideExtType is set to "true", the $ext will be ".php" by force.
 *
 * @return array Array of extensions view files use.
 */
	protected function _getExtensions() {
		if ($this->_overrideExtType) {
			$this->_overrideExtType = false;
			return array('.php');
		}
		return parent::_getExtensions();
	}
}

