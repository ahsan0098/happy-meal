<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin\Items;

use Livewire\Form;
use App\Models\Item;
use App\Services\ImageService;

class ItemForm extends Form
{
    public ?int $id = null;

    public string $name = '';
    public $menu = '';
    public string $price = '';
    public string $description = '';

    public string $is_featured = '0';
    public string $is_available = '0';

    public $image = '';

    public array $swal = [];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'menu' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
            'description' => ['required', 'string', 'max:255'],
            'is_featured' => ['required', 'boolean'],
            'is_available' => ['required', 'boolean'],
        ];
    }

    /**
     * Save or update the item details.
     */
    public function save(): void
    {
        $validated = $this->validate();

        $item = Item::query()->findOrNew($this->id);

        $item->fill($validated);
        $item->menu_id = $this->menu;

        $item->save();

        if ($this->image !== '') {
            $this->uploadImage($item);
        }

        $this->setSweetAlertMessage(
            $this->id !== null && $this->id !== 0 ? 'Item Updated' : 'Item Created'
        );


        $this->reset(['image']);
    }

    private function uploadImage($item)
    {
        $image = ImageService::uploadImage($this->image, 'items', null);

        ImageService::deleteImage($item->image);

        $item->image = $image->filepath;

        $item->save();
    }


    /**
     * Set SweetAlert data with a success message.
     */
    private function setSweetAlertMessage(string $title): void
    {
        $this->swal = [
            'icon' => 'success',
            'title' => $title,
            'text' => $this->id !== null && $this->id !== 0
                ? 'The item has been updated successfully.'
                : 'A new item has been created successfully.',
            'timer' => 3000,
            'bar' => true,
            'url' => route('admin.items.index')
        ];
    }
}
