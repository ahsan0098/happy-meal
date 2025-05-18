<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Validation\ValidationException;
use App\Services\ImageService;

#[Title('Create Item')]
#[Layout('layouts.admin.app')]
class CreateItem extends Component
{
    use WithFileUploads;

    public string $name = '';
    public $menu = '';
    public string $price = '';
    public string $description = '';
    public string $is_featured = '0';
    public string $is_available = '0';

    #[Validate(['image' => 'required|image|max:2024'])]
    public $image = '';

    #[Computed]
    public function menus()
    {
        return Menu::all();
    }

    public function updatedImage(): void
    {
        try {
            $this->validateOnly('image');
        } catch (ValidationException) {
            $this->image->delete();
            $this->reset('image');
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'menu' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string', 'max:255'],
            'is_featured' => ['required', 'boolean'],
            'is_available' => ['required', 'boolean'],
            'image' => ['required', 'image', 'max:2024'],
        ]);

        $item = new Item();
        $item->name = $this->name;
        $item->menu_id = $this->menu;
        $item->price = $this->price;
        $item->description = $this->description;
        $item->is_featured = $this->is_featured;
        $item->is_available = $this->is_available;

        $item->save();

        if ($this->image) {
            $this->uploadImage($item);
        }

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Item Created',
            'text' => 'A new item has been created successfully.',
            'timer' => 3000,
            'bar' => true,
            'url' => route('admin.items.index'),
        ]);

        $this->reset(['image']);
    }

    private function uploadImage(Item $item): void
    {
        $image = ImageService::uploadImage($this->image, 'items', null);
        $item->image = $image->filepath;
        $item->save();
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Items' => route('admin.items.index'),
            'Create Item' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.items.create-item');
    }
}
