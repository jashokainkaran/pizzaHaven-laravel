<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;

class OrdersPage extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::where('user_id', auth()->id())
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function render()
    {
        return view('livewire.orders-page');
    }
}
