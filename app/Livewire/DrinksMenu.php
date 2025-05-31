<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Drink;

class DrinksMenu extends Component
{
    public function render()
    {
        $items = Drink::orderBy('category')
                      ->orderBy('name')
                      ->get();

        $groupedItems = $items->groupBy(function ($item) {
            return strtolower($item->category);
        });

        return view('livewire.drinks-menu', [
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
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        $this->dispatch('flashMessage', [
            'message' => $drink->name . ' added to cart!',
            'type' => 'success'
        ]);
    }
}

?>
