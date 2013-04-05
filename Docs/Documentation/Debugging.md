Debugging
=========

The usual debugging options you're used to using in *CakePHP* remain available, such as logs, the **debug()** function and the **Debugger** class. Additionally, the **Cake Toolkit** provides some extra features.

Response Header
---------------

When "debug" is set to any value higher than *0*, and assuming caching is NOT enabled, the plugin will add a **Ctk-Info** header to the *HTTP* response, for example:

```
Ctk-Info: controller=Benchmark, action=single, render-time=0.019, total-memory=6.86MB, memory-usage=1.83MB
```

This header contains the following values:

* **controller:** The name of the Controller called.
* **action:** The name of the action executed.
* **render-time:** The time in seconds it took to render the View.
* **total-memory:** The total amount of memory used until rendering was complete.
* **memory-usage:** The memory consumed specifically by the plugin.

Object Model
------------

It's also possible to see the internal object model of a View by simply setting it to use the **Schema** renderer in your View class.

```php
public $renderer = 'Ctk.Schema';
```

This will output the View as an abstract XML schema of the factories and objects used, for example:

```
<?xml version="1.0" encoding="UTF-8"?>
<ctk xmlns:Html="http://caketoolkit.org/schema/Html">
	<request address="127.0.0.1" method="GET" host="example.com" url="/example/index"/>
	<response controller="Example" action="index" layout="Ctk.Xml/schema" content-type="text/xml" charset="UTF-8"/>
	<schema>
		<Html:Div plugin="Ctk" template="div" text="">
			<Html:Button plugin="Ctk" template="button" value="Click Me"/>
		</Html:Div>
	</schema>
	<info render-time="0.019" total-memory="6.86MB" memory-usage="1.83MB"/>
</ctk>
```

The output includes additional information about the request and response, as well as the performance statistics also present in the **Ctk-Info** header.

