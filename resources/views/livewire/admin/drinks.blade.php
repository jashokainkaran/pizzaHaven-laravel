<div class="p-3 sm:p-4 lg:p-6 bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen">
    <!-- Header -->
    <div class="mb-4 sm:mb-6">
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-1 sm:mb-2">🍹 Beverage Management</h1>
        <p class="text-gray-600 text-xs sm:text-sm lg:text-base">Manage and track all beverages</p>
    </div>

    <!-- Loading Overlay -->
    <div wire:loading class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-xl p-4 sm:p-6 flex items-center space-x-3 shadow-2xl">
            <div class="animate-spin rounded-full h-5 w-5 sm:h-6 sm:w-6 border-b-2 border-blue-600"></div>
            <span class="text-gray-700 text-sm sm:text-base">Processing...</span>
        </div>
    </div>

    <!-- Search and Actions -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-4 sm:mb-6 overflow-hidden">
        <div class="p-3 sm:p-4">
            <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-end">
                <div class="flex-1 w-full">
                    <label for="search" class="block text-xs sm:text-sm font-medium text-gray-700 mb-1 sm:mb-2">Search Beverages</label>
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
                            placeholder="Search by name, category, or description..."
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
                <div class="w-full sm:w-auto">
                    <button
                        wire:click="openAddModal"
                        class="w-full sm:w-auto px-4 sm:px-6 py-2.5 sm:py-3 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-200 flex items-center justify-center space-x-2 shadow-sm hover:shadow-md text-sm sm:text-base font-medium"
                    >
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Add Beverage</span>
                    </button>
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
        @forelse($drinks as $drink)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                @if($editingDrinkId === $drink->id)
                    <!-- Mobile Edit Form -->
                    <div class="p-4 sm:p-5 space-y-4 bg-gradient-to-br from-blue-50 to-indigo-50">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900">Edit Beverage</h3>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Beverage Name</label>
                                <input wire:model="editForm.name" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                @error('editForm.name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Beverage Image</label>
                                @if($currentImage)
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $currentImage) }}" alt="Current Image" class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200">
                                        <p class="text-xs text-gray-500 mt-1">Current image</p>
                                    </div>
                                @endif
                                <input type="file" wire:model="editImage" class="w-full px-4 py-3 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                @error('editImage') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <input wire:model="editForm.category" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    @error('editForm.category') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Price (Rs)</label>
                                    <input wire:model="editForm.price" type="number" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    @error('editForm.price') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                <textarea wire:model="editForm.description" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none"></textarea>
                                @error('editForm.description') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3 pt-4 border-t border-gray-200">
                            <button wire:click="saveEdit" class="flex-1 px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                                💾 Save Changes
                            </button>
                            <button wire:click="cancelEdit" class="flex-1 px-4 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium">
                                ❌ Cancel
                            </button>
                        </div>
                    </div>
                @else
                    <!-- Mobile Drink Card -->
                    <div class="flex">
                        @if($drink->image)
                            <div class="w-20 sm:w-24 h-20 sm:h-24 flex-shrink-0">
                                <img src="{{ asset('storage/' . $drink->image) }}" alt="{{ $drink->name }}" class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="w-20 sm:w-24 h-20 sm:h-24 flex-shrink-0 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <svg class="w-6 h-6 sm:w-8 sm:h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        <div class="flex-1 p-3 sm:p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 leading-tight">{{ $drink->name }}</h3>
                                <span class="text-base sm:text-lg font-bold text-green-600 ml-2">Rs{{ number_format($drink->price, 2) }}</span>
                            </div>
                            <div class="mb-2">
                                <span class="inline-block bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">{{ $drink->category }}</span>
                            </div>
                            @if($drink->description)
                                <p class="text-xs sm:text-sm text-gray-600 mb-3 line-clamp-2">{{ \Illuminate\Support\Str::limit($drink->description, 80) }}</p>
                            @endif
                            <div class="flex space-x-2">
                                <button wire:click="edit('{{ $drink->id }}')" class="flex-1 px-3 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg hover:from-yellow-500 hover:to-yellow-600 text-xs sm:text-sm transition-all duration-200 font-medium shadow-sm">
                                    ✏️ Edit
                                </button>
                                <button wire:click="openDeleteModal('{{ $drink->id }}')" class="flex-1 px-3 py-2 bg-gradient-to-r from-red-400 to-red-500 text-white rounded-lg hover:from-red-500 hover:to-red-600 text-xs sm:text-sm transition-all duration-200 font-medium shadow-sm">
                                    🗑️ Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 sm:p-12 text-center">
                <div class="text-gray-400">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <p class="text-lg font-medium text-gray-900 mb-1">No beverages found</p>
                    <p class="text-sm text-gray-500">Get started by adding your first refreshing drink! 🍹</p>
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
                        <th class="w-1/5 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Beverage</th>
                        <th class="w-20 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Image</th>
                        <th class="w-24 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Category</th>
                        <th class="w-20 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Price</th>
                        <th class="w-1/3 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                        <th class="w-32 px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($drinks as $drink)
                        <tr class="hover:bg-gradient-to-r hover:from-gray-50 hover:to-blue-50 transition-all duration-200">
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <input wire:model="editForm.name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('editForm.name') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                @else
                                    <div class="font-semibold text-gray-900">{{ $drink->name }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <div class="space-y-2">
                                        @if($currentImage)
                                            <img src="{{ asset('storage/' . $currentImage) }}" alt="Current Image" class="w-14 h-14 object-cover rounded-lg border-2 border-gray-200">
                                        @endif
                                        <input type="file" wire:model="editImage" class="text-xs w-full">
                                        @error('editImage') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                                    </div>
                                @else
                                    @if($drink->image)
                                        <img src="{{ asset('storage/' . $drink->image) }}" alt="{{ $drink->name }}" class="w-14 h-14 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div class="w-14 h-14 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <input wire:model="editForm.category" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('editForm.category') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                @else
                                    <span class="inline-block bg-gradient-to-r from-blue-100 to-blue-200 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">
                                        {{ $drink->category }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <input wire:model="editForm.price" type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    @error('editForm.price') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                @else
                                    <span class="text-lg font-bold text-green-600">Rs {{ number_format($drink->price, 2) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <textarea wire:model="editForm.description" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"></textarea>
                                    @error('editForm.description') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                @else
                                    <div class="text-sm text-gray-700 leading-relaxed">
                                        {{ \Illuminate\Support\Str::limit($drink->description, 80) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <div class="flex flex-col space-y-2">
                                        <button wire:click="saveEdit" class="px-3 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg text-xs hover:from-blue-600 hover:to-blue-700 transition-all duration-200 font-medium">💾 Save</button>
                                        <button wire:click="cancelEdit" class="px-3 py-2 bg-gray-100 text-gray-700 rounded-lg text-xs hover:bg-gray-200 transition-all duration-200 font-medium">❌ Cancel</button>
                                    </div>
                                @else
                                    <div class="flex flex-col space-y-2">
                                        <button wire:click="edit('{{ $drink->id }}')" class="px-3 py-2 bg-gradient-to-r from-yellow-400 to-yellow-500 text-white rounded-lg text-xs hover:from-yellow-500 hover:to-yellow-600 transition-all duration-200 font-medium">
                                            ✏️ Edit
                                        </button>
                                        <button wire:click="openDeleteModal('{{ $drink->id }}')" class="px-3 py-2 bg-gradient-to-r from-red-400 to-red-500 text-white rounded-lg text-xs hover:from-red-500 hover:to-red-600 transition-all duration-200 font-medium">
                                            🗑️ Delete
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="text-gray-400">
                                    <div class="w-20 h-20 mx-auto mb-4 bg-gradient-to-br from-gray-100 to-gray-200 rounded-full flex items-center justify-center">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <p class="text-lg font-medium text-gray-900 mb-1">No beverages found</p>
                                    <p class="text-sm text-gray-500">Get started by adding your first refreshing drink! 🍹</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Enhanced Pagination -->
    @if($drinks->hasPages())
        <div class="mt-4 sm:mt-6 bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <div class="text-xs sm:text-sm text-gray-700 mb-2 sm:mb-0">
                    Showing {{ $drinks->firstItem() }} to {{ $drinks->lastItem() }} of {{ $drinks->total() }} results
                </div>
                <div>
                    {{ $drinks->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Add New Drink Modal -->
    @if($showAddModal)
        <div class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-3 sm:p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[95vh] overflow-y-auto">
                <div class="p-4 sm:p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900">Add New Beverage</h2>
                        </div>
                        <button wire:click="closeAddModal" class="text-gray-400 hover:text-gray-600 transition-colors p-1">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Beverage Name *</label>
                            <input wire:model="newForm.name" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="Enter beverage name">
                            @error('newForm.name') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Beverage Image</label>
                            <input type="file" wire:model="newImage" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                            @error('newImage') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                            @if($newImage)
                                <div class="mt-3">
                                    <img src="{{ $newImage->temporaryUrl() }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg border-2 border-gray-200 shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1">Image preview</p>
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                                <input wire:model="newForm.category" type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="e.g., Soft Drink">
                                @error('newForm.category') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Price (Rs) *</label>
                                <input wire:model="newForm.price" type="number" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all" placeholder="0.00">
                                @error('newForm.price') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                            <textarea wire:model="newForm.description" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none" placeholder="Describe your refreshing beverage..."></textarea>
                            @error('newForm.description') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pt-6 border-t border-gray-200">
                        <button wire:click="closeAddModal" class="w-full sm:w-auto px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium">
                            Cancel
                        </button>
                        <button wire:click="saveNew" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                            🍹 Save Beverage
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-60 z-50 flex items-center justify-center p-3 sm:p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
                <div class="p-4 sm:p-6">
                    <div class="flex items-center mb-6">
                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-bold text-gray-900">Delete Beverage</h3>
                            <p class="text-sm text-gray-600 mt-1">Are you sure you want to delete this beverage? This action cannot be undone.</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                        <button wire:click="cancelDelete" class="w-full sm:w-auto px-6 py-3 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-all duration-200 font-medium">
                            Cancel
                        </button>
                        <button wire:click="confirmDelete" class="w-full sm:w-auto px-6 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 font-medium shadow-sm hover:shadow-md">
                            🗑️ Delete Beverage
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
