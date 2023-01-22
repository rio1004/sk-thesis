<?php

namespace App\Http\Livewire;

use App\Models\PurchaseRequest;
use App\Models\User;
use App\Services\Constant;
use Livewire\Component;

class Manage extends Component
{
    public $transaction;
    public $selectedBrgy;
    public $filteredBrgy;
    public $prs;
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
        $this->prs = $this->filteredBrgy?->purchase_requests;
    }

    public function searchProject(){
        if($this->brgy_id){
            $this->prs =  PurchaseRequest::where('user_id', $this->brgy_id)->where('pr_no', 'like' ,  "%{$this->searchTerm}%")?->get();
        }else{
            $this->prs =  PurchaseRequest::where('pr_no', 'like' ,  "%{$this->searchTerm}%")?->get();
        }

    }
    public function releaseConfirmation($id)
    {
        $this->dispatchBrowserEvent('swal:confirm-approved', [
            'id' => $id,
            'message' => 'Are you sure?',
            'text' => 'You are about to APPROVED this Purchase Request',
        ]);
    }

    public function approved($id)
    {
        $disbursement = PurchaseRequest::find($id);
        if ($disbursement) {
            $disbursement->update([
                'admin_approved' => 1
            ]);
        }
        return redirect()->to('manage/purchase-request');
    }
    public function disapprovedConfirm($id)
    {
        $this->dispatchBrowserEvent('swal:confirm-disapproved', [
            'id' => $id,
            'message' => 'Are you sure?',
            'text' => 'You are about to DISAPPROVED this Purchase Request',
        ]);
    }

    public function disapproved($id)
    {
        $disbursement = PurchaseRequest::find($id);
        if ($disbursement) {
            $disbursement->update([
                'admin_approved' => 2
            ]);
        }
        return redirect()->to('manage/purchase-request');
    }
    public function render()
    {
        $allPrs = PurchaseRequest::get();
        $brgys = Constant::getBarangays();
        return view('livewire.manage', compact('brgys', 'allPrs'));
    }
}
