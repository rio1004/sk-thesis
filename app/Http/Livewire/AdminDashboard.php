<?php

namespace App\Http\Livewire;

use App\Models\Budget;
use App\Models\PurchaseRequest;
use App\Models\User;
use App\Services\Constant;
use Livewire\Component;

class AdminDashboard extends Component
{
    public $b;

    public $filteredBrgy;
    public $selectedBrgy;
    public $prs;
    public $pos;
    public $dvs;
    public $bgt;

    public function updatedselectedBrgy($brgy){
        $this->filteredBrgy = User::where('brgy', $brgy)->first();
        $this->prs = $this->filteredBrgy?->purchase_requests->count();
        $this->pos = $this->filteredBrgy?->purchase_orders->count();
        $this->dvs = $this->filteredBrgy?->disbursements->count();
        $this->bgt = Budget::where('user_id', $this->filteredBrgy?->id)->first();
    }


    public function render()
    {
        $brgys = Constant::getBarangays();
        return view('livewire.admin-dashboard', compact('brgys'));
    }
}
