<div class="p-3 sm:p-4 lg:p-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Header -->
    <div class="mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-1 sm:mb-2">📦 Order Management</h1>
        <p class="text-gray-600 text-xs sm:text-sm lg:text-base">Manage and track all customer orders</p>
    </div>

    <!-- Loading Overlay -->
    <div wire:loading class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl p-4 sm:p-6 flex items-center space-x-3 shadow-2xl">
            <div class="animate-spin rounded-full h-5 w-5 sm:h-6 sm:w-6 border-b-2 border-blue-600"></div>
            <span class="text-gray-700 text-sm sm:text-base">Processing...</span>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4 sm:mb-6 overflow-hidden">
        <div class="p-3 sm:p-4">
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-end">
                <!-- Search -->
                <div class="flex-1 w-full">
                    <label for="search" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Search Orders</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 sm:h-5 sm:w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input
                            type="text"
                            id="search"
                            wire:model.live.debounce.300ms="searchTerm"
                            placeholder="Search by Order ID, Customer Name, or Email..."
                            class="w-full pl-9 sm:pl-10 pr-10 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all text-sm sm:text-base"
                        >
                        @if($searchTerm)
                            <button
                                wire:click="clearSearch"
                                class="absolute right-2 sm:right-3 top-2.5 sm:top-3 text-gray-400 hover:text-gray-600 transition-colors"
                            >
                                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Status Filter -->
                <div class="w-full sm:w-48">
                    <label for="status" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Filter by Status</label>
                    <select
                        id="status"
                        wire:model.live="statusFilter"
                        class="w-full px-3 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm sm:text-base"
                    >
                        <option value="all">All Orders</option>
                        <option value="Pending">Pending</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    @if($searchTerm)
        <div class="mb-3 sm:mb-4 text-xs sm:text-sm text-gray-600 px-1">
            Showing results for "<strong class="text-gray-900">{{ $searchTerm }}</strong>"
        </div>
    @endif

    <!-- Mobile Cards View (visible on small screens) -->
    <div class="block lg:hidden space-y-3 sm:space-y-4">
        @forelse($orders as $order)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-4 sm:p-5">
                    <div class="flex justify-between items-start mb-3">
                        <div>
                            <h3 class="text-base sm:text-lg font-semibold text-gray-900">
                                Order #{{ substr((string)$order->_id, -8) }}
                            </h3>
                            <p class="text-xs sm:text-sm text-gray-500">
                                {{ $order->created_at->format('M d, Y H:i') }}
                            </p>
                        </div>
                        <span class="text-lg font-bold text-green-600">Rs {{ number_format($order->total, 2) }}</span>
                    </div>

                    <div class="mb-3">
                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                            @if($order->status === 'Pending') bg-yellow-100 text-yellow-800
                            @elseif($order->status === 'Completed') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800 @endif">
                            {{ $order->status }}
                        </span>
                    </div>

                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-900">
                            {{ $order->user->first_name ?? 'N/A' }} {{ $order->user->last_name ?? 'N/A' }}
                        </p>
                        <p class="text-xs text-gray-500">{{ $order->user->email ?? 'N/A' }}</p>
                    </div>

                    <div class="space-y-2 mb-4">
                        @if($order->items)
                            @foreach($order->items as $item)
                                <div class="flex justify-between items-center bg-gray-50 px-3 py-2 rounded-lg text-xs sm:text-sm">
                                    <span class="font-medium">{{ $item['name'] ?? 'Unknown Item' }}</span>
                                    <span class="text-gray-500">x{{ $item['quantity'] ?? 1 }}</span>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    @if($order->status === 'Pending')
                        <button
                            wire:click="completeOrder('{{ $order->_id }}')"
                            wire:loading.attr="disabled"
                            wire:target="completeOrder('{{ $order->_id }}')"
                            class="w-full px-4 py-2.5 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md text-sm sm:text-base font-medium"
                        >
                            <span wire:loading.remove wire:target="completeOrder('{{ $order->_id }}')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Complete Order</span>
                            </span>
                            <span wire:loading wire:target="completeOrder('{{ $order->_id }}')">
                                <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span>Processing...</span>
                            </span>
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 sm:p-12 text-center">
                <div class="text-gray-400">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-gray-900 mb-1">No orders found</p>
                    <p class="text-sm text-gray-500">When orders are placed, they'll appear here</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Desktop Table View (hidden on small screens) -->
    <div class="hidden lg:block bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed divide-y divide-gray-200">
                <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                    <tr>
                        <th class="w-1/6 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Order ID</th>
                        <th class="w-1/6 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Customer</th>
                        <th class="w-1/4 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Items</th>
                        <th class="w-16 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Total</th>
                        <th class="w-20 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="w-24 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 transition-all duration-200">
                            <!-- Order ID -->
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-gray-900">
                                    #{{ substr((string)$order->_id, -8) }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $order->created_at->format('M d, Y H:i') }}
                                </div>
                            </td>

                            <!-- Customer -->
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $order->user->first_name ?? 'N/A' }} {{ $order->user->last_name ?? 'N/A' }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $order->user->email ?? 'N/A' }}
                                </div>
                                @if($order->address)
                                    <div class="text-xs text-gray-400 mt-1">
                                        {{ \Illuminate\Support\Str::limit($order->address, 30) }}
                                    </div>
                                @endif
                            </td>

                            <!-- Items -->
                            <td class="px-6 py-4">
                                <div class="text-sm space-y-1">
                                    @if($order->items)
                                        @foreach($order->items as $item)
                                            <div class="flex justify-between items-center bg-gray-50 px-3 py-1.5 rounded-lg text-xs">
                                                <span class="font-medium">{{ $item['name'] ?? 'Unknown Item' }}</span>
                                                <span class="text-gray-500">x{{ $item['quantity'] ?? 1 }}</span>
                                            </div>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400 text-sm">No items</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Total -->
                            <td class="px-6 py-4">
                                <span class="text-base font-bold text-green-600">Rs {{ number_format($order->total, 2) }}</span>
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                    @if($order->status === 'Pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'Completed') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ $order->status }}
                                </span>
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4">
                                @if($order->status === 'Pending')
                                    <button
                                        wire:click="completeOrder('{{ $order->_id }}')"
                                        wire:loading.attr="disabled"
                                        wire:target="completeOrder('{{ $order->_id }}')"
                                        class="w-full px-3 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg text-xs hover:from-green-600 hover:to-green-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md flex items-center justify-center space-x-1"
                                    >
                                        <span wire:loading.remove wire:target="completeOrder('{{ $order->_id }}')">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            <span>Complete</span>
                                        </span>
                                        <span wire:loading wire:target="completeOrder('{{ $order->_id }}')">
                                            <svg class="animate-spin w-3 h-3" fill="none" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            <span>Processing</span>
                                        </span>
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400">No actions</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="text-gray-400">
                                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                        </svg>
                                    </div>
                                    <p class="text-lg font-medium text-gray-900 mb-1">No orders found</p>
                                    <p class="text-sm text-gray-500">When orders are placed, they'll appear here</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Enhanced Pagination -->
    @if($orders->hasPages())
        <div class="mt-4 sm:mt-6 bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <div class="text-xs sm:text-sm text-gray-700 mb-2 sm:mb-0">
                    Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of {{ $orders->total() }} results
                </div>
                <div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Error Message -->
    @if (session()->has('error'))
        <div class="fixed bottom-4 right-4 z-50">
            <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg shadow-lg animate-slide-in-left">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700">{{ session('error') }}</p>
                    </div>
                    <div class="ml-auto pl-3">
                        <button onclick="this.parentElement.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

