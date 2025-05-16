<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Dashboard;

use App\Models\Chef;
use App\Models\Item;
use App\Models\Admin;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Computed;

class StatCards extends Component
{

    #[Computed]
    public function totalAdmins()
    {
        return Admin::query()->count();
    }

    #[Computed]
    public function totalChefs()
    {
        return Chef::query()->count();
    }


    #[Computed]
    public function totalItems()
    {
        return Item::query()->count();
    }

    #[Computed]
    public function totalOrders()
    {
        return Order::query()->whereNot('status','pending')->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.stat-cards');
    }
}
