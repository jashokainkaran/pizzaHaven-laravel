<?php
namespace App\Livewire;

use Livewire\Component;

class RegisterForm extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Redirect to the existing Breeze route
        return redirect()->route('register.post', [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
        ]);
    }

    public function render()
    {
        return view('livewire.auth.register-form');
    }
}
