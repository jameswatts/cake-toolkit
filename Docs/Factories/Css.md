Css Factory
===========

The **Css** factory provides standard objects which represent the individual elements of the **Cascading Style Sheets** standard.

To use the **Css** factory in a View include it in the *$factories* property of the CTK class, for example:

```php
public $factories = array('Ctk.Css');
```

Once the factory is available you can access the objects it provides. To call an object from the factory simply call the factory, and then the desired object, for example:

```php
$this->Css->Rule(array(
	'selector' => '#ID div.class'
));
```

As shown in the example, an array can be passed to the object with parameters to configure the object's template.

The objects available in the **Css** factory are the following:

* [Block](Css/Block.md) - Base object for all *CSS* elements.
* [Declaration](Css/Declaration.md) - Object representating the *CSS* selector.
* [FontFace](Css/FontFace.md) - Object representing the *@font-face* declaration.
* [Media](Css/Media.md) - Object representing the *@media* declaration.
* [Rule](Css/Rule.md) - Object representing a single *property* and *value*.

If using the **Css** factory to build stylesheets it's advised to use the *Ajax* layout for the View.

