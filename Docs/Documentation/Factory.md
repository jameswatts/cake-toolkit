Factory
=======

The objects used to build your Views in CTK are made available via factories. These are collections of objects which are grouped together under a common namespace.

By default, the **Cake Toolkit** provides **4** base factories to use in your Views, these are the following:

* [Html](../Factories/Html.md) - Provides objects for the **Hypertext Markup Language**.
* [Css](../Factories/Css.md) - Provides objects for the **Cascading Style Sheets** standard.
* [Js](../Factories/Js.md) - Provides event objects for client scripting with **JavaScript**.
* [Xml](../Factories/Xml.md) - Provides a base object for the **Extensible Markup Language**.

There is also a [Cake](https://github.com/jameswatts/cake-factory) factory available, which provides objects for the core **Html** and **Form** helpers in *CakePHP*.

Before a factory can be accessed, it must first be loaded in your View. To do so, add the location of the factory to the *$factories* property of your View class, for example:

```php
public $factories = array(
	'Ctk.Html',
	'Ctk.Js'
);
```

Now that there are factories available, these can be called from within the View. Factories can also be added at runtime using the **addFactory()** method.

```php
public function build() {
	// create a HTML div
	$div = $this->Html->Div();
	// add the div to the View
	$this->add($div);
}
```

From the example above you will notice how first the **Html** factory is accessed, and then the **Div** object is called as a method of that object. This format for accessing factories is very similar to using Models, and all factories follow this pattern in CTK. It's important to note that an object is returned to the *$div* handler. It has not been rendered as of yet, meaning it remains in a configurable state. The object can also be added to a parent object, or other objects may be added as children. See the [Object](Object.md) documentation for more information on objects.

Factory Helper
--------------

The **Factory** helper allows objects to be imported from factories into normal ".ctp" views or layouts, providing access to all of the objects used in your CTK based Views.

To use the helper simply include [Ctk.Factory](../../View/Helper/FactoryHelper.php) in your *$helpers* collection in your Controller, for example:

```php
public $helpers = array(
	'Ctk.Factory'
);
```

Once available, you can now use the helper to call the factories and objects to import them into the view or the layout. This works by calling the factory, followed by the object, from your helper as if it were the View class, for example:

```php
<?php echo $this->Factory->Html->Span(array('text' => __('Hello World'))); ?>
```

In the example above the **Html** factory is being loaded, and the **Span** object created then directly rendered. The objects render in the view or the layout as soon as you echo/print or concatenate them with a string. However, you can still build compositions of objects by adding them together, as you would in the View class.

```php
<?php
// create a HTML div
$div = $this->Factory->Html->Div();

	// create a HTML image
	$img = $this->Factory->Html->Img(array(
		'src' => '/example.jpg',
		'alt' => 'An example image'
	));

// add the image to the div
$div->add($img);

// render the div
echo $div;
?>
```

Accessing the objects from outside of a CTK based View let's you take full advantage of the factories and objects, without having to rewrite your existing ".ctp" views or layouts.

Checking Objects Exist
----------------------

At times you may need to check if a specific object is available at runtime. For this, factories provide a **hasObject()** method, which will return a boolean depending on whether the specified object is available via that factory, for example:

```php
$this->Factory->hasObject('Example');
```

Remember that you should confirm the objects available in a factory by referring to the documentation before you check for objects at runtime, however, sometimes it's necessary for that check to exist in the code itself.

Setting up a Factory
--------------------

All factories extend the [CtkFactory](../../Lib/CtkFactory.php) class and have an abstract **setup()** method, which serves as the factory's constructor. This initializes the necessary assets and configurations required for it's use in the View. From this method it's possible to reach the View using the **getView()** method, which returns the current [CtkView](../../View/CtkView.php) object.

Sometimes you may want to control if the factory has already been loaded previously. This can be an issue if using the factory in a View, as well as in a layout with the **Factory** helper. To check whether the factory has been loaded before you can call the **isLoaded()** method, which returns a *boolean* which determines the loaded state.

See the [Creating Factories](../Tutorials/Creating-Factories.md) tutorial for more details on creating your own factory.

Using Factories in Factories
----------------------------

When defining a factory you may find you need to use objects available in other factories. This is very common for factories which need to add assets to the View using *HTML* objects. To load sub-factories, add the location to the *$factories* property of your factory's class, for example:

```php
public $factories = array(
	'Ctk.Html'
);
```

This will then allow you to access the sub-factory from a method of the class or the templates for your objects, using *$this->Html* as you would in the View.

Using Helpers in Factories
--------------------------

As in the View, factories can also load helpers, for use in the templates of your objects. These are defined in the *$helpers* property of your factory's class, for example:

```php
public $helpers = array(
	'Example'
);
```

You can now access the helper from the template the same way you would from the View, using *$this->Example*.

Factories should not access helpers from the View, or add helpers to the View, as this causes tight coupling between the factory and the View. It may also cause errors if helpers are unexpectedly unavailable in a View, or are added to the View and clash with other helpers or factories.

