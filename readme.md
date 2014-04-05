## Renderer of `UI\Control`

#### Requirements

- PHP 5.4+
- [nette/nette](https://github.com/nette/nette) >= 2.1

## Installation

Just copy source codes from Github or using [Composer](http://getcomposer.org/):
```sh
$ composer require dotblue/nette-control-rendering@~1.0
```

## Usage

If you want your custom component to support mode than default rendering mode, you can achieve that by writing more `render`methods, like this:

```php
public function render()
{
    ...
}

public function renderSmall()
{
    ...
}
```

In template, you can use the second rendering mode with colon notation:

```html
{control foo:small}
```

But this approach doesn't work well with AJAX. Also, sometimes your component consists of many subcomponents, but the whole hierarchical structure should have the same unified set of rendering modes. Imagine for example some data structure, which can be rendered as complex HTML or just a table, and you wish to implement each cell as component as well. Then not only the main component must have 2 rendering modes, but the cell subcomponents too.

That's what `DotBlue\NetteControl\Renderer` class is for. Just wrap your component in its factory method, and set proper rendering mode:

```php
use DotBlue\NetteControl\Renderer;

protected function createComponentFoo()
{
    return new Renderer(new Foo, 'small');
}
```

Now even if you use simple `{control foo}` in template, the `renderSmall()` method will be called for rendering. Including AJAX requests!

But that's not all. All subcomponents of your `Foo` component will get wrapped by the same `Renderer` automatically too. So if they implement method `renderSmall()` as well, it will be used, and you don't need to specify that in template anywhere.
