<div {{ $attributes->merge(['class' => "my-4 p-4 rounded-md !flex items-center gap-4"]) }} >
    <x-ei-spinner-3 class="animate-spin w-9 h-9 font-bold text-blue-500"/>
    <span class="flex-1 text-blue-500">
        @if($slot->isEmpty())
            <p>Processing data...</p>
        @else
            {{ $slot }}
        @endif
    </span>
</div>
