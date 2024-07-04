@php

$stateArray = $getState();
if ($stateArray instanceof \Illuminate\Support\Collection) {
    $stateArray = $stateArray->all();
}
$stateArray = \Illuminate\Support\Arr::wrap($stateArray);

@endphp
<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div class="text-gray-950 dark:text-white">
        <x-carousel::carousel
            :loop="$getLoop()"
            :orientation="$getOrientation()"
            :autoplay="$getAutoplay()"
            :delay="$getDelay()"
            :size="$getSize()"
        >
            @foreach($stateArray as $state)
            <x-carousel::carousel.slide>
                @include($getSlideView($state))
            </x-carousel::carousel.slide>
            @endforeach
        </x-carousel::carousel>
    </div>
</x-dynamic-component>
