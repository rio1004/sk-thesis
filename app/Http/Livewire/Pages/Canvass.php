<?php

namespace App\Http\Livewire\Pages;

use App\Models\Canvass as ModelsCanvass;
use Livewire\Component;

class Canvass extends Component
{
    protected $listeners = ['delete'];

    public $canvass;

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->canvass->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id)
    {
        $canvass = ModelsCanvass::where('id', $id)->first();
        if($canvass != null){
            $canvass->delete();
            return redirect()->to('/abstract-canvass');
        }
        return redirect()->to('/abstract-canvass')->with('error', 'Something went wrong');
    }
    public function render()
    {
        return view('livewire.pages.canvass');
    }
}
