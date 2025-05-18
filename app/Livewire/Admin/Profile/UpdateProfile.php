<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Profile;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\WithFileUploads;
use App\Services\ImageService;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

#[Title('Update Profile')]
#[Layout('layouts.admin.app')]
class UpdateProfile extends Component
{
    use WithFileUploads;

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
        $this->user = Auth::guard('admin')->user();

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
                'text' => 'Your profile image has been updated successfully.',
                'timer' => 5000,
                'bar' => true,
                'reload' => true,

            ]);
        } catch (\Throwable) {
            $this->image->delete();
            $this->reset('image');

            $this->dispatch('swal:alert', [
                'icon' => 'error',
                'title' => 'Profile Image Update Failed',
                'text' => 'An error occurred while updating your profile image.',
                'timer' => 5000,
                'reload' => true,
                'bar' => true,
            ]);
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
            'title' => 'Profile Updated',
            'text' => 'Your profile has been updated successfully.',
            'timer' => 5000,
            'bar' => true,
            'reload' => true
        ]);
    }

    public function sendVerification(): void
    {
        if ($this->user->hasVerifiedEmail()) {
            $this->redirectIntended(route('admin.profile'));
            return;
        }

        $this->user->sendEmailVerificationNotification();

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Email Verification Sent',
            'text' => 'An email verification link has been sent to your email address.',
            'timer' => 5000,
            'bar' => true,
            'url' => route('admin.profile'),

        ]);
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Profile' => route('admin.profile'),
        ];
    }

    public function render(): View
    {
        return view('livewire.admin.profile.update-profile');
    }
}
