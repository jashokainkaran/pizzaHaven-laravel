<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class Users extends Component
{
    use WithPagination;

    public $searchTerm = '';

    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        // Exclude admin users
        $query->where('type', '!=', 'admin')
              ->orWhereNull('type');

        // Apply search filter
        if ($this->searchTerm) {
            $searchTerm = $this->searchTerm;
            $query->where(function($q) use ($searchTerm) {
                $q->where('first_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('last_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('email', 'like', '%' . $searchTerm . '%')
                  ->orWhere('phone', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $query->latest()->paginate(10);

        return view('livewire.admin.users', [
            'users' => $users
        ]);
    }
}
