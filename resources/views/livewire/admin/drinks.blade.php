<div class="p-4 lg:p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Beverage Management</h1>
        <p class="text-gray-600 text-sm lg:text-base">Manage and track all beverages</p>
    </div>

    <!-- Loading Overlay -->
    <div wire:loading class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
            <span class="text-gray-700">Processing...</span>
        </div>
    </div>

    <!-- Search and Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-4">
            <div class="flex flex-col sm:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Drinks</label>
                    <div class="relative">
                        <input
                            type="text"
                            id="search"
                            wire:model.live.debounce.300ms="searchTerm"
                            placeholder="Search by name, category, or description..."
                            class="w-full px-3 py-2 pr-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        @if($searchTerm)
                            <button
                                wire:click="clearSearch"
                                class="absolute right-2 top-2 text-gray-400 hover:text-gray-600"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        @endif
                    </div>
                </div>
                <div>
                    <button
                        wire:click="openAddModal"
                        class="w-full sm:w-auto px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors flex items-center justify-center space-x-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Add Drink</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Count -->
    @if($searchTerm)
        <div class="mb-4 text-sm text-gray-600">
            Showing results for "<strong>{{ $searchTerm }}</strong>"
        </div>
    @endif

    <!-- Mobile Cards View (visible on small screens) -->
    <div class="block lg:hidden space-y-4">
        @forelse($drinks as $drink)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                @if($editingDrinkId === $drink->id)
                    <!-- Mobile Edit Form -->
                    <div class="p-4 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Edit Drink</h3>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                            <input wire:model="editForm.name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                            @error('editForm.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            @if($currentImage)
                                <img src="{{ asset('storage/' . $currentImage) }}" alt="Current Image" class="w-20 h-20 object-cover rounded-md mb-2">
                            @endif
                            <input type="file" wire:model="editImage" class="w-full">
                            @error('editImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <input wire:model="editForm.category" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                @error('editForm.category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                                <input wire:model="editForm.price" type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                @error('editForm.price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea wire:model="editForm.description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                            @error('editForm.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex space-x-2 pt-2">
                            <button wire:click="saveEdit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                Save
                            </button>
                            <button wire:click="cancelEdit" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                                Cancel
                            </button>
                        </div>
                    </div>
                @else
                    <!-- Mobile Drink Card -->
                    <div class="flex">
                        @if($drink->image)
                            <div class="w-24 h-24 flex-shrink-0">
                                <img src="{{ asset('storage/' . $drink->image) }}" alt="{{ $drink->name }}" class="w-full h-full object-cover">
                            </div>
                        @endif
                        <div class="flex-1 p-4">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $drink->name }}</h3>
                                <span class="text-lg font-bold text-green-600">Rs{{ number_format($drink->price, 2) }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mb-2">
                                <span class="inline-block bg-gray-100 px-2 py-1 rounded-full text-xs">{{ $drink->category }}</span>
                            </p>
                            @if($drink->description)
                                <p class="text-sm text-gray-700 mb-3">{{ \Illuminate\Support\Str::limit($drink->description, 100) }}</p>
                            @endif
                            <div class="flex space-x-2">
                                <button wire:click="edit('{{ $drink->id }}')" class="px-3 py-1.5 bg-yellow-500 text-white rounded-md hover:bg-yellow-600 text-sm transition-colors">
                                    Edit
                                </button>
                                <button wire:click="openDeleteModal('{{ $drink->id }}')" class="px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm transition-colors">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        @empty
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                <div class="text-gray-400">
                    <svg class="mx-auto h-12 w-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    <p class="text-lg font-medium text-gray-900 mb-1">No drinks found</p>
                    <p class="text-sm text-gray-500">Get started by adding your first drink!</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Desktop Table View (hidden on small screens) -->
    <div class="hidden lg:block bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full table-fixed divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="w-1/5 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Drink</th>
                        <th class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="w-24 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="w-20 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="w-1/3 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="w-32 px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($drinks as $drink)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <input wire:model="editForm.name" type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-blue-500">
                                    @error('editForm.name') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                @else
                                    <div class="font-medium text-gray-900">{{ $drink->name }}</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <div class="space-y-2">
                                        @if($currentImage)
                                            <img src="{{ asset('storage/' . $currentImage) }}" alt="Current Image" class="w-12 h-12 object-cover rounded-md">
                                        @endif
                                        <input type="file" wire:model="editImage" class="text-xs w-full">
                                        @error('editImage') <span class="text-red-500 text-xs block">{{ $message }}</span> @enderror
                                    </div>
                                @else
                                    @if($drink->image)
                                        <img src="{{ asset('storage/' . $drink->image) }}" alt="{{ $drink->name }}" class="w-12 h-12 object-cover rounded-md">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 rounded-md flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <input wire:model="editForm.category" type="text" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-blue-500">
                                    @error('editForm.category') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                @else
                                    <span class="inline-block bg-gray-100 px-2 py-1 rounded-full text-xs font-medium text-gray-700">
                                        {{ $drink->category }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <input wire:model="editForm.price" type="number" step="0.01" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-blue-500">
                                    @error('editForm.price') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                @else
                                    <span class="text-lg font-semibold text-green-600">Rs {{ number_format($drink->price, 2) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <textarea wire:model="editForm.description" rows="2" class="w-full px-2 py-1 border border-gray-300 rounded text-sm focus:ring-1 focus:ring-blue-500 resize-none"></textarea>
                                    @error('editForm.description') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                                @else
                                    <div class="text-sm text-gray-700">
                                        {{ \Illuminate\Support\Str::limit($drink->description, 80) }}
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($editingDrinkId === $drink->id)
                                    <div class="flex flex-col space-y-1">
                                        <button wire:click="saveEdit" class="px-2 py-1 bg-blue-600 text-white rounded text-xs hover:bg-blue-700 transition-colors">Save</button>
                                        <button wire:click="cancelEdit" class="px-2 py-1 bg-gray-200 text-gray-700 rounded text-xs hover:bg-gray-300 transition-colors">Cancel</button>
                                    </div>
                                @else
                                    <div class="flex flex-col space-y-1">
                                        <button wire:click="edit('{{ $drink->id }}')" class="px-2 py-1 bg-yellow-500 text-white rounded text-xs hover:bg-yellow-600 transition-colors">
                                            Edit
                                        </button>
                                        <button wire:click="openDeleteModal('{{ $drink->id }}')" class="px-2 py-1 bg-red-500 text-white rounded text-xs hover:bg-red-600 transition-colors">
                                            Delete
                                        </button>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <svg class="mx-auto h-12 w-12 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    <p class="text-lg font-medium text-gray-900 mb-1">No drinks found</p>
                                    <p class="text-sm text-gray-500">Get started by adding your first drink!</p>
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
        <div class="mt-6 bg-white rounded-lg shadow-sm border border-gray-200 px-4 py-3">
            <div class="flex flex-col sm:flex-row items-center justify-between">
                <div class="text-sm text-gray-700 mb-2 sm:mb-0">
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
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">Add New Drink</h2>
                        <button wire:click="closeAddModal" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Name *</label>
                            <input wire:model="newForm.name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('newForm.name') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                            <input type="file" wire:model="newImage" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            @error('newImage') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                            @if($newImage)
                                <div class="mt-2">
                                    <img src="{{ $newImage->temporaryUrl() }}" alt="Preview" class="w-20 h-20 object-cover rounded-md">
                                </div>
                            @endif
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Category *</label>
                                <input wire:model="newForm.category" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('newForm.category') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Price *</label>
                                <input wire:model="newForm.price" type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                @error('newForm.price') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                            <textarea wire:model="newForm.description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                            @error('newForm.description') <span class="text-red-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="mt-6 flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                        <button wire:click="closeAddModal" class="w-full sm:w-auto px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                            Cancel
                        </button>
                        <button wire:click="saveNew" class="w-full sm:w-auto px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            Save Drink
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="flex-shrink-0 w-10 h-10 rounded-full bg-red-100 flex items-center justify-center">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">Delete Drink</h3>
                            <p class="text-sm text-gray-500">Are you sure you want to delete this drink? This action cannot be undone.</p>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2">
                        <button wire:click="cancelDelete" class="w-full sm:w-auto px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">
                            Cancel
                        </button>
                        <button wire:click="confirmDelete" class="w-full sm:w-auto px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition-colors">
                            Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
