<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Auth;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

#[Title('Admin Login')]
#[Layout('layouts.admin.guest')]
class Login extends Component
{
    public string $email = '';
    public string $password = '';
    public bool $remember = false;

    public function login(): void
    {
        $this->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = filter_var($this->email, FILTER_VALIDATE_EMAIL)
            ? ['email' => $this->email, 'password' => $this->password]
            : ['username' => $this->email, 'password' => $this->password];

        if (!Auth::guard('admin')->attempt($credentials, $this->remember)) {

            $this->reset('password');

            $this->dispatch('swal:alert', [
                'icon' => 'error',
                'title' => 'Login Failed',
                'text' => trans('auth.failed'),
            ]);

            return;
        }

        Session::regenerate();
      

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Login Successful',
            'text' => 'You have been logged in successfully!',
            'url' => route('admin.dashboard'),
            'timer' => 1000,
        ]);
    }

    public function render(): View
    {
        return view('livewire.admin.auth.login');
    }
}
