<?php

namespace Tuto1902\InfolistCarousel\Infolists\Components;

use Closure;
use Filament\Infolists\Components\Entry;
use Tuto1902\InfolistCarousel\Infolists\Components\Carousel\CarouselOrientation;

class Carousel extends Entry
{
    protected string $view = 'infolist-carousel::infolists.components.carousel';
    protected string|Closure|null $slideTemplate = null;
    protected bool|Closure $isLoopingEnabled = true;
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
}
