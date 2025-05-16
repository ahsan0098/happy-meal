<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Admins;


use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use App\Livewire\Forms\Admin\Admins\AdminForm;

#[Title('Create Admin')]
#[Layout('layouts.admin.app')]
class CreateAdmin extends Component
{
    public AdminForm $form;

    public function save(): void
    {

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
            'Admins' => route('admin.admins.index'),
            'Create Admin' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.admins.create-admin');
    }
}
