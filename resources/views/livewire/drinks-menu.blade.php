<div class="p-6 space-y-10">
    <h1 class="text-3xl font-bold text-center mb-8">🥤 Beverages Menu</h1>
    @if($hasItems)
        @foreach ($groupedItems as $category => $items)
            <div class="mb-10">
                <h2 class="text-2xl font-bold mb-6 capitalize text-gray-800 border-b-2 border-orange-500 pb-2">
                    🥤 {{ ucfirst($category) }}
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($items as $item)
                        <div class="bg-white p-6 shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300 border">
                            <!-- Beverage Image -->
                            <div class="mb-4 rounded-lg overflow-hidden">
                                @if($item->image)
                                    <img src="{{ $item->image }}"
                                         alt="{{ $item->name }}"
                                         class="w-full h-48 object-cover hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-full h-48 bg-gray-100 flex items-center justify-center rounded-lg">
                                        <div class="text-center text-gray-400">
                                            <div class="text-4xl mb-2">🥤</div>
                                            <p class="text-sm">No Image Available</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $item->name }}</h3>
                            <p class="text-sm text-gray-600 mb-3 leading-relaxed">{{ $item->description }}</p>
                            <div class="flex justify-between items-center">
                                <p class="text-2xl font-bold text-green-600">${{ number_format((float) $item->price, 2) }}</p>
                                <button wire:click="addToCart('{{ $item->id}}')" class="bg-primary hover:bg-orange-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 font-medium">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    @else
        <div class="text-center py-12">
            <div class="text-6xl mb-4">🥤</div>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">No beverages available</h3>
            <p class="text-gray-500">Check back soon for our refreshing drinks menu!</p>
        </div>
    @endif
</div>
