<?php

namespace Tuto1902\InfolistCarousel;

use Filament\Support\Assets\Js;
use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Tuto1902\InfolistCarousel\Commands\InfolistCarouselCommand;

class InfolistCarouselServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('infolist-carousel')
            ->hasViews();
    }

    public function packageBooted()
    {
        FilamentAsset::register([
            Js::make('infolists/components/carousel', __DIR__ . '/../resources/dist/carousel.js'),
            Css::make('infolists/carousel', __DIR__ . '/../resources/dist/carousel.css')
        ], 'tuto1902/infolist-carousel');
    }
}
