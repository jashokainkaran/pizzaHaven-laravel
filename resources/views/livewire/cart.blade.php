<div class="max-w-4xl mx-auto p-4 md:p-6 space-y-6 md:space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between border-b border-gray-200 pb-4 md:pb-6">
        <h2 class="text-xl md:text-2xl font-bold text-gray-900">Your Cart</h2>
        <div class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm font-medium">
            {{ count($cart) }} {{ count($cart) === 1 ? 'item' : 'items' }}
        </div>
    </div>

    @forelse ($cart as $id => $item)
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 md:p-6 hover:shadow-md transition-all duration-300">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
                <!-- Item Image and Info -->
                <div class="flex items-center space-x-3 md:space-x-4 flex-1">
                    <!-- Item Image -->
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gray-100 rounded-lg overflow-hidden border border-gray-200">
                            @if(isset($item['image']) && $item['image'])
                                <img src="{{ $item['image'] }}"
                                     alt="{{ $item['name'] }}"
                                     class="w-full h-full object-cover">
                            @else
                                <!-- Fallback placeholder -->
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <span class="material-icons text-base sm:text-lg">restaurant</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Item Details -->
                    <div class="flex-1 min-w-0">
                        <h3 class="text-base sm:text-lg font-semibold text-secondary mb-1 sm:mb-2 truncate">{{ $item['name'] }}</h3>
                        <div class="flex flex-wrap items-center gap-2 sm:space-x-4 sm:gap-0">
                            <span class="text-lg sm:text-xl font-bold text-gray-800">Rs {{ number_format($item['price'], 2) }}</span>
                            <span class="text-gray-400 hidden sm:inline">×</span>
                            <span class="text-sm sm:text-base text-gray-600">× {{ $item['quantity'] }}</span>
                            <span class="text-gray-400 hidden sm:inline">=</span>
                            <span class="text-base sm:text-lg font-semibold text-gray-900">Rs {{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <div class="flex items-center justify-between sm:justify-end space-x-3 flex-shrink-0">
                    <!-- Quantity Controls -->
                    <div class="flex items-center bg-gray-50 rounded-lg border border-gray-200">
                        <button wire:click="decrement('{{ $id }}')"
                                class="p-1.5 sm:p-2 hover:bg-gray-100 rounded-l-lg transition-colors duration-150 text-gray-600 hover:text-gray-800">
                            <span class="material-icons text-sm">remove</span>
                        </button>
                        <span class="px-3 sm:px-4 py-1.5 sm:py-2 min-w-[2.5rem] sm:min-w-[3rem] text-center font-semibold text-gray-900 bg-white border-x border-gray-200 text-sm sm:text-base">
                            {{ $item['quantity'] }}
                        </span>
                        <button wire:click="increment('{{ $id }}')"
                                class="p-1.5 sm:p-2 hover:bg-gray-100 rounded-r-lg transition-colors duration-150 text-gray-600 hover:text-gray-800">
                            <span class="material-icons text-sm">add</span>
                        </button>
                    </div>

                    <!-- Remove Button -->
                    <button wire:click="remove('{{ $id }}')"
                            class="p-1.5 sm:p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-150"
                            title="Remove item">
                        <span class="material-icons text-base sm:text-lg">delete_outline</span>
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-12 md:py-16">
            <div class="text-4xl md:text-6xl mb-4">🛒</div>
            <h3 class="text-lg md:text-xl font-semibold text-gray-600 mb-2">Your cart is empty</h3>
            <p class="text-gray-500">Add some delicious items to get started!</p>
        </div>
    @endforelse

    @if(count($cart))
        <!-- Cart Summary -->
        <div class="bg-gray-50 rounded-xl p-4 md:p-6 border border-gray-200">
            <div class="flex items-center justify-between mb-4">
                <span class="text-base md:text-lg font-semibold text-gray-700">Total Amount</span>
                <span class="text-xl md:text-2xl font-bold text-gray-800">Rs {{ number_format($this->calculateTotal(), 2) }}</span>
            </div>

            <button wire:click="checkout"
                    class="w-full text-white font-semibold py-3 md:py-4 px-4 md:px-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-0.5"
                    style="background-color: #d31310;"
                    onmouseover="this.style.backgroundColor='#730303'"
                    onmouseout="this.style.backgroundColor='#d31310'">
                <span class="flex items-center justify-center space-x-2">
                    <span class="material-icons">shopping_cart_checkout</span>
                    <span class="text-sm md:text-base">Proceed to Checkout</span>
                </span>
            </button>
        </div>
    @endif
</div>
