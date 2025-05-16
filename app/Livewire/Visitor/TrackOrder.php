<?php

namespace App\Livewire\Visitor;

use App\Models\Order;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Track Order')]
#[Layout('layouts.visitor.app')]
class TrackOrder extends Component
{
    public $search;

    public function mount()
    {
        $this->search = request()->get('search', '');
    }

    #[Computed]

    public function orders()
    {
        return Order::whereAny(['email', 'phone', 'reference_id'] ,$this->search)
            ->where('status', '!=', 'placed')
        ->with('items')
            ->orderByDesc('id')->get();
    }
    public function render()
    {
        return view('livewire.visitor.track-order');
    }
}
