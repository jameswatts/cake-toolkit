Examples
========

The following are a few basic examples of common usage in the **Cake Toolkit**.

Creating a Div
--------------

Create a HTML div object and add it to the View.

```php
$myDiv = $this->Html->Div();

$this->add($myDiv);
```

Creating a Div with a Span
--------------------------

Create a HTML div object and add a HTML span object as a child.

```php
$myDiv = $this->Html->Div();

	$mySpan = $this->Html->Span();

$myDiv->add($mySpan);
```

Chaining Objects
----------------

Create various objects as children of each other in a sequence.

```php
$myDiv->Span()->Em()->Strong();
```

**IMPORTANT:** When chaining objects, the last object in the chain is returned. Also, only objects of the common factory can be called.

Setting a Unique ID
-------------------

Set a unique ID on an object, by default all objects have a unique ID assigned to them.

```php
$myDiv->setId('myId');
```

Setting Parameters
------------------

Set the "text" configuration parameter on a HTML div object, this will render as text inside the element.

```php
$myDiv = $this->Html->Div(array(
	'text' => __('Hello World')
));

$myDiv->text = 'Updated';
```

Special Parameters
------------------

A collection of special configuration parameters available on all objects.

```php
$mySpan = $this->Html->Span(array(
	'_id' => 'myId',
	'_parent' => $myDiv,
	'_children' => array(
		$myButton,
		'Strong' => array(
			'text' => __('Hello World')
		)
	),
	'_events' => array(
		'click' => $this->Js->Alert(array(
			'text' => __('Hello World')
		))
	)
));
```

**IMPORTANT:** The special parameters available are shortcuts to common actions on an object.

Copying an Object
-----------------

Make a copy of an object, the unique ID is automatically updated.

```php
$myDivCopy = $myDiv->copy();
```

Adding Multiple Objects
-----------------------

Add multiple objects as children.

```php
$myDiv->addMany(array(
	$mySpan,
	'Button',
	'Strong' => array(
		'text' => __('Hello World')
	)
));
```

Adding Objects Before and After
-------------------------------

Add objects before or after a specific child.

```php
$myDiv->addBefore($newSpan, $mySpan);
$myDiv->addAfter($newSpan, $mySpan);
```

Conditionally Adding Objects
----------------------------

Add an object based upon a condition, which will only be added if the condition resolves to true.

```php
$myDiv->addIf($condition === true, $mySpan);
```

Adding Objects from a Callback
------------------------------

Add an object from a callback function, any "callable" function in *PHP* is valid.

```php
$myDiv->addWhile(function(&$parent, &$view, &$data, $i) {
	if ($i <= 9) {
		$parent->add($view->Html->Span(array(
			'text' => 'I was added'
		)));
	}
});
```

Inherit Children
----------------

Inherit the children from another object, these are not duplicated but moved to the new parent.

```php
$myDiv->addFrom($otherDiv);
```

Replacing and Removing Children
-------------------------------

Replace or remove children.

```php
$myDiv->replaceChild($mySpan, $otherSpan);
$myDiv->removeChild($otherSpan);
```

Traversing Objects
------------------

Various methods for traversing parents and children.

```php
$parent = $myUl->getParent();
$children = $myUl->getChildren();
$firstChild = $myUl->getFirst();
$lastChild = $myUl->getLast();
$previousChild = $lastChild->getPrevious();
$nextChild = $firstChild->getNext();

$myUl->each(function(&$child, &$parent, &$view, &$data, $i) {
	$child->text = 'Updated';
});
```

Binding an Event
----------------

Bind a *JavaScript* alert event to an object.

```php
$myButton->bind('click', $this->Js->Alert(array(
	'text' => __('Hello World')
)));
```

Redirecting
-----------

Bind a *JavaScript* redirection event to an object.

```php
$myButton->bind('click', $this->Js->Redirect(array(
	'location' => Router::url(array(
		'controller' => 'Example',
		'action' => 'index'
	))
)));
```

Content via Ajax
----------------

Load the content of an object via Ajax.

```php
$myButton->bind('click', $this->Js->Element(array(
	'node' => $myDiv
))->ajax(Router::url(array(
	'controller' => 'Example',
	'action' => 'index'
))));
```

Including an Element
--------------------

Include a *CakePHP* element in a CTK based View.

```php
$myDiv = $this->Html->Div();

	$exampleElement = $this->element('example');

$myDiv->add($exampleElement);
```

**IMPORTANT:** The content of elements are returned as an object. This allows you to add elements to other objects, however, elements do not accept children.

Appending to View Blocks
------------------------

Append a HTML script to the "script" view block.

```php
$this->append('script', $this->Html->Script(array(
	'src' => 'example.js'
)));
```

Using a Helper
--------------

Use an example helper in a CTK based View.

```php
$myDiv = $this->Html->Div();

	$something = $this->ExampleHelper->something();

$myDiv->add($something);
```

**IMPORTANT:** The output of a helper method is returned as an object. Objects returned from helpers are automatically converted to their original value if passed to other helpers.

