Performance
===========

As with all modern web applications, performance is an important issue to take into consideration, specially if you're running a large enterprise scale application which has high development and maintenance costs associated with it.

Caching
-------

It's important to note that the aim of the **Cake Toolkit** is not to increase the performance of the View layer in the *MVC* stack, but to improve the effectiveness of the development, as well as decrease the maintenance required for large scale applications. *CakePHP* already has very powerful and configurable caching mechanisms available, which are also available to **CTK** when building your Views, and strongly recommended due to the heavy use of objects by the plugin.

To quickly add caching to your View, simply define the **$cacheAction** property in your Controller, and define the settings for the actions you wish to cache. For example, with an action called "example", you can define a cache time of 1 week with the following:

```php
public $cacheAction = array(
	'example' => array('duration' => 36000)
);
```

Benchmarks
----------

Packed with the plugin is a *Benchmark* controller which provides various actions which can be scaled at runtime to view the overall performance impact:

* **single:** This action simply creates a series XML nodes. It accepts a single argument, which is the number of nodes to generate.
* **lineal:** This action creates a multi-dimensional sequence of XML nodes in a lineal hierarchy. It accepts a single argument, which is the number of levels of nodes to generate.
* **exponential:** This action creates a multi-dimentional sequence of XML nodes in an exponential hierarchy. It accepts a single argument, which is the number of exponential factors to generate.
* **matrix:** This action displays a matrix of data in a HTML table. It accepts 2 arguments, the first is the number of rows to generate, and the second the number of cells in each row.

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

**IMPORTANT:** Remember that caching is NOT enabled on this controller, as viewing the changes to the action's output is vital to the purpose of its use. Turning on the cache for an action of a **CTK** Controller is almost identical in performance to that of a standard static ".ctp" View, as the plugin uses the same routing for the cached files.

