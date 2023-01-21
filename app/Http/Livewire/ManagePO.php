<?php

namespace App\Http\Livewire;

use App\Models\PurchaseOrder;
use App\Models\User;
use App\Services\Constant;
use Livewire\Component;

class ManagePO extends Component
{
    public $transaction;
    public $selectedBrgy;
    public $filteredBrgy;
    public $pos;
    public $searchTerm;
    public $brgy_id;
    protected $listeners = ['disapproved', 'approved'];
    public function updatedselectedBrgy($brgy){
        $this->filteredBrgy = User::where('brgy', $brgy)->first();
        if(!$this->filteredBrgy && $brgy != ''){
            $this->dispatchBrowserEvent('brgyError', [
                'message' => $brgy.' is not yet Available',
            ]);
        }
        $this->brgy_id = $this->filteredBrgy?->id;
        $this->pos = $this->filteredBrgy?->purchase_orders;
    }

    public function searchProject(){
        if($this->brgy_id){
            $this->pos =  PurchaseOrder::where('user_id', $this->brgy_id)->where('pr_no', 'like' ,  "%{$this->searchTerm}%")?->get();
        }else{
            $this->pos =  PurchaseOrder::where('po_no', 'like' ,  "%{$this->searchTerm}%")?->get();
        }
    }
    public function releaseConfirmation($id)
    {
        $this->dispatchBrowserEvent('swal:confirm-approve', [
            'id' => $id,
            'message' => 'Are you sure?',
            'text' => 'You are about to APPROVED this Purchase Order',
        ]);
    }

    public function approved($id)
    {
        $disbursement = PurchaseOrder::find($id);
        if ($disbursement) {
            $disbursement->update([
                'admin_approved' => 1
            ]);
        }
        return redirect()->to('manage/purchase-order');
    }
    public function disapprovedConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm-disapproved', [
            'id' => $id,
            'message' => 'Are you sure?',
            'text' => 'You are about to DISAPPROVED this Purchase Order',
        ]);
    }

    public function disapproved($id)
    {
        $disbursement = PurchaseOrder::find($id);
        if ($disbursement) {
            $disbursement->update([
                'admin_approved' => 2
            ]);
        }
        return redirect()->to('manage/purchase-order');
    }
    public function render()
    {
        $allPos = PurchaseOrder::get();
        $brgys = Constant::getBarangays();
        return view('livewire.manage-p-o',compact('brgys', 'allPos'));
    }
}
