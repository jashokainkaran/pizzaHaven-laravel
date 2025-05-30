<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Pizza;

class CreatePizza extends Component
{
    public $name, $category, $price, $description, $image;

    protected $rules = [
        'name' => 'required|string',
        'category' => 'required|string',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|string',
    ];

    public function save()
    {
        $validated = $this->validate();
        Pizza::create($validated);

        $this->reset(); // Clear form
        session()->flash('message', 'Pizza created successfully!');
    }

    public function render()
    {
        return view('livewire.create-pizza');
    }
}
