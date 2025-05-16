<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Items;

use App\Models\Item;
use App\Models\Menu;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use App\Livewire\Forms\Admin\Items\ItemForm;
use Illuminate\Validation\ValidationException;

#[Title('Edit Item')]
#[Layout('layouts.admin.app')]

class EditItem extends Component
{
    use WithFileUploads;

    public ItemForm $form;

    #[Locked]
    public Item $item;

    #[Validate(['image' => 'nullable|image|max:2024'])]
    public $image = '';


    public function mount()
    {
        $this->form->fill(Arr::except($this->item->toArray(), ['image','menu_id']));
        $this->form->menu = $this->item->menu_id;
        
        return null;
    }

    #[Computed]
    public function menus()
    {
        return Menu::all();
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
            'Items' => route('admin.items.index'),
            'Edit Item' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.items.edit-item');
    }
}
