Hello World
===========

The following is a detailed overview of how to create a simple *Hello World* example using the **Cake Toolkit (CTK)**. It's recommended you read the [Quick Start](Quick-Start.md) guide before attempting this tutorial.

Controller Setup
----------------

In order to use CTK you'll first need to enable it in your Controller. To do this, you have **2** options available:

* Extend the **CtkAppController**
* Use the **Ctk.App** component

The main difference between the two is that using the component will allow you to have actions which use CTK, and others which can optionally continue to use the legacy ".ctp" views.

To extend the **CtkAppController**, define your Controller as the following:

```php
App::uses('CtkAppController', 'Ctk.Controller');

class ExampleController extends CtkAppController {

}
```

If you want to use the **Ctk.App** component instead, simply include it in your *$components* array, for example:

```php
public $components = array('Ctk.App');
```

The **Ctk.App** component also accepts a settings array, which allows you to configure the component. The setting options available are:

* **helpers**: Defines an array of additional Helpers to use
* **layout**: Defines the layout for CTK to use in this Controller
* **ignoreAction**: Defines an array of actions for CTK to ignore, and process as legacy ".ctp" views
* **cacheAction**: Defines the actions to cache and their relevant settings

Creating Views
--------------

Once you've setup your Controller you can now create the Views for your actions. By default, all CTK Views are defined in a sub-directory of the Controller's view directory called "Ctk/". Therefore, if you have an action named "test" in your **ExampleController**, you would create the following file:

```
/View/Example/Ctk/TestView.php
```

**IMPORTANT:** Notice that by convention the file is in CamelCase, ending with the keyword "View", and uses the ".php" extension.

Now that your file has been created it's time to define your View's class. Open your file and add the following code:

```php
App::uses('CtkView', 'Ctk.View');

class TestView extends CtkView {

	public $factories = array('Ctk.Html');

	public function build() {
		
	}
}
```

This is the basic definition required to create your View. The _$factories_ property defines the CTK factories to use in this View. These are collections of objects which are used to build your View. Here we have included the **Ctk.Html** factory, which comes included with CTK and provides objects for HTML elements.

You will also notice we defined a public **build()** method. This is the View's contructor, and is the base method we'll use to create the View.

Building Objects
----------------

Now that we have a Controller and View ready, we can start to create something. As a simple example, we'll create some HTML elements and add the text "Hello World".

```php
public function build() {
	$div = $this->Html->Div();
		$span = $this->Html->Span(array(
			'text' => __('Hello World')
		));
	$div->add($span);
	$this->add($div);
}
```

In the first line of code, we use the **Html** factory to create a **Div** object. This, as you would expect, represents a `<div>` element. We return this object to a *$div* variable, which allows us perform more actions with this object later on.

Next, we do the same as before, but this time we create a **Span** object. We've also passed an array including the **text** parameter, to define a string to display as the content of this element. Additionally, this block of code is further indented, so we can easily visualize that we're creating an object that's intended to be a *child* of the previous **Div** object. This is not necesary, but greatly aids code readability.

Following this, we use the **add()** method to attach the **Span** object as a *child* of our **Div** object.

And finally, we add the **Div** to the View itself using the **add()** method of *$this*. In this context, you can consider the View as your canvas, or document body. It's basically the root for all objects.

Rendered Output
---------------

Having completed these steps we can now navigate to our Controller and action in the browser to see the result.

```php
/example/test
```

That's it. You should see the standard *CakePHP* layout, with the text "Hello World". If you now view the source code of that page you'll see how the elements were created, without ever having actually written a single line of HTML.

