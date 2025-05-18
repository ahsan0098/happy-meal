<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\ImageService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

#[Title('Edit Admin')]
#[Layout('layouts.admin.app')]
class EditAdmin extends Component
{
    use WithFileUploads;

    #[Locked]
    public $admin;

    public $first_name = '';
    public $last_name = '';
    public $address = '';
    public $phone = '';
    public $username = '';
    public $email = '';

    #[Validate(['image' => 'image|max:1024'])]
    public $image = '';

    public Admin $user;

    public function mount(): void
    {
        $this->user = Admin::findOrFail($this->admin);

        if ($this->user->id === Auth::guard('admin')->id()) {
            $this->redirect(route('admin.profile'), navigate: true);
            return;
        }

        $this->fill([
            'first_name' => $this->user->first_name,
            'last_name' => $this->user->last_name,
            'address' => $this->user->address,
            'phone' => $this->user->phone,
            'username' => $this->user->username,
            'email' => $this->user->email,
        ]);
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

    public function saveImage(): void
    {
        $this->authorize('update:admin', Auth::guard('admin')->user());

        $this->validate([
            'image' => 'required|image|max:1024',
        ]);

        try {
            $image = ImageService::uploadImage($this->image, 'admin/profile');
            ImageService::deleteImage($this->user->image);

            $this->user->update(['image' => $image->filepath]);

            $this->dispatch('swal:alert', [
                'icon' => 'success',
                'title' => 'Profile Image Updated',
                'text' => 'The profile image has been successfully updated.',
                'timer' => 5000,
            'reload'=>true,
                'bar' => true,
            ]);
        } catch (\Throwable) {
            $this->image->delete();
            $this->reset('image');
        }
    }

    public function save(): void
    {
        $this->validate([
            'first_name' => 'required|string|max:191',
            'last_name' => 'required|string|max:191',
            'address' => 'nullable|string|max:191',
            'phone' => 'nullable|string|max:20',
            'username' => [
                'required',
                'string',
                'max:191',
                Rule::unique('admins', 'username')->ignore($this->user->id),
            ],
            'email' => [
                'required',
                'email',
                'max:191',
                Rule::unique('admins', 'email')->ignore($this->user->id),
            ],
        ]);

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'address' => $this->address,
            'phone' => $this->phone,
            'username' => $this->username,
            'email' => $this->email,
        ]);

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Admin Updated',
            'text' => 'Admin information has been updated successfully.',
            'timer' => 5000,
            'bar' => true,
            'url' => route('admin.admins.index'),
        ]);
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Admins' => route('admin.admins.index'),
            'Edit Admin' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.admins.edit-admin');
    }
}
