Processor
=========

A post-processor is optional, and allows you to parse the resulting View content after the renderer has completed. This can be useful for injecting external content, replacing placeholders with specific values, or parsing markup or templating syntax. From the [CtkView](../../View/CtkView.php) class you can set the processor using the *$processor* property, or at runtime via the **setProcessor()** method.

Processing Views
----------------

A processor extends the [CtkProcessor](../../Lib/CtkProcessor.php) class, which has an abstract **setup()** method, serving as the processor's constructor. This initializes the necessary assets and configurations required for handling the static content. From this method it's possible to reach the View using the **getView()** method, which returns the [CtkView](../../View/CtkView.php) object. It's important to remember that the View has already been rendered, meaning that any modifications to the object model will have no resulting effect on the static content which was generated.

Processors have another abstract method, **process()**, which is called once the renderer has completed. The static content which was created from rendering the object model is passed to this method, meaning that it must be parsed as a string. It's worth noting that the encoding of the content could impact the methods used when processing the content. This can be determined from the **getCharset()** method of the View object.

Sometimes you may also want to control if the processor has already been loaded previously. This can be an issue if using the factory in a View, as well as in a layout with the **Factory** helper. To check whether the processor has been loaded before you can call the **isLoaded()** method, which returns a *boolean* which determines the loaded state.

