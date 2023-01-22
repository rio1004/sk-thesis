<?php

namespace App\Http\Livewire;

use App\Models\AdminAnnouncement;
use Livewire\Component;

class AdminAnnounce extends Component
{
    protected $listeners = ['delete'];

    public $announcement;

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->announcement->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id)
    {
        $announcement = AdminAnnouncement::where('id', $id)->first();
        if($announcement != null){
            $announcement->delete();
            return redirect()->to('/admin-announcement');
        }
        return redirect()->to('/admin-announcement')->with('error', 'Something went wrong');
    }
    public function render()
    {
        return view('livewire.admin-announce');
    }
}
