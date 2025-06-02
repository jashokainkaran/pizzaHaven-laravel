<div class="min-h-screen bg-gray-50 py-4 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">🍕 Pizza Menu</h1>
            <p class="text-gray-600 text-sm sm:text-base">Delicious pizzas made fresh daily</p>
        </div>

        <!-- Search Section -->
        <div class="bg-white rounded-lg shadow-sm border p-4 sm:p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 flex-1">
                    <label for="search" class="text-sm font-medium text-gray-700 shrink-0">
                        Search Pizzas:
                    </label>
                    <input wire:model.live="search"
                           id="search"
                           type="text"
                           placeholder="Search by name or description..."
                           class="w-full sm:flex-1 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-orange-500 focus:border-orange-500 bg-white text-sm transition-colors">
                </div>

                @if($hasItems && $items)
                    <div class="text-xs sm:text-sm text-gray-500 order-first sm:order-last">
                        <span class="inline-block bg-gray-100 px-2 py-1 rounded-md">
                            {{ $items->count() }} of {{ $items->total() }} pizzas
                        </span>
                    </div>
                @endif
            </div>

            <!-- Pizza Search Loader -->
            <div wire:loading wire:target="search" class="flex justify-center mt-4">
                <div class="flex items-center gap-2 px-4 py-2 rounded-full bg-orange-100 text-orange-700 text-sm font-semibold shadow-sm animate-bounce transition-all">
                    <svg class="h-5 w-5 text-red-500 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C10 5 9 8 9 12s1 7 3 10c2-3 3-6 3-10s-1-7-3-10zm0 3a1.5 1.5 0 01.5 2.91A1.5 1.5 0 0112 5zm-3.75 8a.75.75 0 100 1.5h7.5a.75.75 0 000-1.5h-7.5z"/>
                    </svg>
                    🍕 Searching for pizzas...
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div wire:loading.remove>
            @if($hasItems && $groupedItems->isNotEmpty())
                @foreach ($groupedItems as $category => $categoryItems)
                    <div class="mb-8 lg:mb-12">
                        <div class="mb-6 border-b-2 border-orange-600 pb-2">
                            <h2 class="mb-3 text-xl sm:text-2xl lg:text-3xl font-bold capitalize text-gray-800 inline-block">
                                🍕 {{ ucfirst($category) }} Pizzas
                            </h2>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4 sm:gap-6 mt-3">
                            @foreach ($categoryItems as $item)
                                <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 overflow-hidden border group">
                                    <div class="relative overflow-hidden bg-gray-100">
                                        @if($item->image)
                                            <img src="{{ asset('storage/' . $item->image) }}"
                                                 alt="{{ $item->name }}"
                                                 class="w-full h-40 sm:h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                                 loading="lazy">
                                        @else
                                            <div class="w-full h-40 sm:h-48 bg-gradient-to-br from-orange-50 to-orange-100 flex items-center justify-center">
                                                <div class="text-center text-orange-300">
                                                    <div class="text-3xl sm:text-4xl mb-2">🍕</div>
                                                    <p class="text-xs sm:text-sm font-medium">No Image</p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="p-4 sm:p-5">
                                        <h3 class="text-lg sm:text-xl font-semibold mb-2 text-gray-800 truncate">
                                            {{ $item->name }}
                                        </h3>
                                        <p class="text-xs sm:text-sm text-gray-600 mb-4 leading-relaxed h-10 overflow-hidden">
                                            {{ $item->description ?? 'Delicious pizza made with fresh ingredients.' }}
                                        </p>

                                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xl sm:text-2xl font-bold text-secondary">
                                                    Rs {{ number_format((float) ($item->price ?? 0), 2) }}
                                                </span>
                                                @if(isset($item->original_price) && $item->original_price > $item->price)
                                                    <span class="text-sm text-gray-400 line-through">
                                                        Rs {{ number_format((float) $item->original_price, 2) }}
                                                    </span>
                                                @endif
                                            </div>
                                            <button wire:click="addToCart('{{ $item->_id ?? $item->id }}')"
                                                    class="w-full sm:w-auto bg-primary hover:bg-orange-600 text-white px-4 py-2 rounded-md transition-colors duration-200 font-medium text-sm whitespace-nowrap flex items-center justify-center">
                                                Add to Cart
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach

                <!-- Pagination -->
                @if($items->hasPages())
                    <div class="mt-8 flex justify-center">
                        <div class="w-full sm:w-auto">
                            {{ $items->links() }}
                        </div>
                    </div>
                @endif
            @else
                <div class="bg-white rounded-lg shadow-sm border p-8 sm:p-12 text-center">
                    <div class="text-4xl sm:text-6xl mb-4">🍕</div>
                    <h3 class="text-lg sm:text-xl font-semibold text-gray-600 mb-2">No pizzas found</h3>
                    <p class="text-gray-500 text-sm sm:text-base max-w-md mx-auto mb-4">
                        @if($search)
                            No pizzas found matching "{{ $search }}". Try a different search term.
                        @else
                            Our delicious pizzas are currently being prepared. Check back soon!
                        @endif
                    </p>
                    @if($search)
                        <button wire:click="$set('search', '')"
                                class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-md transition-colors duration-200 text-sm font-medium">
                            Clear Search
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
