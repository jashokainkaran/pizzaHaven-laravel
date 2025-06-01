<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pizza;

class PizzaMenu extends Component
{
    use WithPagination;

    public $selectedCategory = '';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $query = Pizza::orderBy('category')->orderBy('name');

        if ($this->selectedCategory) {
            $query->where('category', $this->selectedCategory);
        }

        $items = $query->paginate(9);

        // Group all items by category even if pagination only shows a subset
        $categories = collect(Pizza::distinct('category')->pluck('category'))->sort()->values()->all();

        // Only group the paginated items to display
        $groupedItems = $items->getCollection()->groupBy(function ($item) {
            return strtolower($item->category);
        });

        return view('livewire.pizza-menu', [
            'items' => $items,
            'groupedItems' => $groupedItems,
            'categories' => $categories,
            'hasItems' => $items->isNotEmpty(),
        ]);
    }

    public function addToCart($pizzaId)
    {
        $pizza = Pizza::find($pizzaId);
        if (!$pizza) return;

        $cart = session()->get('cart', []);

        if (isset($cart[$pizzaId])) {
            $cart[$pizzaId]['quantity']++;
        } else {
            $cart[$pizzaId] = [
                'name' => $pizza->name,
                'price' => $pizza->price,
                'quantity' => 1,
                'image' => $pizza->image,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        $this->dispatch('flashMessage', [
            'message' => $pizza->name . ' added to cart!',
            'type' => 'success'
        ]);
    }

    public function updatedSelectedCategory()
    {
        $this->resetPage();
    }
}
