<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Auth;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

#[Title('Admin Forgot Password')]
#[Layout('layouts.admin.guest')]
class ForgotPassword extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => 'required|email',
        ]);

        $status = Password::broker('admins')->sendResetLink([
            'email' => $this->email,
        ]);

        $this->reset('email');

        throw_if($status !== Password::RESET_LINK_SENT, ValidationException::withMessages([
            'email' => __($status),
        ]));

        $this->dispatch('swal:alert', [
            'icon' => 'success',
            'title' => 'Password Reset Link Sent',
            'text' => __($status),
        ]);
    }

    public function render(): View
    {
        return view('livewire.admin.auth.forgot-password');
    }
}
