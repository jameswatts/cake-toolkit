Overview
========

The **Cake Toolkit** is a *CakePHP* plugin designed for medium-to-large scale web applications which require a scalable and standard solution to handling Views.

The plugin allows Views to be defined as a class, providing a powerful object-oriented factory interface to dynamically build your application's UI with configurable objects.

Features
--------

* **Object-Oriented Design:** Every UI element is defined and manipulated as an object, giving you maximum control over the development of your View, by limiting your work to the semantic definition of the interface.
* **Abstraction and Encapsulation:** The ability to define a View as a native *PHP* class unlocks the potential of the native object-oriented features of the language, allowing Views to be extended, blocks of content to be abstracted, and view logic to be encapsulated in helper methods.
* **Separation of Concerns:** The design of the plugin provides a clear and coherent separation of the languages implicated in your development, such as *PHP*, *HTML*, *CSS* and *JavaScript*, making it easy to delegate experts in their field to the relevant areas, without having to work around code they're not familiar with.
* **Extensible Architecture:** Allowing collections of UI elements to be packaged into factories makes it easy to, not only extend the existing factories but, also create your own, tailored to your requirements.
* **Plug and Play:** The functionality of the plugin only adds to the current features available in *CakePHP*, making it possible for **CTK** Views to work along-side normal static ".ctp" Views.
* **Legacy Features:** Great care has been taken to maintaining the availability of the standard features for Views available in *CakePHP*, such as *themes*, *layouts*, *elements*, *content blocks* and *helpers*.

License
-------

Copyright 2012-2013 James Watts (CakeDC). All rights reserved.

Licensed under the MIT License. Redistributions of the source code included in this repository must retain the copyright notice found in each file.

Support
-------

For support, bugs and feature requests, please create a new [issue](https://github.com/jameswatts/cake-toolkit/issues).

Contributing
------------

If you'd like to contribute new features, enhancements or bug fixes to the code base just follow these steps:

* Create a [GitHub](https://github.com/signup/free) account, if you don't own one already
* Then, [fork](https://help.github.com/articles/fork-a-repo) the [Cake Toolkit](https://github.com/jameswatts/cake-toolkit) repository to your account
* Create a new [branch](https://help.github.com/articles/creating-and-deleting-branches-within-your-repository) from the *master* branch in your forked repository
* Modify the existing code, or add new code to your branch, making sure you follow the [CakePHP Coding Standards](http://book.cakephp.org/2.0/en/contributing/cakephp-coding-conventions.html)
* Modify or add [unit tests](http://book.cakephp.org/2.0/en/development/testing.html) which confirm the correct functionality of your code (requires [PHPUnit](http://www.phpunit.de/manual/current/en/installation.html) 3.5+)
* Consider using the [CakePHP Code Sniffer](https://github.com/cakephp/cakephp-codesniffer) to check the quality of your code
* When ready, make a [pull request](http://help.github.com/send-pull-requests/) to the main repository

There may be some discussion reagrding your contribution to the repository before any code is merged in, so be prepared to provide feedback on your contribution if required.

A list of contributors to the **Cake Toolkit** can bee found [here](https://github.com/jameswatts/cake-toolkit/contributors).

