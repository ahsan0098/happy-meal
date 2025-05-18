<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Menus;

use App\Models\Menu;
use App\Services\ImageService;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Edit Menu')]
#[Layout('layouts.admin.app')]
class EditMenu extends Component
{
    use WithFileUploads;

    #[Locked]
    public Menu $menu;

    public string $name = '';
    public $is_featured = '0';
    public $image = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_featured' => ['required', 'boolean'],
            'image' => ['nullable', 'image', 'max:2024'],
        ];
    }

    public function mount(): void
    {
        $this->name = $this->menu->name;
        $this->is_featured = $this->menu->is_featured;
    }

    public function updatedImage(): void
    {
        try {
            $this->validateOnly('image', [
                'image' => 'image|max:2024',
            ], [
                'image.image' => 'The file must be an image.',
            ]);
        } catch (ValidationException) {
            $this->image->delete();
            $this->reset('image');
        }
    }

    public function save(): void
    {
        $validated = $this->validate();

        $this->menu->update([
            'name' => $this->name,
            'is_featured' => $this->is_featured,
        ]);

        if ($this->image !== '') {
            $this->uploadImage($this->menu);
        }

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Menu Updated',
            'text' => 'The menu has been updated successfully.',
            'timer' => 3000,
            'bar' => true,
            'url' => route('admin.menus.index'),
        ]);
    }

    private function uploadImage(Menu $menu): void
    {
        $image = ImageService::uploadImage($this->image, 'menus', null);
        ImageService::deleteImage($menu->image);
        $menu->image = $image->filepath;
        $menu->save();
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Menus' => route('admin.menus.index'),
            'Edit Menu' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.menus.edit-menu');
    }
}
