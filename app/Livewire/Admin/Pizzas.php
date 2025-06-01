<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Pizza;

class Pizzas extends Component
{
    use WithFileUploads, WithPagination;

    public $searchTerm = '';
    public $editingPizzaId = null;
    public $editForm = [];
    public $editImage;
    public $currentImage;
    public $showAddModal = false;
    public $showDeleteModal = false;
    public $pizzaToDelete = null;
    public $newForm = [
        'name' => '',
        'category' => '',
        'price' => '',
        'description' => '',
    ];
    public $newImage;
    public $loading = false;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'editForm.name' => 'required|string|max:255',
            'editForm.category' => 'required|string|max:255',
            'editForm.price' => 'required|numeric|min:0',
            'editForm.description' => 'nullable|string|max:1000',
            'editImage' => 'nullable|image|max:2048',
        ];
    }

    protected function newFormRules()
    {
        return [
            'newForm.name' => 'required|string|max:255',
            'newForm.category' => 'required|string|max:255',
            'newForm.price' => 'required|numeric|min:0',
            'newForm.description' => 'nullable|string|max:1000',
            'newImage' => 'nullable|image|max:2048',
        ];
    }

    public function updatedSearchTerm()
    {
        // Reset pagination when search term changes
        $this->resetPage();
    }

    public function render()
    {
        $query = Pizza::query()->orderBy('created_at', 'desc');

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('category', 'like', '%' . $this->searchTerm . '%');
            });
        }

        $pizzas = $query->paginate(10);

        return view('livewire.pizzas', [
            'pizzas' => $pizzas,
        ]);
    }

    public function edit($pizzaId)
    {
        $pizza = Pizza::find($pizzaId);
        if ($pizza) {
            $this->editingPizzaId = $pizzaId;
            $this->editForm = [
                'name' => $pizza->name,
                'category' => $pizza->category,
                'price' => $pizza->price,
                'description' => $pizza->description,
            ];
            $this->currentImage = $pizza->image;
            $this->resetValidation();
        }
    }

    public function saveEdit()
    {
        $this->validate($this->rules());

        $this->loading = true;

        try {
            $pizza = Pizza::find($this->editingPizzaId);
            if ($pizza) {
                $pizza->update($this->editForm);

                if ($this->editImage) {
                    // Delete old image if exists
                    if ($pizza->image && \Storage::disk('public')->exists($pizza->image)) {
                        \Storage::disk('public')->delete($pizza->image);
                    }

                    $path = $this->editImage->store('pizzas', 'public');
                    $pizza->image = $path;
                    $pizza->save();
                }

                $this->cancelEdit();
                $this->dispatch('flashMessage', [
                    'message' => 'Pizza updated successfully!',
                    'type' => 'success'
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('flashMessage', [
                'message' => 'Error updating pizza. Please try again.',
                'type' => 'error'
            ]);
        } finally {
            $this->loading = false;
        }
    }

    public function cancelEdit()
    {
        $this->editingPizzaId = null;
        $this->editForm = [];
        $this->editImage = null;
        $this->currentImage = null;
        $this->resetValidation();
    }

    public function openDeleteModal($pizzaId)
    {
        $this->pizzaToDelete = $pizzaId;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        if ($this->pizzaToDelete) {
            $this->loading = true;

            try {
                $pizza = Pizza::find($this->pizzaToDelete);
                if ($pizza) {
                    // Delete associated image
                    if ($pizza->image && \Storage::disk('public')->exists($pizza->image)) {
                        \Storage::disk('public')->delete($pizza->image);
                    }

                    $pizza->delete();
                    $this->dispatch('flashMessage', [
                        'message' => 'Pizza deleted successfully!',
                        'type' => 'success'
                    ]);
                }
            } catch (\Exception $e) {
                $this->dispatch('flashMessage', [
                    'message' => 'Error deleting pizza. Please try again.',
                    'type' => 'error'
                ]);
            } finally {
                $this->loading = false;
                $this->showDeleteModal = false;
                $this->pizzaToDelete = null;
            }
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->pizzaToDelete = null;
    }

    public function openAddModal()
    {
        $this->showAddModal = true;
        $this->resetValidation();
    }

    public function closeAddModal()
    {
        $this->showAddModal = false;
        $this->resetNewForm();
        $this->resetValidation();
    }

    private function resetNewForm()
    {
        $this->newForm = [
            'name' => '',
            'category' => '',
            'price' => '',
            'description' => '',
        ];
        $this->newImage = null;
    }

    public function saveNew()
    {
        $this->validate($this->newFormRules());

        $this->loading = true;

        try {
            $pizza = Pizza::create($this->newForm);

            if ($this->newImage) {
                $path = $this->newImage->store('pizzas', 'public');
                $pizza->image = $path;
                $pizza->save();
            }

            $this->closeAddModal();
            $this->dispatch('flashMessage', [
                'message' => 'Pizza added successfully!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('flashMessage', [
                'message' => 'Error adding pizza. Please try again.',
                'type' => 'error'
            ]);
        } finally {
            $this->loading = false;
        }
    }

    public function clearSearch()
    {
        $this->searchTerm = '';
        $this->resetPage();
    }
}
