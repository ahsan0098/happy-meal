<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Admin\Chefs;

use Livewire\Form;
use App\Models\Chef;
use App\Services\ImageService;

class ChefForm extends Form
{
    public ?int $id = null;

    public string $first_name = '';
    public string $last_name = '';

    public string $email = '';

    public string $is_featured = '0';

    public $image = '';

    public array $swal = [];

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
            'is_featured' => ['required', 'boolean'],
        ];
    }

    /**
     * Save or update the chef details.
     */
    public function save(): void
    {
        $validated = $this->validate();

        $chef = Chef::query()->findOrNew($this->id);

        $chef->fill($validated);

        $chef->save();

        if ($this->image !== '') {
            $this->uploadImage($chef);
        }

        $this->setSweetAlertMessage(
            $this->id !== null && $this->id !== 0 ? 'Chef Updated' : 'Chef Created'
        );


        $this->reset(['image']);
    }

    private function uploadImage($chef)
    {
        $image = ImageService::uploadImage($this->image, 'chefs', null);

        ImageService::deleteImage($chef->image);

        $chef->image = $image->filepath;

        $chef->save();
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
                ? 'The chef has been updated successfully.'
                : 'A new chef has been created successfully.',
            'timer' => 3000,
            'bar' => true,
            'url'=>route('admin.chefs.index')
        ];
    }
}
