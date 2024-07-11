# Infolist Carousel Entry for Filament v3

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tuto1902/infolist-carousel.svg?style=flat-square)](https://packagist.org/packages/tuto1902/infolist-carousel)
[![Total Downloads](https://img.shields.io/packagist/dt/tuto1902/infolist-carousel.svg?style=flat-square)](https://packagist.org/packages/tuto1902/infolist-carousel)

Infolist Carousel entry that allows you to add a slide carousel to any of you Filament v3 projects.

## Screenshots

![infolist-carousel](https://github.com/tuto1902/infolist-carousel/assets/2152532/e742f4bf-02b3-4a0d-a3ea-e3afa678d303)

## Installation

You can install the package via composer:

```bash
composer require tuto1902/infolist-carousel
```

Add the following lines in the content section of your `tailwind.config.js` file

```js
export default {
  presets: [preset],
  content: [
+    './vendor/tuto1902/carousel/resources/**/*.blade.php',
+    './vendor/tuto1902/infolist-carousel/resources/**/*.blade.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="infolist-carousel-views"
```

You can also publish the carousel blade components using

```bash
php artisan vendor:publish --tag="carousel-views"
```

## Usage
Simply import the Carousel component and include it in your Infolist schema. The following is an example using a panel builder resource
```php
use Tuto1902\InfolistCarousel\Infolists\Components\Carousel;
use Filament\Infolists\Infolist;

public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Carousel::make('slides.file_name')
        ]);
}
```

By default, the slides will display the column value (or the primary key of your model). You can provide your own slide view using:

```php

public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Carousel::make('slides.file_name')
                ->slideView('my-slide-template')
        ]);
}
```
The view sould be created inside your project's `resources/views` folder. Here's an example of a simple square slide with an image background.

```html
<div
    class="aspect-square bg-cover bg-center bg-no-repeat w-full h-full rounded-md"
    style="background-image: url('/{{ $state }}');"
>
    <!-- // -->
</div>
```

In this scenario, the `$state` variable points to the value of the `slides.file_name` column. If a column value is not provided, the `$state` variable will be Model instance. For example, imagine that you have a `Carousel` model (and it's corresponding Resource with an infolist page). Inside this model, you have a `HasMany` relationship with the `Slide` model. Therefore, you can get a list of all carousel slides using the `->slides` property of the `Carousel` model class. If you only provide the relationship name to the `Carousle::make` method, the `$state` variable will be a `Slide` model instance. This way, you have access to all the information from `Slide` model inside your slide template.

```php
public static function infolist(Infolist $infolist): Infolist
{
    return $infolist
        ->schema([
            Carousel::make('slides')
                ->slideView('my-slide-template')
        ]);
}
```

```html
<div
    class="..."
    style="background-image: url('/{{ $state->file_name }}');"
>
    <!-- // -->
</div>
```

## Customization

You can customize the look and feel of your carousel usign the following options.

### Loop
The carousel will loop back to the start/end of your slides.

```php
    Carousel::make('slides.file_name')
        ->loop()
```

### Orientation
Change the orientation of the carousel. You can choose between Verical and Horizontal (default)

```php
    use Tuto1902\InfolistCarousel\Infolists\Components\Carousel\CarouselOrientation;

    Carousel::make('slides.file_name')
        ->orientation(CarouselOrientation::Vertical)
```

### Size
Change the size of the carousel frame. You can choose between Small, Medium and Large. Additionally, you can provide any valid TailwindCSS `size-*` class as a string
```php
    use Tuto1902\InfolistCarousel\Infolists\Components\Carousel\CarouselSize;

    Carousel::make('slides.file_name')
        ->size(CarouselSize::Large)
        // or
        ->size('size-96')
```
> [!IMPORTANT]
> In order to provide TailwindCSS classes to the `size` function, you'll need to add the following line inside the content section of your `tailwind.config.js` file.

```js
export default {
  presets: [preset],
  content: [
    './vendor/tuto1902/carousel/resources/**/*.blade.php',
    './vendor/tuto1902/infolist-carousel/resources/**/*.blade.php',
+    './vendor/tuto1902/infolist-carousel/src/Infolists/Components/**/*.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
```
### Autoplay & Delay
Slides will navigate automatically using the specified delay (in miliseconds). If no delay is provided, the default will be 4000 (4 seconds)

```php
    Carousel::make('slides.file_name')
        ->autoplay()
        ->delay(2000)
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Arturo Rojas](https://github.com/tuto1902)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
