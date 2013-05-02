Fontface
========

The [Fontface](../../../View/Factory/Css/Objects/CssFontface.php) object represents a custom font at-rule in *CSS*.

```php
$fontface = $this->Css->Fontface();
```

Object
------

The class inheritance for the object.

### Extends

* [CtkObject](../../../Lib/CtkObject.php)
* [CtkNode](../../../Lib/CtkNode.php)
* [CssBlock](../../../View/Factory/Css/Objects/CssBlock.php)

### Implements

* [CtkBuildable](../../../Lib/CtkBuildable.php)
* [CtkBindable](../../../Lib/CtkBindable.php)
* [CtkRenderable](../../../Lib/CtkRenderable.php)

Parameters
----------

The configuration parameters for the template.

<table>
	<tr>
		<th>Name</th>
		<th>Type</th>
		<th>Default</th>
		<th>Description</th>
	</tr>
	<tr>
		<td>src</td>
		<td>string</td>
		<td>null</td>
		<td>Defines a font name that will be used as the font face value.</td>
	</tr>
	<tr>
		<td>family</td>
		<td>string</td>
		<td>null</td>
		<td>Defines the URL for the font file, or the name of a local font in the form local("Font Name").</td>
	</tr>
	<tr>
		<td>weight</td>
		<td>string</td>
		<td>normal</td>
		<td>Defines the weight or boldness of the font.</td>
	</tr>
	<tr>
		<td>style</td>
		<td>string</td>
		<td>normal</td>
		<td>Defines the "italic" or "oblique" faces from a font.</td>
	</tr>
	<tr>
		<td>stretch</td>
		<td>string</td>
		<td>normal</td>
		<td>Defines a "normal", "condensed", or "expanded" face from a font.</td>
	</tr>
	<tr>
		<td>unicode</td>
		<td>string</td>
		<td>null</td>
		<td>Defines the range of Unicode characters supported by a font.</td>
	</tr>
</table>

Properties
----------

The properties affecting object behavior.

<table>
	<tr>
		<th>Property</th>
		<th>Value</th>
		<th>Description</th>
	</tr>
	<tr>
		<td>Allow parent</td>
		<td>true</td>
		<td>Determines if the object can have a parent.</td>
	</tr>
	<tr>
		<td>Allow children</td>
		<td>false</td>
		<td>Determines if the object can have children.</td>
	</tr>
	<tr>
		<td>Allow events</td>
		<td>false</td>
		<td>Determines if events can be added to the object.</td>
	</tr>
	<tr>
		<td>Limit parent</td>
		<td></td>
		<td>Defines the allowed parents for the object, or any if none specified.</td>
	</tr>
	<tr>
		<td>Limit children</td>
		<td></td>
		<td>Defines the allowed children for the object, or any if none specified.</td>
	</tr>
</table>

Methods
-------

None.

