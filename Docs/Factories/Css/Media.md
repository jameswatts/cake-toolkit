Media
=====

The [Media](../../../View/Factory/Css/Objects/CssMedia.php) object represents a set of nested *CSS* blocks with a condition defined by a media query.

```php
$media = $this->Css->Media();
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
		<td>type</td>
		<td>string</td>
		<td>all</td>
		<td>Defines the CSS media type to use.</td>
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
		<td>true</td>
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
		<td>CssRule</td>
		<td>Defines the allowed children for the object, or any if none specified.</td>
	</tr>
</table>

Methods
-------

None.

