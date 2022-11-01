<?php

namespace App\Http\Livewire\Pages;

use App\Models\PurchaseOrder as ModelsPurchaseOrder;
use Livewire\Component;

class PurchaseOrder extends Component
{

    public $purchaseOrder;

    protected $listeners = ['delete'];


    public function deleteConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'id' => $this->purchaseOrder->id,
            'message' => 'Are you sure?'
        ]);
    }

    public function delete($id)
    {
        $purchaseOrder = ModelsPurchaseOrder::where('id', $id)->first();
        if($purchaseOrder != null) {
            $purchaseOrder->delete();
            return redirect()->to('/purchase-order')->with('success', 'Purchase Order has been deleted');
        }
        return redirect()->to('/purchase-order')->with('error', 'Purchase Order not found');

    }
    public function render()
    {
        return view('livewire.pages.purchase-order');
    }
}
