<?php

namespace Tuto1902\InfolistCarousel\Infolists\Components;

use Closure;
use Filament\Infolists\Components\Entry;
use Tuto1902\InfolistCarousel\Infolists\Components\Carousel\CarouselOrientation;
use Tuto1902\InfolistCarousel\Infolists\Components\Carousel\CarouselSize;

class Carousel extends Entry
{
    protected string $view = 'infolist-carousel::infolists.components.carousel';
    protected string|Closure|null $slideTemplate = null;
    protected bool|Closure $isLoopingEnabled = true;
    protected bool|Closure $isAutoplayEnabled = false;
    protected int|Closure $autoplayDelay = 4000;
    protected int|Closure $scrollDuration = 20;
    protected CarouselSize|string|Closure $carouselSize = CarouselSize::Large;
    protected CarouselOrientation|Closure $carouselOrientation = CarouselOrientation::Horizontal;
    private string $defaultSlideView = 'infolist-carousel::infolists.components.carousel-slide';

    public function slideView(string|Closure $template): static
    {
        $this->slideTemplate = $template;
        return $this;
    }

    public function loop(bool|Closure $loop = true): static
    {
        $this->isLoopingEnabled = $loop;
        return $this;
    }

    public function orientation(CarouselOrientation|Closure $orientation): static
    {
        $this->carouselOrientation = $orientation;

        return $this;
    }

    public function duration(int|Closure $duration): static
    {
        $this->scrollDuration = $duration;

        return $this;
    }

    public function autoplay(bool|Closure|null $autoplay = true): static
    {
        $this->isAutoplayEnabled = $autoplay;

        return $this;
    }

    public function delay(int|Closure $delay): static
    {
        $this->autoplayDelay = $delay;

        return $this;
    }

    public function size(CarouselSize|string|Closure $size): static
    {
       $this->carouselSize = $size;

       return $this;
    }

    public function getSlideView($slideState)
    {
        $slideTemplate = $this->evaluate($this->slideTemplate, ['slideState' => $slideState]);
        return $slideTemplate ?? $this->defaultSlideView;
    }

    public function getLoop()
    {
        $loop = $this->evaluate($this->isLoopingEnabled);
        return $loop === true ? 'true' : 'false';
    }

    public function getOrientation()
    {
        $orientation = $this->evaluate($this->carouselOrientation);
        return $orientation->value;
    }

    public function getDuration()
    {
       $duration = $this->evaluate($this->scrollDuration);
       return $duration;
    }

    public function getAutoplay()
    {
        $autoplay = $this->evaluate($this->isAutoplayEnabled);
        return $autoplay === true ? 'true' : 'false';
    }

    public function getDelay()
    {
        $delay = $this->evaluate($this->autoplayDelay);
        return $delay;
    }

    public function getSize()
    {
        $size = $this->evaluate($this->carouselSize);
        if ($size instanceof CarouselSize) {
            return $size->value;
        }
        return $size;
    }
}
