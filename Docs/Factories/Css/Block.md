Block
=====

The [Block](../../../View/Factory/Css/Objects/CssBlock.php) object is the base class for all *CSS* objects.

```php
$block = $this->Css->Block();
```

Object
------

The class inheritance for the object.

### Extends

* [CtkObject](../../../Lib/CtkObject.php)
* [CtkNode](../../../Lib/CtkNode.php)

### Implements

* [CtkBuildable](../../../Lib/CtkBuildable.php)
* [CtkBindable](../../../Lib/CtkBindable.php)
* [CtkRenderable](../../../Lib/CtkRenderable.php)

Parameters
----------

None.

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
		<td></td>
		<td>Defines the allowed children for the object, or any if none specified.</td>
	</tr>
</table>

Methods
-------

None.

