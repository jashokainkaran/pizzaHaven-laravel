<div class="max-w-4xl mx-auto p-6 space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between border-b border-gray-200 pb-6">
        <h2 class="text-2xl font-bold text-gray-900">Your Cart</h2>
        <div class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
            {{ count($cart) }} {{ count($cart) === 1 ? 'item' : 'items' }}
        </div>
    </div>

    @forelse ($cart as $id => $item)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
            <div class="flex items-center justify-between">
                <!-- Item Image and Info -->
                <div class="flex items-center space-x-4 flex-1">
                    <!-- Item Image -->
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                            @if(isset($item['image']) && $item['image'])
                                <img src="{{ $item['image'] }}"
                                     alt="{{ $item['name'] }}"
                                     class="w-full h-full object-cover">
                            @else
                                <!-- Fallback placeholder -->
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <span class="material-icons text-lg">restaurant</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Item Details -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-lg font-semibold text-secondary mb-2 truncate">{{ $item['name'] }}</h3>
                        <div class="flex items-center space-x-4">
                            <span class="text-xl font-bold text-gray-800">${{ number_format($item['price'], 2) }}</span>
                            <span class="text-gray-400">×</span>
                            <span class="text-base text-gray-600">{{ $item['quantity'] }}</span>
                            <span class="text-gray-400">=</span>
                            <span class="text-lg font-semibold text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <div class="flex items-center space-x-3 flex-shrink-0">
                    <!-- Quantity Controls -->
                    <div class="flex items-center bg-gray-50 rounded-lg border border-gray-200">
                        <button wire:click="decrement('{{ $id }}')"
                                class="p-2 hover:bg-gray-100 rounded-l-lg transition-colors duration-150 text-gray-600 hover:text-gray-800">
                            <span class="material-icons text-sm">remove</span>
                        </button>
                        <span class="px-4 py-2 min-w-[3rem] text-center font-semibold text-gray-900 bg-white border-x border-gray-200">
                            {{ $item['quantity'] }}
                        </span>
                        <button wire:click="increment('{{ $id }}')"
                                class="p-2 hover:bg-gray-100 rounded-r-lg transition-colors duration-150 text-gray-600 hover:text-gray-800">
                            <span class="material-icons text-sm">add</span>
                        </button>
                    </div>

                    <!-- Remove Button -->
                    <button wire:click="remove('{{ $id }}')"
                            class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-150"
                            title="Remove item">
                        <span class="material-icons text-lg">delete_outline</span>
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16">
            <div class="text-6xl mb-4">🛒</div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Your cart is empty</h3>
            <p class="text-gray-500">Add some delicious items to get started!</p>
        </div>
    @endforelse

    @if(count($cart))
        <!-- Cart Summary -->
        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <span class="text-lg font-semibold text-gray-700">Total Amount</span>
                <span class="text-2xl font-bold text-gray-800">${{ number_format($this->calculateTotal(), 2) }}</span>
            </div>

            <button wire:click="checkout"
                    class="w-full text-white font-semibold py-4 px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5"
                    style="background-color: #d31310;"
                    onmouseover="this.style.backgroundColor='#730303'"
                    onmouseout="this.style.backgroundColor='#d31310'">
                <span class="flex items-center justify-center space-x-2">
                    <span class="material-icons">shopping_cart_checkout</span>
                    <span>Proceed to Checkout</span>
                </span>
            </button>
        </div>
    @endif
</div>
