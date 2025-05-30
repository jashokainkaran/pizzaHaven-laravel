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
}

?>
