Js Factory
==========

The **Js** factory provides a collection of event objects which allow the introduction of client scripting with **JavaScript**. These objects are not to be confused with the **Js** helper available in *CakePHP*, for this check out the [Cake](https://github.com/jameswatts/cake-factory) factory.

To use the **Js** factory in a View include it in the *$factories* property of the CTK class, for example:

```php
public $factories = array('Ctk.Js');
```

Once the factory is available you can access the event objects it provides. To bind an event object from the factory simply call the factory, and then the desired event object, for example:

```php
$button->bind('click', $this->Js->Alert(array(
	'text' => __('Click me!')
)));
```

As shown in the example, an array can be passed to the object with parameters to configure the object's template.

Some event objects expose subsequent APIs, allowing additional configuration, for example:

```php
$button->bind('click', $this->Js->Element(array('node' => $div))->toggle()); // Element wraps the node, then toggle() appends the client code
```

The event objects available in the **Js** factory are the following:

* [Ajax](Js/Ajax.md) - Object interface to the *XmlRpcRequest* object.
* [Alert](Js/Alert.md) - Object representing alert dialogs.
* [Callback](Js/Callback.md) - Object for wrapping client code as a callback.
* [Code](Js/Code.md) - Object for wrapping raw client code.
* [Confirm](Js/Confirm.md) - Object representing confirm dialogs.
* [Cookie](Js/Cookie.md) - Object interface to browser *cookies*.
* [Document](Js/Document.md) - Object interface to the *document* object.
* [Element](Js/Element.md) - Object interface to *DOM* elements.
* [Event](Js/Event.md) - Base object for all *JavaScript* events.
* [History](Js/History.md) - Object interface to the *history* object.
* [Json](Js/Json.md) - Object representing *JSON* data.
* [Listener](Js/Listener.md) - Object representing an event listener.
* [Location](Js/Location.md) - Object interface to the *location* object.
* [Navigator](Js/Navigator.md) - Object interface to the *navigator* object.
* [Prompt](Js/Prompt.md) - Object representing prompt dialogs.
* [Redirect](Js/Redirect.md) - Object representing alert dialogs.
* [Window](Js/Window.md) - Object interface to the *window* object.

The **Js** factory provides a layout specific for *JavaScript*, which can be set from the *$layout* property of the CTK class, for example:

```php
public $layout = 'Ctk.Js/default';
```

