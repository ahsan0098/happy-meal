<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Home')]
#[Layout('layouts.visitor.app')]

class Home extends Component
{
    public function render()
    {
        return view('livewire.visitor.home');
    }
}
