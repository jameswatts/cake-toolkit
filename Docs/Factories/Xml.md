Xml Factory
===========

The **Xml** factory provides a node object used to build structures using the **Extensible Markup Language**.

To use the **Xml** factory in a View include it in the *$factories* property of the CTK class, for example:

```php
public $factories = array('Ctk.Xml');
```

Once the factory is available you can access the [Node](Xml/Node.md) object it provides, for example:

```php
$this->Xml->Node(array(
	'name' => 'example',
	'value' => __('Hello World')
));
```

As shown in the example, an array can be passed to the object with parameters to configure the object's template.

The **Xml** factory provides a layout specific for *XML* documents, which can be set from the *$layout* property of the CTK class, for example:

```php
public $layout = 'Ctk.Xml/default';
```

If using the **Xml** factory to build *XML* documents it's advised to set the *$contentType* property of the CTK class to "text/xml", for example:

```php
public $contentType = 'text/xml';
```

This will also cause the *XML* document to display correctly in Web browsers.

