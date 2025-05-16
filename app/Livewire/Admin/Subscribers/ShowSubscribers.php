<?php

namespace App\Livewire\Admin\Subscribers;

use App\Models\Subscriber;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Subscribers')]
#[Layout('layouts.admin.app')]
class ShowSubscribers extends Component
{
    use WithPagination;

    public $search = '';

    public function mount()
    {
        $this->search = request('search');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function subscribers()
    {
        return Subscriber::when($this->search, function ($query): void {
            $query->where('email', 'like', '%' . $this->search . '%');
        })
            ->orderBy('id', 'desc')
            ->paginate(10);
    }


    public function changeStatus($subr, $status)
    {
      
        $r = Subscriber::find($subr);
        $r->status = $status;
        $r->save();

        $this->dispatch("swal:toast", [
            'icon' => 'success',
            'title' =>  "Status Changed Successfully!",
            'text' => "Subscriber's status has been updated to " . $status,
            'reload' => false
        ]);
    }
    #[Computed]
    public function breadcrumb(): array
    {
        return [
            'Dashboard' => route('admin.dashboard'),
            'Subscribers' => route('admin.subscribers.index'),
        ];
    }

    public function render()
    {
        return view('livewire.admin.subscribers.show-subscribers');
    }
}
