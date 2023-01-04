<?php

namespace App\Http\Livewire\Pages;

use App\Models\Announcement as ModelsAnnouncement;
use Livewire\Component;

class Announcement extends Component
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
        $announcement = ModelsAnnouncement::where('id', $id)->first();
        if($announcement != null){
            $announcement->delete();
            return redirect()->to('/announcement');
        }
        return redirect()->to('/announcement')->with('error', 'Something went wrong');
    }
    public function render()
    {
        return view('livewire.pages.announcement');
    }
}
