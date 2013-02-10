<?php
/**
 * Schema layout for the Cake Toolkit.
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
 * @package       Ctk.View.Layouts
 * @since         CakePHP(tm) v 2.2.0.0
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?xml version="1.0" encoding="UTF-8"?>
<?php
$factories = $this->getViewObject()->getFactories();
$namespaces = '';
foreach ($factories as $factory => $settings) {
	$isAlias = (is_array($settings) && isset($settings['className']));
	list($plugin, $name) = pluginSplit(($isAlias)? $settings['className'] : $factory);
	$namespaces .= ' xmlns:' . $name . '="http://caketoolkit.org/schema/' . $name . '"';
}
?>
<ctk<?php echo $namespaces; ?>>
	<request address="<?php echo $this->request->clientIp(); ?>" method="<?php echo $this->request->method(); ?>" host="<?php echo $this->request->host(); ?>" url="<?php echo htmlspecialchars($this->request->here(), ENT_COMPAT, 'UTF-8'); ?>"/>
	<response controller="<?php echo $this->name; ?>" action="<?php echo $this->view; ?>" layout="Ctk.Xml/schema" content-type="text/xml" charset="UTF-8"/>
	<schema>
		<?php echo $this->fetch('content'); ?>
	</schema>
	<?php if ((int) Configure::read('debug') > 0): ?>
		<info render-time="<?php echo $this->stats['renderTime']; ?>" total-memory="<?php echo $this->stats['totalMemory']; ?>" memory-usage="<?php echo $this->stats['memoryUsage']; ?>"/>
	<?php endif; ?>
</ctk>
