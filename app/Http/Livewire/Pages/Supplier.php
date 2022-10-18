<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;
use App\Models\Supplier as SupplierModel;

class Supplier extends Component
{
    public $supplier;
    protected $listeners = ['delete'];

    public function deleteConfirm(){
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->supplier->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id){
        $supplier = SupplierModel::where('id', $id)->first();
        if($supplier != null) {
            $supplier->delete();
            return redirect()->to('/suppliers');
        }
        return redirect()->to('/suppliers')->with('error', 'Supplier not found');
    }
    public function render()
    {
        return view('livewire.pages.supplier');
    }
}
