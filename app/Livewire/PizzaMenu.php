<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Pizza;

class PizzaMenu extends Component
{
    public function render()
    {
        $items = Pizza::orderBy('category')
                      ->orderBy('name')
                      ->get();

        $groupedItems = $items->groupBy(function ($item) {
            return strtolower($item->category);
        });

        return view('livewire.pizza-menu', [
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
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cartUpdated');
        $this->dispatch('flashMessage', [
            'message' => $pizza->name . ' added to cart!',
            'type' => 'success'
        ]);
    }
}

?>
