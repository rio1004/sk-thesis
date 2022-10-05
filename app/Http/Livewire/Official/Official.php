<?php

namespace App\Http\Livewire\Official;

use App\Models\Official as ModelsOfficial;
use Livewire\Component;

class Official extends Component
{

    public $official;
    protected $listeners = ['delete'];

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->official->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id){
        $official = ModelsOfficial::where('id', $id)->first();
        if($official != null) {
            $official->delete();
            return redirect()->to('/official');
        }
        return redirect()->to('/official')->with('error', 'Official not found');
    }
    public function render()
    {
        return view('livewire.official.official');
    }
}
