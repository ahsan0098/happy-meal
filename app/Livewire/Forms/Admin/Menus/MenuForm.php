<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin\Menus;

use Livewire\Form;
use App\Models\Menu;
use App\Services\ImageService;

class MenuForm extends Form
{
    public ?int $id = null;

    public string $name = '';

    public string $is_featured = '0';

    public $image = '';

    public array $swal = [];

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_featured' => ['required', 'boolean'],
        ];
    }

    /**
     * Save or update the menu details.
     */
    public function save(): void
    {
        $validated = $this->validate();

        $menu = Menu::query()->findOrNew($this->id);

        $menu->fill($validated);

        $menu->save();

        if ($this->image !== '') {
            $this->uploadImage($menu);
        }

        $this->setSweetAlertMessage(
            $this->id !== null && $this->id !== 0 ? 'Menu Updated' : 'Menu Created'
        );


        $this->reset(['image']);
    }

    private function uploadImage($menu)
    {
        $image = ImageService::uploadImage($this->image, 'menus', null);

        ImageService::deleteImage($menu->image);

        $menu->image = $image->filepath;

        $menu->save();
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
                ? 'The menu has been updated successfully.'
                : 'A new menu has been created successfully.',
            'timer' => 3000,
            'bar' => true,
            'url'=>route('admin.menus.index')
        ];
    }
}
