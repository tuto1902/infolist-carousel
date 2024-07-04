<div class="flex items-center justify-center aspect-square p-6">
    <span class="text-4xl font-semibold">
        @if ($state instanceof \Illuminate\Database\Eloquent\Model)
        {{ $state->getKey() }}
        @else
        {{ $state }}
        @endif
    </span>
</div>
