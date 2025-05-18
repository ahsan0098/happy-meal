<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Chefs;

use App\Models\Chef;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Validation\ValidationException;

#[Title('Create Chef')]
#[Layout('layouts.admin.app')]
class CreateChef extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $designation = '';
    public string $facebook = '';
    public string $twitter = '';
    public string $instagram = '';
    public string $linkedin = '';
    public $image;

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'image' => 'required|image|max:2024',
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

        $validated['image'] = $this->image->store('chefs', 'public');

        Chef::create($validated);

        $this->dispatch('swal:alert', [
            'title' => 'Success!',
            'text' => 'Chef created successfully.',
            'icon' => 'success',
            'url' => route('admin.chefs.index'),
        ]);

        $this->reset();
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
