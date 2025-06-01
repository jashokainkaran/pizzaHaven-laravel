<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pizza;

class PizzaMenu extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $query = Pizza::orderBy('category')->orderBy('name');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        $items = $query->paginate(9);

        // Only group the paginated items to display
        $groupedItems = $items->getCollection()->groupBy(function ($item) {
            return strtolower($item->category);
        });

        return view('livewire.pizza-menu', [
            'items' => $items,
            'groupedItems' => $groupedItems,
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

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
