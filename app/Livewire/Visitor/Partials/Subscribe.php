<?php

namespace App\Livewire\Visitor\Partials;

use App\Models\Subscriber;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Subscribe extends Component
{
    #[Validate('required|unique:subscribers,email|email:rfc,dns')]
    public $email;

    public function save()
    {
        $this->validate();

        Subscriber::insert(['email' => $this->email]);

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Subscribed',
            'text' => 'You have successfully subscribed for our newsletter. We will share our news to you',
            'timer' => 5000,
            'bar' => true,
            'reload' => true,
        ]);
    }
    public function render()
    {
        return view('livewire.visitor.partials.subscribe');
    }
}
