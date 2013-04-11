View
====

When using the **Cake Toolkit**, your View is represented by the **CtkView** class, which provides the foundation to build the View using object-oriented code, and to apply the required ouput settings. This differs from the normal system in *CakePHP*, where the View is a static file with procedural *PHP* code, possibly mixed with *HTML*, *CSS* and *JavaScript*.

Enabling CTK for your Views can be accomplished in **2** ways, either by extending the **CtkAppController**, for example:

```php
App::uses('CtkAppController', 'Ctk.Controller');

class ExampleController extends CtkAppController {
	
}
```

Or, by using the **Ctk.App** component. The difference between the two options is that by using the component you can allow some actions to continue using the legacy ".ctp" files, by including them in the "ignoreAction" setting of the component, for example:

```php
public $components = array(
	'Ctk.App' => array(
		'ignoreAction' => array('edit')
	)
);
```

As shown before, the "edit" action would continue to use the "edit.ctp" file for the View. To get started with CTK see the [Quick Start](../Tutorials/Quick-Start.md) tutorial.

Creating a View
---------------

By convention, View files in CTK are named in CamelCase, and are the name of the "action", followed by the word "View". Also, these files are located in a sub-directory named "Ctk/" in order to keep your View classes separate from your legacy ".ctp" files. See the [Conventions](Conventions.md) for more information on naming and other definitions in CTK.

For example, the View file for the "index" action in the "Example" Controller would be the following:

```
app/View/Example/Ctk/IndexView.php
```

In the contents of the file, the definition of the class requires that the **CtkView** class be included from "Ctk.View". Once available, the class should be declared using the same name as the file, and extending **CtkView**. So, from the previous example:

```php
App::uses('CtkView', 'Ctk.View');

class IndexView extends CtkView {

	public function build() {

	}
}
```

The **build()** method acts as the View's constructor, and provides the main method from which to create the output. See the [Building Views](../Tutorials/Building-Views.md) tutorial for more insight on creating a View.

There are also many properties available which, when defined with a value, provide a direct way to easily specify aspects of the View. These are the following:

* **$factories:** An array of factories to load for use in the View. Factories are accessed by calling the factory as a property, for example, *$this->Html* would access the **Html** factory. Factories can also be added at runtime using the **addFactory()** method. See the [Factory](Factory.md) documentation for more information on factories.
* **$helpers:** An array of helpers to load for use in the View. Helpers are accessed by calling the helper as a property, for example, *$this->Form* would access the **Form** helper. Keep in mind that there cannot be a factory and a helper with the same name, use the "className" option of either the factory or helper settings to alias the name. Helpers can still be included from the Controller, and can also be added at runtime using the **addHelper()** method.
* **$renderer:** The renderer to use for the View. There must always exist a renderer, by default the "Ctk.Web" renderer is used. This can also be modified at runtime using the **setRenderer()** method. See the [Renderer](Renderer.md) documentation for more information on renderers.
* **$processor:** The optional post-processor to use for the View. By default none is specified. This can also set or modified at runtime using the **setProcessor()** method. See the [Processor](Processor.md) documentation for more information on processors.
* **$contentType:** Sets the Content-Type for the content of the output, by default it is set to "text/html". This can also be modified at runtime using the **setContentType()** method.
* **$charset:** Sets the character set for the content of the output, by default it is set to "UTF-8". This can also be modified at runtime using the **setCharset()** method.
* **$theme:** Optionally sets the theme to use for the View, by default no theme is used. This can also be set at runtime using the **setTheme()** method.
* **$layout:** Sets the layout to use for the View, by default it is set to "Ctk.default". This can also be modified at runtime using the **setLayout()** method.
* **$title:** Sets the title to use in the layout of the View, by default no title is set, meaning that *CakePHP* composes the title from the Controller and the action. This can also be set or modified at runtime using the **setTitle()** method.

Request and Response Objects
----------------------------

When in the View you may need to access the **CakeRequest** or **CakeResponse** objects for the current action. These are available via the **getRequest()** and **getResponse()** methods.

Accessing Arguments
-------------------

Although you have access to the **CakeRequest** object in the View, the arguments are also directly accessible via the **getArguments()** method. This returns the full collection of arguments processed by the request as an array, with the path segments as numeric indexes, and named parameters as keys.

More details on handling passed arguments can be found [here](http://book.cakephp.org/2.0/en/development/routing.html#passed-arguments).

Reading View Variables
----------------------

As with existing Controllers, values can be passed to the View using the **set()** method. However, instead of reading these values as variables, as in the normal ".ctp" files, these are accessible as properties of the View object itself.

If you were to set the value of "example" as the string "Hello World", you would do the following from your Controller action's method:

```php
$this->set('example', 'Hello World');
```

The value which has been set for "example" is now available as the property *$this->example* from within the View itself.

```php
$value = $this->example; // contains the string "Hello World"
```

See the [Reading View Variables](../Tutorials/Reading-View-Variables.md) tutorial for more details on View variables.

Processing Validation Errors
----------------------------

If you want to process the validation errors which have occured in your Models, these are directly available in the View from the **getValidationErrors()** method. This returns an array which holds the collection of errors which have been generated during the processing of the business logic.

More information on data validation can be found [here](http://book.cakephp.org/2.0/en/models/data-validation.html).

Accessing the Base View
-----------------------

While the **CtkView** class is used to define your View object, it's not the class responsible for altering the existing View layer in *CakePHP*. This class is accessible via the **getBaseView()** method, which returns the underlying View object used by the framework to handle the presentation logic.

The **CtkBaseView** class extends the core [View](http://book.cakephp.org/2.0/en/views.html#view-api) class. The scope of this object is the same as that in the static ".ctp" files. Accessing this object from your View in CTK is functionaly the same as referencing *$this* in normal Views.

