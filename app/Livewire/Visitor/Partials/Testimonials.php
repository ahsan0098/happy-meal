<?php

namespace App\Livewire\Visitor\Partials;

use App\Models\Review;
use Livewire\Component;
use Livewire\Attributes\Computed;

class Testimonials extends Component
{
    #[Computed]
    public function reviews()
    {
        return Review::orderByDesc('id')->get();
    }

    public function render()
    {
        return view('livewire.visitor.partials.testimonials');
    }
}
