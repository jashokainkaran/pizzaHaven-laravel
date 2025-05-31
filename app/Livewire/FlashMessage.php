<?php

namespace App\Livewire;

use Livewire\Component;

class FlashMessage extends Component
{
    public $message;
    public $type = 'success';
    public $visible = false;

    protected $listeners = ['flashMessage' => 'show'];

    public function show($data)
    {
        $this->message = $data['message'];
        $this->type = $data['type'] ?? 'success';
        $this->visible = true;

        // Automatically close after 3 seconds (handled in JS)
        $this->dispatch('flashMessageShown');
    }

    public function close()
    {
        $this->visible = false;
    }

    public function render()
    {
        return view('livewire.flash-message');
    }
}
