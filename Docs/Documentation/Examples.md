Examples
========

The following are a few basic examples of common usage in the **Cake Toolkit**.

Creating a Div
--------------

```php
$myDiv = $this->Html->Div();

$this->add($myDiv);
```

Creating a Div with a Span
--------------------------

```php
$myDiv = $this->Html->Div();

	$mySpan = $this->Html->Span();

$myDiv->add($mySpan);
```

Chaining Objects
----------------

```php
$myDiv->Span()->Em()->Strong();
```

**IMPORTANT:** When chaining objects, the last object in the chain is returned. Also, only objects of the common factory can be called.

Setting a Unique ID
-------------------

```php
$myDiv->setId('myId');
```

Setting Parameters
------------------

```php
$myDiv = $this->Html->Div(array(
	'text' => __('Hello World')
));

$myDiv->text = 'Updated';
```

Special Parameters
------------------

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

```php
$myDivCopy = $myDiv->copy();
```

Adding Multiple Objects
-----------------------

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

```php
$myDiv->addBefore($newSpan, $mySpan);
$myDiv->addAfter($newSpan, $mySpan);
```

Conditionally Adding Objects
----------------------------

```php
$myDiv->addIf($condition === true, $mySpan);
```

Adding Objects from a Callback
------------------------------

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

```php
$myDiv->addFrom($otherDiv);
```

Replacing and Removing Children
-------------------------------

```php
$myDiv->replaceChild($mySpan, $otherSpan);
$myDiv->removeChild($otherSpan);
```

Traversing Objects
------------------

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

```php
$myButton->bind('click', $this->Js->Alert(array(
	'text' => __('Hello World')
)));
```

Redirecting
-----------

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

```php
$myDiv = $this->Html->Div();

	$exampleElement = $this->element('example');

$myDiv->add($exampleElement);
```

**IMPORTANT:** The content of elements are returned as an object. This allows you to add elements to other objects, however, elements do not accept children.

Appending to View Blocks
------------------------

```php
$this->append('script', $this->Html->Script(array(
	'src' => 'example.js'
)));
```

Using a Helper
--------------

```php
$myDiv = $this->Html->Div();

	$something = $this->ExampleHelper->something();

$myDiv->add($something);
```

**IMPORTANT:** The output of a helper method is returned as an object. Objects returned from helpers are automatically converted to their original value if passed to other helpers.

