<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use App\Services\ImageService;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Title('Items')]
#[Layout('layouts.admin.app')]
class ShowItems extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[On('delete')]
    public function deleteItem($id): void
    {

        $item = Item::query()->findOrFail($id);

        ImageService::deleteImage($item->image);
        $item->delete();

        $this->dispatch('swal:alert', [
            'title' => 'Item Deleted',
            'text' => 'Item has been deleted successfully',
            'icon' => 'success',
            'timer' => 2000,
            'bar' => true,
        ]);
    }

    #[Computed]
    public function items()
    {
        return Item::when($this->search, function ($query): void {
            $query->whereAny(['name', 'price', 'description'], 'like', '%' . $this->search . '%');
        })
            ->with('Menu')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Item' => route('admin.items.index'),
        ];
    }

    public function render()
    {
        return view('livewire.admin.items.show-items');
    }
}
