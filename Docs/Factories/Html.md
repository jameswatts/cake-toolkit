Html Factory
============

The **Html** factory provides standard objects which represent the elements available as part of the **Hypertext Markup Language**. These objects are not to be confused with the **Html** helper available in *CakePHP*, for this check out the [Cake](https://github.com/jameswatts/cake-factory) factory.

To use the **Html** factory in a View include it in the *$factories* property of the CTK class, for example:

```php
public $factories = array('Ctk.Html');
```

Once the factory is available you can access the objects it provides. To call an object from the factory simply call the factory, and then the desired object, for example:

```php
$this->Html->Div(array(
	'text' => __('Hello World')
));
```

As shown in the example, an array can be passed to the object with parameters to configure the object's template.

The objects available in the **Html** factory are the following:

* [A](Html/A.md) - Object representing the *A* element for hyperlinks.
* [Abbr](Html/Abbr.md) - Object representing the *ABBR* element for abbreviations.
* [Address](Html/Address.md) - Object representing the *ADDRESS* element for contact addresses.
* [Area](Html/Area.md) - Object representing the *Area* element for an area of an image map.
* [B](Html/B.md) - Object representing the *B* element for bold text.
* [Base](Html/Base.md) - Object representing the *BASE* element for base target for relative URLs.
* [Bdo](Html/Bdo.md) - Object representing the *BDO* element for bi-directional override.
* [Blockquote](Html/Blockquote.md) - Object representing the *BLOCKQUOTE* element for block quotes.
* [Body](Html/Body.md) - Object representing the *BODY* element.
* [Br](Html/Br.md) - Object representing the *BR* element for line breaks.
* [Button](Html/Button.md) - Object representing the *BUTTON* element for form buttons. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [Caption](Html/Caption.md) - Object representing the *CAPTION* element for table captions.
* [Cite](Html/Cite.md) - Object representing the *CITE* element for citations.
* [Code](Html/Code.md) - Object representing the *CODE* element for code blocks.
* [Col](Html/Col.md) - Object representing the *COL* element for tbale column properties.
* [Colgroup](Html/Colgroup.md) - Object representing the *COLGROUP* element for groups of table columns.
* [Comment](Html/Comment.md) - Object representing the comment element.
* [Dd](Html/Dd.md) - Object representing the *DD* element for definition descriptions.
* [Del](Html/Del.md) - Object representing the *DEL* element for deleted text.
* [Dfn](Html/Dfn.md) - Object representing the *DFN* element for a definition term.
* [Div](Html/Div.md) - Object representing the *DIV* element for a block of content.
* [Dl](Html/Dl.md) - Object representing the *DL* element for definition lists.
* [Doctype](Html/Doctype.md) - Object representing the document type.
* [Dt](Html/Dt.md) - Object representing the *DT* element for definition terms.
* [Element](Html/Element.md) - Base object for all *HTML* elements.
* [Em](Html/Em.md) - Object representing the *EM* element for text with emphasis.
* [Fieldset](Html/Fieldset.md) - Object representing the *FIELDSET* element in forms. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [Form](Html/Form.md) - Object representing the *FORM* element. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [H](Html/H.md) - Object representing the base header element.
* [H1](Html/H1.md) - Object representing the *H1* header element.
* [H2](Html/H2.md) - Object representing the *H2* header element.
* [H3](Html/H3.md) - Object representing the *H3* header element.
* [H4](Html/H4.md) - Object representing the *H4* header element.
* [H5](Html/H5.md) - Object representing the *H5* header element.
* [H6](Html/H6.md) - Object representing the *H6* header element.
* [Head](Html/Head.md) - Object representing the *HEAD* element.
* [Hr](Html/Hr.md) - Object representing the *HR* element for horizontal rules.
* [Html](Html/Html.md) - Object representing the root *HTML* element.
* [I](Html/I.md) - Object representing the *I* element for italics.
* [Iframe](Html/Iframe.md) - Object representing the *IFRAME* element for containing another document.
* [Img](Html/Img.md) - Object representing the *IMG* element for images.
* [Input](Html/Input.md) - Object representing the *INPUT* element for form inputs. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [Ins](Html/Ins.md) - Object representing the *INS* element for inserted text.
* [Kbd](Html/Kbd.md) - Object representing the *KBD* element for keyboard input.
* [Label](Html/Label.md) - Object representing the *LABEL* element for form labels. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [Legend](Html/Legend.md) - Object representing the *LEGEND* element for fieldsets. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [Li](Html/Li.md) - Object representing the *LI* element for list items.
* [Link](Html/Link.md) - Object representing the *LINK* element for linked resources.
* [Map](Html/Map.md) - Object representing the *MAP* element for image maps.
* [Meta](Html/Meta.md) - Object representing the *META* element for meta content.
* [Noscript](Html/Noscript.md) - Object representing the *NOSCRIPT* element for when scripting is not available.
* [Object](Html/Object.md) - Object representing the *OBJECT* element for embedded objects.
* [Ol](Html/Ol.md) - Object representing the *OL* element for ordered lists.
* [Optgroup](Html/Optgroup.md) - Object representing the *OPTGROUP* element for groups of options in selects. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [Option](Html/Option.md) - Object representing the *OPTION* element for select options. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [P](Html/P.md) - Object representing the *P* element for paragraphs.
* [Param](Html/Param.md) - Object representing the *PARAM* element for embedded objects.
* [Pre](Html/Pre.md) - Object representing the *PRE* element for preformatted text.
* [Q](Html/Q.md) - Object representing the *Q* element for quoted text.
* [S](Html/S.md) - Object representing the *S* element for stike-through text.
* [Samp](Html/Samp.md) - Object representing the *SAMP* element for sample text.
* [Script](Html/Script.md) - Object representing the *SCRIPT* element for client scripts.
* [Select](Html/Select.md) - Object representing the *SELECT* element for selects. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [Small](Html/Small.md) - Object representing the *SMALL* element for small text.
* [Span](Html/Span.md) - Object representing the *SPAN* element for spanned text.
* [Strong](Html/Strong.md) - Object representing the *STRONG* element for strong text.
* [Style](Html/Style.md) - Object representing the *STYLE* element for *CSS* styles.
* [Sub](Html/Sub.md) - Object representing the *SUB* element for subscript.
* [Sup](Html/Sup.md) - Object representing the *SUP* element for superscript.
* [Table](Html/Table.md) - Object representing the *TABLE* element for tables.
* [Tbody](Html/Tbody.md) - Object representing the *TBODY* element for table bodies.
* [Td](Html/Td.md) - Object representing the *TD* element for table cells.
* [Textarea](Html/Textarea.md) - Object representing the *TEXTAREA* element for textareas. Use the [Cake](https://github.com/jameswatts/cake-factory) factory for *CakePHP* forms.
* [Tfoot](Html/Tfoot.md) - Object representing the *TFOOT* element for table footers.
* [Th](Html/Th.md) - Object representing the *TH* element for table headers.
* [Thead](Html/Thead.md) - Object representing the *THEAD* element for table heads.
* [Title](Html/Title.md) - Object representing the *TITLE* element for document titles.
* [Tr](Html/Tr.md) - Object representing the *TR* element for table rows.
* [Ul](Html/Ul.md) - Object representing the *UL* element for unordered lists.
* [Var](Html/Var.md) - Object representing the *VAR* element for variables.

There are also various **layouts** available for this factory:

* **default**: This is the default layout used by CTK views.
* **html4**: A HTML 4.01 compatible layout.
* **html5**: A HTML 5 compatible layout.
* **xhtml**: An XHTML 1.0 compatible layout.

The layout can be set from the *$layout* property of the CTK class, for example:

```php
public $layout = 'Ctk.Html/html5';
```

