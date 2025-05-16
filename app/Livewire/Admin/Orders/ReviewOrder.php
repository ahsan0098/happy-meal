<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;

#[Title('Process Orders')]
#[Layout('layouts.admin.app')]

class ReviewOrder extends Component
{

    #[Validate('required')]
    public $delivery_time;
    public Order $order;


    public function save($status)
    {
        if ($status == "approved") {

            $this->validate();
            $this->order->update([
                'status' => 'approved',
                'delivery_time' => $this->delivery_time,
            ]);
        } else {
            $this->order->update([
                'status' => $status,
            ]);
        }

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Success',
            'text' => 'Order status updated successfully',
            'timer' => 2000,
            'url' => $status == "completed" ? route('admin.orders.history') : route('admin.orders.index'),
            'bar' => true,
        ]);
    }
    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Orders' => route('admin.orders.index'),
            'Process' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.orders.review-order');
    }
}
