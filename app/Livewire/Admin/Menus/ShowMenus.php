<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Menus;

use App\Models\Menu;
use App\Services\ImageService;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Title('Menus')]
#[Layout('layouts.admin.app')]
class ShowMenus extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[On('delete')]
    public function deleteMenu($id): void
    {

        $menu = Menu::query()->findOrFail($id);

        ImageService::deleteImage($menu->image);
        $menu->delete();

        $this->dispatch('swal:alert', [
            'title' => 'Menu Deleted',
            'text' => 'Menu has been deleted successfully',
            'icon' => 'success',
            'timer' => 2000,
            'bar' => true,
        ]);
    }

    #[Computed]
    public function menus()
    {
        return Menu::when($this->search, function ($query): void {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
            ->withCount('items')
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Menu' => route('admin.menus.index'),
        ];
    }

    public function render()
    {
        return view('livewire.admin.menus.show-menus');
    }
}
