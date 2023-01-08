<?php

namespace App\Http\Livewire\Approve;
use App\Mail\UserMail;
use Illuminate\Support\Facades\Mail;

use App\Models\User as ModelsUser;
use Livewire\Component;

class Approve extends Component
{
    public $user;
    protected $listeners = ['send'];
    

    public function approveConfirm(){
        $this->dispatchBrowserEvent('swal:confirm-approve', [
            'id' => $this->user->id,
            'text' => 'You are about to approve this user',
            'title' => 'Are you sure?'
        ]);
    }

    function send($id)
    {
        $user = ModelsUser::where('id', $id)->first();
        Mail::to($user['email'])->send(new UserMail($user));

    }

    public function render()
    {
        return view('livewire.approve.approve');
    }
}
