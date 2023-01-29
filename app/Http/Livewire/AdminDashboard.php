<?php

namespace App\Http\Livewire;

use App\Models\AdminAnnouncement;
use App\Models\Budget;
use App\Models\PurchaseRequest;
use App\Models\User;
use App\Services\Constant;
use Carbon\Carbon;
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
    public $announce_id;
    public function updatedselectedBrgy($brgy){
        $this->filteredBrgy = User::where('brgy', $brgy)->first();
        $this->prs = $this->filteredBrgy?->purchase_requests->count();
        $this->pos = $this->filteredBrgy?->purchase_orders->count();
        $this->dvs = $this->filteredBrgy?->disbursements->count();
        $this->bgt = Budget::where('user_id', $this->filteredBrgy?->id)->first();
    }
    public function showAnnounce($id){
        $announce = AdminAnnouncement::find($id);
        $this->dispatchBrowserEvent('showAnnounce', [
            'title' => $announce->title,
            'what' =>  '<b>What:</b> '.$announce->what,
            'when' =>  '<b>When:</b> '.$announce->when,
            'where' =>  '<b>Where:</b> '.$announce->where,
            'details' =>  '<b>Details:</b>'.$announce->details,
        ]);
    }

    public function render()
    {
        $brgys = Constant::getBarangays();
        $announcements = AdminAnnouncement::whereYear('when', Carbon::now()->year)
        ->whereMonth('when', Carbon::now()->month)->get();
        return view('livewire.admin-dashboard', compact('brgys', 'announcements'));
    }
}
