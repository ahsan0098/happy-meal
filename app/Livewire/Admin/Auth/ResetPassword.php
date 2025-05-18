<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Auth;

use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\Admin;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

#[Title('Admin Reset Password')]
#[Layout('layouts.admin.guest')]
class ResetPassword extends Component
{
    #[Locked]
    public string $token = '';

    #[Locked]
    public int $id;

    public string $password = '';
    public string $password_confirmation = '';

    public function mount(string $token, int $id): void
    {
        $this->token = $token;
        $this->id = $id;

        $admin = Admin::findOrFail($id);
        abort_unless(Password::broker('admins')->tokenExists($admin, $token), 404);
    }

    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'id' => ['required', 'integer', 'exists:admins,id'],
            'password' => ['required', 'string', Rules\Password::defaults()],
            'password_confirmation' => ['required', 'same:password'],
        ]);

        $status = Password::broker('admins')->reset(
            [
                'token' => $this->token,
                'id' => $this->id,
                'password' => $this->password,
                'password_confirmation' => $this->password_confirmation,
            ],
            function (Admin $admin): void {
                $admin->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($admin));
            }
        );

        throw_if($status !== Password::PASSWORD_RESET, ValidationException::withMessages([
            'password' => [__($status)],
        ]));

        $this->redirectRoute('admin.login', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.auth.reset-password');
    }
}
