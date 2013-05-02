Declaration
===========

The [Declaration](../../../View/Factory/Css/Objects/CssDeclaration.php) object represents a key value pair, used to specify a *CSS* property and corresponding value.

```php
$declaration = $this->Css->Declaration();
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
		<td>property</td>
		<td>string</td>
		<td>null</td>
		<td>Defines the CSS property.</td>
	</tr>
	<tr>
		<td>value</td>
		<td>mixed</td>
		<td>null</td>
		<td>Defines the property value.</td>
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
		<td>CssRule</td>
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

