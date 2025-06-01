<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Drink;

class DrinksMenu extends Component
{
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    public function render()
    {
        $query = Drink::orderBy('category')->orderBy('name');

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

        return view('livewire.drinks-menu', [
            'items' => $items,
            'groupedItems' => $groupedItems,
            'hasItems' => $items->isNotEmpty(),
        ]);
    }

    public function addToCart($drinkId)
    {
        $drink = Drink::find($drinkId);
        if (!$drink) return;

        $cart = session()->get('cart', []);

        if (isset($cart[$drinkId])) {
            $cart[$drinkId]['quantity']++;
        } else {
            $cart[$drinkId] = [
                'name' => $drink->name,
                'price' => $drink->price,
                'quantity' => 1,
                'image' => $drink->image,
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        $this->dispatch('flashMessage', [
            'message' => $drink->name . ' added to cart!',
            'type' => 'success'
        ]);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
