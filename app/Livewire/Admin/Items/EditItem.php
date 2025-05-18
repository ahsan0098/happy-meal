<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use App\Models\Menu;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Arr;
use App\Services\ImageService;

#[Title('Edit Item')]
#[Layout('layouts.admin.app')]
class EditItem extends Component
{
    use WithFileUploads;

    #[Locked]
    public Item $item;

    public string $name = '';
    public $menu = '';
    public string $price = '';
    public string $description = '';
    public $is_featured = '0';
    public $is_available = '0';

    #[Validate(['image' => 'nullable|image|max:2024'])]
    public $image = '';

    public function mount()
    {
        $this->fill(Arr::only($this->item->toArray(), [
            'name',
            'price',
            'description',
            'is_featured',
            'is_available'
        ]));
        $this->menu = $this->item->menu_id;
    }

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
            'image' => ['nullable', 'image', 'max:2024'],
        ]);

        $this->item->update([
            'name' => $this->name,
            'menu_id' => $this->menu,
            'price' => $this->price,
            'description' => $this->description,
            'is_featured' => $this->is_featured,
            'is_available' => $this->is_available,
        ]);

        if ($this->image) {
            $this->uploadImage($this->item);
        }

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Item Updated',
            'text' => 'The item has been updated successfully.',
            'timer' => 3000,
            'bar' => true,
            'url' => route('admin.items.index'),
        ]);

        $this->reset(['image']);
    }

    private function uploadImage(Item $item): void
    {
        $image = ImageService::uploadImage($this->image, 'items', null);
        ImageService::deleteImage($item->image);

        $item->image = $image->filepath;
        $item->save();
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Items' => route('admin.items.index'),
            'Edit Item' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.items.edit-item');
    }
}
