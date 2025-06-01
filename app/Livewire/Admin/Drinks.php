<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Drink;

class Drinks extends Component
{
    use WithFileUploads, WithPagination;

    public $searchTerm = '';
    public $editingDrinkId = null;
    public $editForm = [];
    public $editImage;
    public $currentImage;
    public $showAddModal = false;
    public $showDeleteModal = false;
    public $drinkToDelete = null;
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
        $query = Drink::query()->orderBy('created_at', 'desc');

        if ($this->searchTerm) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $this->searchTerm . '%')
                  ->orWhere('category', 'like', '%' . $this->searchTerm . '%');
            });
        }

        $drinks = $query->paginate(10);

        return view('livewire.admin.drinks', [
            'drinks' => $drinks,
        ]);
    }

    public function edit($drinkId)
    {
        $drink = Drink::find($drinkId);
        if ($drink) {
            $this->editingDrinkId = $drinkId;
            $this->editForm = [
                'name' => $drink->name,
                'category' => $drink->category,
                'price' => $drink->price,
                'description' => $drink->description,
            ];
            $this->currentImage = $drink->image;
            $this->resetValidation();
        }
    }

    public function saveEdit()
    {
        $this->validate($this->rules());

        $this->loading = true;

        try {
            $drink = Drink::find($this->editingDrinkId);
            if ($drink) {
                $drink->update($this->editForm);

                if ($this->editImage) {
                    // Delete old image if exists
                    if ($drink->image && \Storage::disk('public')->exists($drink->image)) {
                        \Storage::disk('public')->delete($drink->image);
                    }

                    $path = $this->editImage->store('drinks', 'public');
                    $drink->image = $path;
                    $drink->save();
                }

                $this->cancelEdit();
                $this->dispatch('flashMessage', [
                    'message' => 'Drink updated successfully!',
                    'type' => 'success'
                ]);
            }
        } catch (\Exception $e) {
            $this->dispatch('flashMessage', [
                'message' => 'Error updating drink. Please try again.',
                'type' => 'error'
            ]);
        } finally {
            $this->loading = false;
        }
    }

    public function cancelEdit()
    {
        $this->editingDrinkId = null;
        $this->editForm = [];
        $this->editImage = null;
        $this->currentImage = null;
        $this->resetValidation();
    }

    public function openDeleteModal($drinkId)
    {
        $this->drinkToDelete = $drinkId;
        $this->showDeleteModal = true;
    }

    public function confirmDelete()
    {
        if ($this->drinkToDelete) {
            $this->loading = true;

            try {
                $drink = Drink::find($this->drinkToDelete);
                if ($drink) {
                    // Delete associated image
                    if ($drink->image && \Storage::disk('public')->exists($drink->image)) {
                        \Storage::disk('public')->delete($drink->image);
                    }

                    $drink->delete();
                    $this->dispatch('flashMessage', [
                        'message' => 'Drink deleted successfully!',
                        'type' => 'success'
                    ]);
                }
            } catch (\Exception $e) {
                $this->dispatch('flashMessage', [
                    'message' => 'Error deleting drink. Please try again.',
                    'type' => 'error'
                ]);
            } finally {
                $this->loading = false;
                $this->showDeleteModal = false;
                $this->drinkToDelete = null;
            }
        }
    }

    public function cancelDelete()
    {
        $this->showDeleteModal = false;
        $this->drinkToDelete = null;
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
            $drink = Drink::create($this->newForm);

            if ($this->newImage) {
                $path = $this->newImage->store('drinks', 'public');
                $drink->image = $path;
                $drink->save();
            }

            $this->closeAddModal();
            $this->dispatch('flashMessage', [
                'message' => 'Drink added successfully!',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('flashMessage', [
                'message' => 'Error adding drink. Please try again.',
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
