<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Chefs;

use App\Models\Chef;
use App\Services\ImageService;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;

#[Title('Chefs')]
#[Layout('layouts.admin.app')]
class ShowChefs extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[On('delete')]
    public function deleteChef($id): void
    {

        $chef = Chef::query()->findOrFail($id);

        ImageService::deleteImage($chef->image);
        $chef->delete();

        $this->dispatch('swal:alert', [
            'title' => 'Chef Deleted',
            'text' => 'Chef has been deleted successfully',
            'icon' => 'success',
            'timer' => 2000,
            'bar' => true,
        ]);
    }

    #[Computed]
    public function chefs()
    {
        return Chef::when($this->search, function ($query): void {
                $query->where(function ($q): void {
                    $q->where('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('lAST_name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Chef' => route('admin.chefs.index'),
        ];
    }

    public function render()
    {
        return view('livewire.admin.chefs.show-chefs');
    }
}
