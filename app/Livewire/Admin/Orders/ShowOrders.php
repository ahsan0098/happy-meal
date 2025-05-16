<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Pending Orders')]
#[Layout('layouts.admin.app')]
class ShowOrders extends Component
{
    use WithPagination;

    public $search = '';

    public function mount()
    {
        $this->search = request('search');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function orders()
    {
        return Order::where('status', 'placed')
        ->when($this->search, function ($query): void {
            $query->whereAny(['email','name','phone','reference_id'], 'like', '%' . $this->search . '%');
        })
        ->with('items')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }


    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Pending Orders' => route('admin.orders.index'),
        ];
    }

    public function render()
    {
        return view('livewire.admin.orders.show-orders');
    }
}
