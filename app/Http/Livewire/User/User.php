<?php

namespace App\Http\Livewire\User;

use App\Models\User as ModelsUser;
use Livewire\Component;

class User extends Component
{
    public $user;
    protected $listeners = ['delete'];

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->user->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id){
        $user = ModelsUser::where('id', $id)->first();
        if($user != null) {
            $user->delete();
            return redirect()->to('/user');
        }
        return redirect()->to('/user')->with('error', 'User not found');
    }
    public function render()
    {
        return view('livewire.user.user');
    }
}
