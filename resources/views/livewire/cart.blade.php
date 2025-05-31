<div class="p-6 space-y-6">
    <h2 class="text-3xl font-bold mb-6">🛒 Your Cart</h2>

    @forelse ($cart as $id => $item)
        <div class="flex justify-between items-center border p-4 rounded-md">
            <div>
                <h3 class="text-xl font-semibold">{{ $item['name'] }}</h3>
                <p>${{ number_format($item['price'], 2) }} x {{ $item['quantity'] }}</p>
            </div>
            <div class="flex gap-2 items-center">
                <button wire:click="decrement('{{ $id }}')" class="px-2 bg-gray-200 rounded">-</button>
                <span>{{ $item['quantity'] }}</span>
                <button wire:click="increment('{{ $id }}')" class="px-2 bg-gray-200 rounded">+</button>
                <button wire:click="remove('{{ $id }}')" class="ml-4 px-3 py-1 bg-red-500 text-white rounded">Remove</button>
            </div>
        </div>
    @empty
        <p class="text-gray-500">Your cart is empty.</p>
    @endforelse

    @if(count($cart))
        <div class="mt-6 text-right">
            <button wire:click="checkout" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded">
                Checkout - ${{ number_format($this->calculateTotal(), 2) }}
            </button>
        </div>
    @endif
</div>
