@php

$stateArray = $getState();
$stateArray = \Illuminate\Support\Arr::wrap($stateArray);

@endphp
<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div class="text-gray-950 dark:text-white">
        <x-carousel::carousel :loop="$getLoop()" :orientation="$getOrientation()" :autoplay="$getAutoplay()" :delay="$getDelay()">
            @foreach($stateArray as $state)
            <x-carousel::carousel.slide>
                @include($getSlideView($state))
            </x-carousel::carousel.slide>
            @endforeach
        </x-carousel::carousel>
    </div>
</x-dynamic-component>
