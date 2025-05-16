<?php

namespace App\Livewire\Admin\Subscribers;

use Livewire\Component;
use App\Models\Subscriber;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

#[Title('News Letter')]
#[Layout('layouts.admin.app')]

class SendNews extends Component
{

    public $form = [];
    

    public function save(): void
    {

        $this->validate([
            'form.subject' => 'required',
            'form.link' => 'nullable',
            'form.message' => 'required',
        ]);

        $subscribers = Subscriber::where('status', 'active')->get();

        foreach ($subscribers as $subscriber) {
            $subscriber->sendNewsNotification($this->form);
        }
        
        $this->dispatch('swal:alert', [
            'title' => 'News Letter Sent',
            'text' => 'News letter has been sent successfully',
            'icon' => 'success',
            'timer' => 2000,
            'bar' => true,
            'url' => route('admin.subscribers.index')
        ]);
    }

    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Subscribers' => route('admin.subscribers.index'),
            'Send News Letter' => '',
        ];
    }

    public function render()
    {
        return view('livewire.admin.subscribers.send-news');
    }
}
