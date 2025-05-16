<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Chefs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\Admin\Chefs\ChefForm;
use Illuminate\Validation\ValidationException;

#[Title('Create Chef')]
#[Layout('layouts.admin.app')]
class CreateChef extends Component
{
    use WithFileUploads;

    public ChefForm $form;


    #[Validate(['image' => 'required|image|max:2024'])]
    public $image = '';

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

            return;
        }

        $this->form->image = $this->image;
    }
    public function save(): void
    {
        $this->validate();

        $this->form->validate();

        $this->form->save();

        if ($this->form->swal !== []) {
            $this->dispatch('swal:alert', $this->form->swal);

            $this->form->swal = [];

            return;
        }
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Chefs' => route('admin.chefs.index'),
            'Create Chef' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.chefs.create-chef');
    }
}
