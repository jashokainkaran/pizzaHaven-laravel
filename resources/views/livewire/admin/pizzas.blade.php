<div class="p-6 bg-gray-50 min-h-screen">
    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Pizza Management</h1>
        <p class="text-gray-600">Manage and track all pizzas</p>
    </div>

    <!-- Flash Message Component -->
    <livewire:flash-message />

    <!-- Search -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
        <div class="p-4">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Search Pizzas</label>
                    <input
                        type="text"
                        id="search"
                        wire:model.live.debounce.300ms="searchTerm"
                        placeholder="Search by Name or Description"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    >
                </div>
            </div>
        </div>
    </div>

    <!-- Add New Pizza Button -->
    <div class="mb-4">
        <button wire:click="openAddModal" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
            Add New Pizza
        </button>
    </div>

    <!-- Add New Pizza Modal -->
    @if($showAddModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                <h2 class="text-xl font-semibold mb-4">Add New Pizza</h2>
                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input wire:model="newForm.name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        @error('newForm.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                        <input wire:model="newForm.category" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        @error('newForm.category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                        <input wire:model="newForm.price" type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                        @error('newForm.price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea wire:model="newForm.description" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                        @error('newForm.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                        <input type="file" wire:model="newImage" class="w-full">
                        @error('newImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-4 flex justify-end space-x-2">
                    <button wire:click="saveNew" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
                    <button wire:click="closeAddModal" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">Cancel</button>
                </div>
            </div>
        </div>
    @endif

    <!-- Pizzas Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pizza Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pizzas as $pizza)
                        @if($editingPizzaId === $pizza->id)
                            <tr>
                                <td class="px-6 py-4">
                                    <input wire:model="editForm.name" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    @error('editForm.name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-6 py-4">
                                    <input wire:model="editForm.category" type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    @error('editForm.category') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-6 py-4">
                                    <input wire:model="editForm.price" type="number" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md">
                                    @error('editForm.price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-6 py-4">
                                    <textarea wire:model="editForm.description" class="w-full px-3 py-2 border border-gray-300 rounded-md"></textarea>
                                    @error('editForm.description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-6 py-4">
                                    @if($currentImage)
                                        <img src="{{ asset('storage/' . $currentImage) }}" alt="Current Image" class="w-16 h-16 object-cover">
                                    @endif
                                    <input type="file" wire:model="editImage" class="mt-2">
                                    @error('editImage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </td>
                                <td class="px-6 py-4">
                                    <button wire:click="saveEdit" class="px-3 py-1.5 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
                                    <button wire:click="cancelEdit" class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 ml-2">Cancel</button>
                                </td>
                            </tr>
                        @else
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4">{{ $pizza->name }}</td>
                                <td class="px-6 py-4">{{ $pizza->category }}</td>
                                <td class="px-6 py-4">{{ number_format($pizza->price, 2) }}</td>
                                <td class="px-6 py-4">{{ \Illuminate\Support\Str::limit($pizza->description, 50) }}</td>
                                <td class="px-6 py-4">
                                    @if($pizza->image)
                                        <img src="{{ asset('storage/' . $pizza->image) }}" alt="{{ $pizza->name }}" class="w-16 h-16 object-cover">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <button wire:click="edit('{{ $pizza->id }}')" class="px-3 py-1.5 bg-yellow-500 text-white rounded-md hover:bg-yellow-600">Edit</button>
                                    <button wire:click="delete('{{ $pizza->id }}')" class="px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 ml-2">Delete</button>
                                </td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="text-gray-400">
                                    <p class="text-sm">No pizzas found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($pizzas->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $pizzas->links() }}
            </div>
        @endif
    </div>
</div>
