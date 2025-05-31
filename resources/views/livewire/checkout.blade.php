<div class="container mx-auto px-4 mt-4 grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- Delivery Form --}}
    <div class="bg-white shadow-md p-6 rounded">
        <h2 class="text-xl font-bold mb-4 text-secondary">Delivery Details</h2>

        <form wire:submit.prevent="placeOrder" class="space-y-4">
            <div>
                <label>First Name</label>
                <input type="text" wire:model="first_name" class="input-field w-full">
                @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Last Name</label>
                <input type="text" wire:model="last_name" class="input-field w-full">
                @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Phone Number</label>
                <input type="text" wire:model="phone" class="input-field w-full">
                @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label>Address</label>
                <textarea wire:model="address" class="input-field w-full"></textarea>
                @error('address') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="bg-secondary text-white px-4 py-2 rounded">Place Order</button>
        </form>
    </div>

    {{-- Cart Summary --}}
    <div class="bg-white shadow-md p-6 rounded">
        <h2 class="text-xl font-bold mb-4 text-secondary">Cart Summary</h2>

        @forelse ($cart as $id => $item)
            <div class="flex justify-between items-center border-b py-2">
                <div>
                    <p class="font-semibold">{{ $item['name'] }}</p>
                    <p class="text-sm text-gray-500">Rs {{ number_format($item['price'], 2) }}</p>
                </div>
                <div class="flex items-center space-x-2">
                    <button wire:click="decrement('{{ $id }}')" class="bg-gray-200 px-2">-</button>
                    <span>{{ $item['quantity'] }}</span>
                    <button wire:click="increment('{{ $id }}')" class="bg-gray-200 px-2">+</button>
                </div>
                <button wire:click="remove('{{ $id }}')" class="text-red-500">Remove</button>
            </div>
        @empty
            <p class="text-gray-500">Your cart is empty.</p>
        @endforelse

        <div class="mt-4 text-right font-bold">
            Total: Rs {{ number_format($this->calculateTotal(), 2) }}
        </div>
    </div>
</div>
