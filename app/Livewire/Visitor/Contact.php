<?php

namespace App\Livewire\Visitor;

use Livewire\Component;

use App\Mail\ContactMail;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Mail;

#[Title('Contact')]
#[Layout('layouts.visitor.app')]
class Contact extends Component
{
    public $data = [];

    public function save()
    {
        $this->validate([
            'data.name' => 'required|string|max:255',
            'data.email' => 'required|email|max:255',
            'data.subject' => 'required|string|max:255',
            'data.message' => 'required'
        ]);

        if ($recipient = config('setting.site_general_email'))
            Mail::to($recipient)->send(new ContactMail($this->data));

        $this->dispatch('swal:alert', $this->setSweetAlertMessage());
    }

    private function setSweetAlertMessage(): array
    {
        return [
            'icon' => 'success',
            'title' =>  __("Message Sent Successfully!"),
            'text' => __("Thank you for reaching out! Your message has been sent, and we will get back to you soon."),
            'reload' => true
        ];
    }
    public function render()
    {
        return view('livewire.visitor.contact');
    }
}
