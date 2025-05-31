<div
    x-data="{ show: @entangle('visible') }"
    x-show="show"
    x-transition:enter="transition ease-out duration-500"
    x-transition:enter-start="opacity-0 translate-x-full"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 translate-x-full"
    x-init="
        $wire.on('flashMessageShown', () => {
            show = true;
            setTimeout(() => show = false, 3000);
        });
    "
    class="absolute right-5 mt-4 px-4 py-3 rounded shadow-lg text-white z-40"
    :class="{
        'bg-green-600': '{{ $type }}' === 'success',
        'bg-red-600': '{{ $type }}' === 'error'
    }"
>
    {{ $message }}
</div>
