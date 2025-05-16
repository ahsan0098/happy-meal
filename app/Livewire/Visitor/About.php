<?php

namespace App\Livewire\Visitor;

use Livewire\Component;

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('About')]
#[Layout('layouts.visitor.app')]
class About extends Component
{
    public function render()
    {
        return view('livewire.visitor.about');
    }
}
