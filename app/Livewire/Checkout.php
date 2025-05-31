<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\User;


class Checkout extends Component
{
    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $address;
    public $cart = [];

    protected $rules = [
        'first_name' => 'required|string|min:2',
        'last_name'  => 'required|string|min:2',
        'address'    => 'required|string|min:5',
        'phone'    => 'required|string|max:10',
        'cart'       => 'array|min:1',
    ];

    public function mount()
    {
        $user = Auth::user();
        $this->first_name = $user->first_name ?? '';
        $this->last_name = $user->last_name ?? '';
        $this->phone = $user->phone ?? '';
        $this->address = $user->address ?? '';

        $this->cart = session()->get('cart', []);
    }

    public function increment($id)
    {
        $this->cart[$id]['quantity']++;
        $this->updateCart();
    }

    public function decrement($id)
    {
        if ($this->cart[$id]['quantity'] > 1) {
            $this->cart[$id]['quantity']--;
            $this->updateCart();
        }
    }

    public function remove($id)
    {
        unset($this->cart[$id]);
        $this->updateCart();
    }

    public function updateCart()
    {
        session()->put('cart', $this->cart);
        $this->dispatch('cartUpdated'); // For navbar icon
    }

    public function calculateTotal()
    {
        return collect($this->cart)->sum(fn($item) => $item['quantity'] * $item['price']);
    }

    public function placeOrder()
    {
        $this->validate();

        // Update user info
        $user = Auth::user();
        $user->update([
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'phone' => $this->phone,
            'address'    => $this->address,
        ]);

        // Save order
        Order::create([
            'user_id' => $user->id,
            'items'   => $this->cart,
            'total'   => $this->calculateTotal(),
            'status'  => 'Pending',
            'created_at' => now(),
        ]);

        session()->forget('cart');
        $this->dispatch('cartUpdated');
        $this->dispatch('flashMessage', [
            'message' => 'Order placed',
            'type' => 'success'
        ]);

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.checkout');
    }
}
