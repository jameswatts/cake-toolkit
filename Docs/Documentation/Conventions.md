Conventions
===========

By default the **Cake Toolkit** follows all of the [conventions](http://book.cakephp.org/2.0/en/getting-started/cakephp-conventions.html) and [standards](http://book.cakephp.org/2.0/en/contributing/cakephp-coding-conventions.html) already defined in *CakePHP*. However, it introduces some additional conventions for the new features it provides.

Naming
------

Controllers follow the existing conventions, however, as Views are now *PHP* classes, they adopt the common naming format for class files in *CakePHP*, for example:

```
app/View/Products/Ctk/IndexView.php
```

The example given would be the View for the "index" action of the "Products" Controller. All View files are named in CamelCase after the "action", plus the word "View", and are located in a sub-directory called "Ctk/". This helps keep the *PHP* class files separate from any legacy ".ctp" files which may also be used by the Controller.

Presentation
------------

Due to the fact that CTK reduces your code to just *PHP*, it's important to mantain this code in a clean and coherent format, aiding readability where possible.

With regard to node hierarchy, it's helpful to show indentation of parent and child nodes in the code, to aid visualization of the structure being built. It's also wise to introduce white space, to further imply the separation between different objects, for example:

```php
$grandParent = $this->Factory->Object(array(
	'param' => $value
));

	$parent = $this->Factory->Object(array(
		'param' => $value
	));

		$firstChild = $this->Factory->Object(array(
			'param' => $value
		));

		$secondChild = $this->Factory->Object(array(
			'param' => $value
		));

	$parent->add($firstChild);
	$parent->add($secondChild);

$grandParent->add($parent);

$this->add($grandParent);
```

The following are a list of basic rules which, if adhered to, should provide additional consistency to the code:

* Objects should be defined with a handler which clearly describes the object
* Names of object handlers should not describe their appearance, size or position, as this is controlled via *CSS* and may change
* Names of object handlers should end with their type, for example, $submitButton
* All objects should be defined with a line of white space (LF) before and after
* Objects should be added to their parent or the View after all children have been defined
* Objects which are added directly to the View should be added at the end of the **build()** method
* Objects which are a child of another object should be defined with an additional tab of indentation

Modularity
----------

As Views in CTK are *PHP* classes it's possible to take full advantage of the object-oriented aspects of the language. Some areas of Views can be encapsulated into methods of a class, or introduced when using traits. It's as equally important to maintain a coherent design with regard to these methods, especially in the interest of keeping your application *future-proof*.

**Builders**: These are methods which prepare an object for use in the View. The principal characteristic of this method is that it returns an object which has been prepared and built. These methods begin with the "build" keyword, followed by a CamelCase name for what they build, for example:

```php
public function buildExampleObject() {
	// some logic here
	$object = $this->Factory->Object();
	return $object;
}
```

A simple example of a **builder** in use may be similar to the following:

```php
$exampleObject = $this->buildExampleObject();
```

Keep in mind that it's perfectly possible for **builders** to return a single object, or possibly a full structure of objects, with a base object as the return value of the method. However, it's very important to *not* add the object to the View inside of the method, as this breaks the option to use that method elsewhere without it be added directly to the View. The added benefit of **builder** methods is that they encapsulate the code required to build that specific interface, but also provide portability by returning the objects.

**Resolvers**: These are methods which resolve a value for use in a View. It's important to not confuse this with application logic which should be resolved in the Controller. These methods begin with the "resolve" keyword, followed by a CameCase name for what they resolve, for example:

```php
public function resolveSomething() {
	// some logic here
	return $something;
}
```

An example of a **resolver** may be for the value of a configuration parameter, for example:

```php
$exampleButton = $this->Factory->Object(array(
	'param' => $this->resolveSomething()
));
```

Or, possibly a more complete example, where the whole configuration array is resolved:

```php
$exampleButton = $this->Factory->Object($this->resolveSomething());
```

Configuration
-------------

A powerful feature of CTK is the possibility to define the configuration of objects from an external file. This can be acheived through the use of **Configure::write()** and **Configure::read()**.

For example, you may have various forms in your application which have configurations that may be modified on a regular basis. In order to avoid having to edit the view file, you can abstract the configuration of those objects to an external file, for example:

```php
Configure::write('exampleFormConfig', array(
	'param' => 'value'
));
```

Then, in your View file, simply read the configuration array from the external file:

```php
$exampleForm = $this->Html->Form(Configure::read('exampleFormConfig'));
```

If you have the same object located in various areas of the application, but it's configuration varies slightly in each location, consider possibly using a **resolver** method which uses **Configuration::read()** to access the relevant configuration for each area.

Extensibility
-------------

You may find you want to build you own factories, to hold propietary objects used by your application, or you may even be considering sharing your objects with the open source community. In either case, it's ideal to maintain a certain amount of conformaty in the naming of your factories.

By default, the plugin name for factories is the name of the factory itself, followed by the word "Factory". So, if you were to create an "Example" factory, the name of your plugin would become "ExampleFactory", for example:

```
app/Plugin/ExampleFactory
```

Inside the plugin, the location of your factory class itself would be located in the "Factory" directory, in the base "View" directory, for example:

```
app/Plugin/ExampleFactory/View/Factory/ExampleFactory.php
```

All of your factory's objects and templates are then located in a directory with the same name as your factory, in this case "Example".

```
app/Plugin/ExampleFactory/View/Factory/Example/
```

This naming convention also applies to renderers and processors. So, if you were to create either a renderer or a processor named "Example", they would be named in the same fashion.

```
app/Plugin/ExampleFactory/View/Renderer/ExampleRenderer.php
app/Plugin/ExampleFactory/View/Processor/ExampleProcessor.php
```

As layouts remain as ".ctp" files there is no alteration to the naming or location of these.

