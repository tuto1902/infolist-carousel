@php

$stateArray = $getState();
$stateArray = \Illuminate\Support\Arr::wrap($stateArray);

@endphp
<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div class="text-gray-950 dark:text-white">
        <x-carousel::carousel loop="true" orientation="horizontal">
            @foreach($stateArray as $state)
            <x-carousel::carousel.slide>
                <div class="flex items-center justify-center aspect-square p-6">
                    <span class="text-4xl font-semibold">
                        {{ $state }}
                    </span>
                </div>
            </x-carousel::carousel.slide>
            @endforeach
        </x-carousel::carousel>
    </div>
</x-dynamic-component>
