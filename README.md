Cake Toolkit (CTK)
==================

The **Cake Toolkit** is a *CakePHP* plugin designed for medium-to-large scale web applications which require a scalable and standard solution to handling views.

The plugin allows Views to be defined as a class, providing a powerful object-oriented factory interface to dynamically build your application's UI with configurable objects.

The main features of the plugin include:

* **Object-Oriented Design:** Every UI element is defined and manipulated as an object, giving you maximum control over the development of your View, by limiting your work to the semantic definition of the interface.
* **Abstraction and Encapsulation:** The ability to define a View as a native *PHP* class unlocks the potential of the native object-oriented features of the language, allowing Views to be extended, blocks of content to be abstracted, and view logic to be encapsulated in helper methods.
* **Separation of Concerns:** The design of the plugin provides a clear and coherent separation of the languages implicated in your development, such as *PHP*, *HTML*, *CSS* and *JavaScript*, making it easy to delegate experts in their field to the relevant areas, without having to work around code they're not familiar with.
* **Extensible Architecture:** Allowing collections of UI elements to be packaged into factories makes it easy to not only extend the existing factories, but also create your own, tailored to your requirements.
* **Plug and Play:** The functionality of the plugin only adds to the current features available in *CakePHP*, making it possible for **CTK** views to work along-side normal static ".ctp" views.
* **Legacy Features:** Great care has been taken to maintaining the availability of the standard View features available in *CakePHP*, such as *layouts*, *elements*, *content blocks* and *helpers*.

To start using the **Cake Toolkit** it's as simple as including the plugin in your application and extending the *CtkAppController* to inherit everything you'll need.

To get up and running quickly check out the [Hello World](https://github.com/jameswatts/cake-toolkit/wiki/tutorials/Hello_World) tutorial from the [wiki](https://github.com/jameswatts/cake-toolkit/wiki).

Documentation
-------------

Once installed, the **Cake Toolkit** has a homepage built into the *CakePHP* plugin itself. To access the homepage, visit ```/ctk``` from your application base, for example:

```
http://example.com/ctk
```

Full documentation, as well as tutorials, are also available from the [wiki](https://github.com/jameswatts/cake-toolkit/wiki) section of this repository.

Performance
-----------

As with all modern web applications, performance is an important issue to take into consideration, especially if you're running a large enterprise scale application which has high development and maintenance costs associated with it.

It's important to note that the aim of the **Cake Toolkit** is not to increase the performance of the View layer in the *MVC* stack, but to improve the effectiveness of the development, as well as decrease the maintenance required for large scale applications. *CakePHP* already has very powerful and configurable caching mechanisms available, which are also available to **CTK** when building your Views, and strongly recommended due to the heavy use of objects by the plugin.

To quickly add caching to your View, simply define the **$cacheAction** property in your Controller, and define the settings for the actions you wish to cache. For example, with an action called "example", you can define a cache time of 1 week with the following:

```php
public $cacheAction = array(
	'example' => array('duration' => 36000)
);
```

Packed with the plugin is a *Benchmark* controller which provides various actions which can be scaled at runtime to view the overall performance impact:

* **single:** This action simply creates a series XML nodes. It accepts a single argument, which is the number of nodes to generate.
* **lineal:** This action creates a multi-dimensional sequence of XML nodes in a lineal hierarchy. It accepts a single argument, which is the number of levels of nodes to generate.
* **exponential:** This action creates a multi-dimentional sequence of XML nodes in an exponential hierarchy. It accepts a single argument, which is the number of exponential factors to generate.
* **matrix:** This action display a matrix of data in a HTML table. It accepts 2 arguments, the first is the number of rows to generate, and the second the number of cells in each row.

When "debug" is set to any value higher than *0*, and assuming caching is NOT enabled, the plugin will also add a **Ctk-Info** header to the *HTTP* response, for example:

```
Ctk-Info: controller=Benchmark, action=index, render-time=0.019, total-memory=6.86MB, memory-usage=1.83MB
```

This header contains the following values:

* **controller:** The name of the Controller called.
* **action:** The name of the action executed.
* **render-time:** The time in seconds it took to render the View.
* **total-memory:** The total amount of memory used until rendering was complete.
* **memory-usage:** The memory consumed specifically by the plugin.

The following table shows a basic performance scalability benchmark based on the *single* action of the *Benchmark* Controller, without caching enabled:

<table>
	<tr>
		<th></th>
		<th>1 Node</th>
		<th>10 Nodes</th>
		<th>100 Nodes</th>
		<th>1000 Nodes</th>
		<th>10000 Nodes</th>
	</tr>
	<tr>
		<th>Render Time</th>
		<td>0.019</td>
		<td>0.024</td>
		<td>0.030</td>
		<td>0.236</td>
		<td>2.386</td>
	</tr>
	<tr>
		<th>Total Memory</th>
		<td>6.86 MB</td>
		<td>6.89 MB</td>
		<td>7.17 MB</td>
		<td>10.03 MB</td>
		<td>38.98 MB</td>
	</tr>
	<tr>
		<th>Memory Usage</th>
		<td>1.83 MB</td>
		<td>1.86 MB</td>
		<td>2.14 MB</td>
		<td>5.01 MB</td>
		<td>33.96 MB</td>
	</tr>
</table>

These tests were performed on a Intel Pentium laptop using 4 GB of RAM, with the maximum memory setting of *PHP* set to 128 MB.

**IMPORTANT:** Remember that caching is NOT enabled on this controller, as viewing the changes to the action's output is vital to purpose of its use. Turning on the cache for an action of a **CTK** Controller is almost identical in performance to that of a standard static ".ctp" View, as the plugin uses the same routing for the cached files.

Support
-------

For support, bugs and feature requests, please use the [issues](https://github.com/jameswatts/cake-toolkit/issues) section of this repository.

Licence
-------

Copyright 2012 James Watts (CakeDC). All rights reserved.

Licensed under the MIT License. Redistributions of the source code included in this repository must retain the copyright notice found in each file.

Acknowledgements
----------------

A special thanks to [Larry Masters](https://github.com/phpnut), the founder of [CakePHP](http://cakephp.org), for his help and support, to [José Lorenzo](https://github.com/lorenzo) for his input early on when I was hacking the framework, to [Florian Krämer](https://github.com/burzum) for his constructive critisism, as well as the entire [CakeDC](http://cakedc.com) team for their feedback and encouragement.
