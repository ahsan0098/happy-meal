<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Admins;

use App\Models\Admin;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

#[Title('Create Admin')]
#[Layout('layouts.admin.app')]
class CreateAdmin extends Component
{
    public string $first_name = '';
    public string $last_name = '';
    public string $username = '';
    public string $email = '';
    public string $phone = '';
    public string $address = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'username'   => ['required', 'string', 'unique:admins,username'],
            'email'      => ['required', 'email', 'unique:admins,email'],
            'phone'      => ['nullable', 'string'],
            'address'    => ['nullable', 'string'],
            'password'   => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function save(): void
    {
        $this->validate();

        Admin::create([
            'first_name' => $this->first_name,
            'last_name'  => $this->last_name,
            'username'   => $this->username,
            'email'      => $this->email,
            'phone'      => $this->phone,
            'address'    => $this->address,
            'password'   => Hash::make($this->password),
        ]);

        $this->reset();

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Admin Created',
            'text' => 'The admin has been successfully created.',
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
            'Create Admin' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.admins.create-admin');
    }
}
