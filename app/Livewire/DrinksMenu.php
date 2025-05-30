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
}

?>
