<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Chefs;

use App\Models\Chef;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\Admin\Chefs\ChefForm;
use Illuminate\Validation\ValidationException;

#[Title('Edit Chef')]
#[Layout('layouts.admin.app')]

class EditChef extends Component
{
    use WithFileUploads;

    public ChefForm $form;

    #[Locked]
    public Chef $chef;

    #[Validate(['image' => 'nullable|image|max:2024'])]
    public $image = '';


    public function mount()
    {
        $this->form->fill(Arr::except($this->chef->toArray(), ['image']));
        return null;
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
            'Edit Chef' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.chefs.edit-chef');
    }
}
