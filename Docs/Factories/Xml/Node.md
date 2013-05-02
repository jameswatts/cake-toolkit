Node
====

The [Node](../../View/Factory/Xml/Objects/XmlNode.php) object represents an element (tag) in the *XML* document. As the language is extensible, this object serves as a generic base for any element.

```php
$node = $this->Xml->Node();
```

Object
------

The class inheritance for the object.

### Extends

* [CtkObject](../../Lib/CtkObject.php)
* [CtkNode](../../Lib/CtkNode.php)

### Implements

* [CtkBuildable](../../Lib/CtkBuildable.php)
* [CtkBindable](../../Lib/CtkBindable.php)
* [CtkRenderable](../../Lib/CtkRenderable.php)

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
		<td>name</td>
		<td>string</td>
		<td>node</td>
		<td>Defines the name of the element (tag).</td>
	</tr>
	<tr>
		<td>cdata</td>
		<td>boolean</td>
		<td>false</td>
		<td>Determines if the value of the element is wrapped in a CDATA comment.</td>
	</tr>
	<tr>
		<td>value</td>
		<td>string</td>
		<td></td>
		<td>Defines the value of the element.</td>
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
		<td></td>
		<td>Defines the allowed children for the object, or any if none specified.</td>
	</tr>
</table>

Methods
-------

The contextual methods for the object.

<table>
	<tr>
		<th>Method</th>
		<th>Returns</th>
		<th>Description</th>
	</tr>
	<tr>
		<td>hasAttribute(string $name)</td>
		<td>boolean</td>
		<td>Determines if a given attribute has been set.</td>
	</tr>
	<tr>
		<td>getAttribute(string $name)</td>
		<td>mixed</td>
		<td>Returns an attribute set on the node.</td>
	</tr>
	<tr>
		<td>setAttribute(string $name, mixed $value = null)</td>
		<td>XmlNode</td>
		<td>Sets an attribute on the node.</td>
	</tr>
	<tr>
		<td>removeAttribute(string $name)</td>
		<td>XmlNode</td>
		<td>Removes a previously set attribute from the node.</td>
	</tr>
	<tr>
		<td>clearAttributes()</td>
		<td>XmlNode</td>
		<td>Removes all attributes previously set on the node.</td>
	</tr>
</table>

