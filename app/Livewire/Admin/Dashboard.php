<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;
use App\Models\User;
use App\Models\Pizza;
use App\Models\Drink;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $totalRevenue;
    public $pendingOrders;
    public $totalUsers;
    public $popularPizza;
    public $popularDrink;

    public function mount()
    {
        // Total Revenue
        $this->totalRevenue = Order::raw(function($collection) {
            return $collection->aggregate([
                ['$group' => ['_id' => null, 'total' => ['$sum' => '$total']]]
            ]);
        })->first()['total'] ?? 0;

        // Pending Orders
        $this->pendingOrders = Order::where('status', 'Pending')->count();

        // Total Users
        $this->totalUsers = User::count();

        // Get pizza names from Pizza collection
        $pizzaNames = Pizza::pluck('name')->toArray();

        // Get drink names from Drink collection
        $drinkNames = Drink::pluck('name')->toArray();

        // Most Popular Pizza
        try {
            $pizzaResult = Order::raw(function($collection) use ($pizzaNames) {
                return $collection->aggregate([
                    [
                        '$addFields' => [
                            'itemsArray' => ['$objectToArray' => '$items']
                        ]
                    ],
                    ['$unwind' => '$itemsArray'],
                    ['$match' => ['itemsArray.v.name' => ['$in' => $pizzaNames]]],
                    ['$group' => [
                        '_id' => '$itemsArray.v.name',
                        'total' => ['$sum' => '$itemsArray.v.quantity']
                    ]],
                    ['$sort' => ['total' => -1]],
                    ['$limit' => 1]
                ]);
            });

            $pizza = $pizzaResult->first();
            $this->popularPizza = $pizza ? $pizza['_id'] : 'N/A';

        } catch (\Exception $e) {
            $this->popularPizza = 'Error';
        }

        // Most Popular Drink
        try {
            $drinkResult = Order::raw(function($collection) use ($drinkNames) {
                return $collection->aggregate([
                    [
                        '$addFields' => [
                            'itemsArray' => ['$objectToArray' => '$items']
                        ]
                    ],
                    ['$unwind' => '$itemsArray'],
                    ['$match' => ['itemsArray.v.name' => ['$in' => $drinkNames]]],
                    ['$group' => [
                        '_id' => '$itemsArray.v.name',
                        'total' => ['$sum' => '$itemsArray.v.quantity']
                    ]],
                    ['$sort' => ['total' => -1]],
                    ['$limit' => 1]
                ]);
            });

            $drink = $drinkResult->first();
            $this->popularDrink = $drink ? $drink['_id'] : 'N/A';

        } catch (\Exception $e) {
            $this->popularDrink = 'Error';
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard');
    }
}
