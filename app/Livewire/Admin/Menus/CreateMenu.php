<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Menus;

use App\Models\Menu;
use App\Services\ImageService;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Title('Create Menu')]
#[Layout('layouts.admin.app')]
class CreateMenu extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $is_featured = '0';
    public $image = '';

    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_featured' => ['required', 'boolean'],
            'image' => ['required', 'image', 'max:2024'],
        ];
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

        $menu = new Menu();
        $menu->name = $this->name;
        $menu->is_featured = $this->is_featured;
        $menu->save();

        if ($this->image !== '') {
            $this->uploadImage($menu);
        }

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Menu Created',
            'text' => 'A new menu has been created successfully.',
            'timer' => 3000,
            'bar' => true,
            'url' => route('admin.menus.index')
        ]);

        $this->reset(['name', 'is_featured', 'image']);
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
            'Create Menu' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.menus.create-menu');
    }
}
