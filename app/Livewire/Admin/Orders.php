<?php
namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;
use App\Models\User;

class Orders extends Component
{
    use WithPagination;

    public $isLoading = false;
    public $processingOrderId = null;
    public $statusFilter = 'all';
    public $searchTerm = '';

    protected $listeners = ['orderCompleted' => '$refresh'];

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function completeOrder($orderId)
    {
        $this->processingOrderId = $orderId;
        $this->isLoading = true;

        try {
            $order = Order::findOrFail($orderId);
            $order->update(['status' => 'Completed']);

            session()->flash('success', 'Order marked as completed successfully!');
            $this->emit('orderCompleted');
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update order status. Please try again.');
        } finally {
            $this->isLoading = false;
            $this->processingOrderId = null;
        }
    }

    public function render()
    {
        $query = Order::with('user');

        // Apply status filter
        if ($this->statusFilter !== 'all') {
            $query->where('status', $this->statusFilter);
        }

        // Apply search filter
        if ($this->searchTerm) {
            $searchTerm = $this->searchTerm;
            $query->where(function($q) use ($searchTerm) {
                // Search by Order ID (last 8 characters)
                $q->where('_id', 'like', '%' . $searchTerm . '%')
                  // Search by user's name and email
                  ->orWhereHas('user', function($userQuery) use ($searchTerm) {
                      $userQuery->where('first_name', 'like', '%' . $searchTerm . '%')
                               ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                               ->orWhere('email', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        $orders = $query->latest()->paginate(10);

        return view('livewire.admin.orders', [
            'orders' => $orders
        ]);
    }
}
