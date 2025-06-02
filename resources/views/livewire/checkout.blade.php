<div class="container mx-auto px-4 py-6 max-w-7xl">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        {{-- Delivery Form --}}
        <div class="bg-white shadow-lg border border-gray-100 p-6 sm:p-8 rounded-xl order-2 lg:order-1">
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-secondary">Delivery Details</h2>
            </div>

            <form wire:submit.prevent="placeOrder" class="space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">First Name</label>
                        <input type="text" wire:model="first_name" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                        @error('first_name') <span class="text-red-500 text-sm flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </span> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-semibold text-gray-700">Last Name</label>
                        <input type="text" wire:model="last_name" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                        @error('last_name') <span class="text-red-500 text-sm flex items-center mt-1">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </span> @enderror
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Phone Number</label>
                    <input type="text" wire:model="phone" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white">
                    @error('phone') <span class="text-red-500 text-sm flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </span> @enderror
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Delivery Address</label>
                    <textarea wire:model="address" rows="4" class="input-field w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-secondary focus:border-transparent transition-all duration-200 bg-gray-50 focus:bg-white resize-none" placeholder="Enter your complete delivery address..."></textarea>
                    @error('address') <span class="text-red-500 text-sm flex items-center mt-1">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </span> @enderror
                </div>

                <button type="submit" class="w-full bg-secondary hover:bg-secondary/90 text-white font-semibold px-6 py-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span>Place Order</span>
                </button>
            </form>
        </div>

        {{-- Cart Summary --}}
        <div class="bg-white shadow-lg border border-gray-100 p-6 sm:p-8 rounded-xl order-1 lg:order-2 lg:sticky lg:top-6 lg:h-fit">
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 bg-secondary rounded-full flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-secondary">Cart Summary</h2>
            </div>

            <div class="space-y-4 max-h-96 overflow-y-auto">
                @forelse ($cart as $id => $item)
                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200 hover:shadow-md transition-shadow duration-200">
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start space-y-3 sm:space-y-0">
                            <div class="flex-1">
                                <p class="font-semibold text-gray-800 text-lg">{{ $item['name'] }}</p>
                                <p class="text-secondary font-medium">Rs {{ number_format($item['price'], 2) }}</p>
                            </div>

                            <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
                                <div class="flex items-center justify-center bg-white rounded-lg border border-gray-300 shadow-sm">
                                    <button wire:click="decrement('{{ $id }}')" class="px-3 py-2 text-gray-600 hover:text-secondary hover:bg-gray-50 transition-colors duration-200 rounded-l-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                        </svg>
                                    </button>
                                    <span class="px-4 py-2 font-semibold text-gray-800 bg-gray-50 border-x border-gray-300">{{ $item['quantity'] }}</span>
                                    <button wire:click="increment('{{ $id }}')" class="px-3 py-2 text-gray-600 hover:text-secondary hover:bg-gray-50 transition-colors duration-200 rounded-r-lg">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                        </svg>
                                    </button>
                                </div>

                                <button wire:click="remove('{{ $id }}')" class="flex items-center justify-center px-3 py-2 text-red-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition-colors duration-200 text-sm font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12">
                        <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
                        </svg>
                        <p class="text-gray-500 text-lg">Your cart is empty</p>
                        <p class="text-gray-400 text-sm mt-2">Add some items to get started!</p>
                    </div>
                @endforelse
            </div>

            @if(count($cart) > 0)
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="bg-gradient-to-r from-secondary to-secondary/80 text-white p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-semibold">Total Amount:</span>
                            <span class="text-2xl font-bold">Rs {{ number_format($this->calculateTotal(), 2) }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
