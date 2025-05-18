<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Chefs;

use App\Models\Chef;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Illuminate\Validation\ValidationException;

#[Title('Edit Chef')]
#[Layout('layouts.admin.app')]
class EditChef extends Component
{
    use WithFileUploads;

    #[Locked]
    public Chef $chef;

    public string $name;
    public string $designation;
    public string $facebook;
    public string $twitter;
    public string $instagram;
    public string $linkedin;
    public $image;

    public function mount(): void
    {
        $this->name = $this->chef->name;
        $this->designation = $this->chef->designation;
        $this->facebook = $this->chef->facebook;
        $this->twitter = $this->chef->twitter;
        $this->instagram = $this->chef->instagram;
        $this->linkedin = $this->chef->linkedin;
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'image' => 'nullable|image|max:2024',
        ];
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
        $validated = $this->validate();

        if ($this->image) {
            $validated['image'] = $this->image->store('chefs', 'public');
        }

        $this->chef->update($validated);

        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Chef updated successfully.',
            'icon' => 'success',
            'url' => route('admin.chefs.index'),

        ]);
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
