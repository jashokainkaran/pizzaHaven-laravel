<?php

namespace App\Livewire;

use Livewire\Component;

class NavCart extends Component
{
    public $count = 0;

    protected $listeners = ['cartUpdated' => 'updateCount'];

    public function mount()
    {
        $this->updateCount();
    }

    public function updateCount()
    {
        $cart = session()->get('cart', []);
        $this->count = collect($cart)->sum('quantity');
    }
    
    public function render()
    {
        return view('livewire.nav-cart');
    }
}
