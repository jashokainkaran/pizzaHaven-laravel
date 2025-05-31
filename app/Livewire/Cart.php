<?php
namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class Cart extends Component
{
    public $cart = [];

    public function mount()
    {
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
        $this->dispatch('cartUpdated');
    }

    public function checkout()
    {
        if (!Auth::check()) {
            session()->put('cart', $this->cart); // Keep items
            session()->put('redirect_after_login', route('cart'));
            return redirect()->guest(route('login'));
        }

        Order::create([
            'user_id' => Auth::id(),
            'items' => $this->cart,
            'total' => $this->calculateTotal(),
            'status' => 'Pending',
            'created_at' => now(),
        ]);

        session()->forget('cart');
        $this->cart = [];
        $this->dispatch('cartUpdated');
        $this->dispatch('flashMessage', [
            'message' => 'Order placed successfully!',
            'type' => 'success'
        ]);
    }

    public function calculateTotal()
    {
        return collect($this->cart)->sum(fn($item) => $item['quantity'] * $item['price']);
    }

    public function render()
    {
        return view('livewire.cart');
    }
}
