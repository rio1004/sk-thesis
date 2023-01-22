<?php

namespace App\Http\Livewire;

use App\Models\AdminAnnouncement;
use App\Models\Announcement;
use Carbon\Carbon;
use Livewire\Component;

class Paper extends Component
{

    public function showAnnounce($id){
        $announce = Announcement::find($id);
        $this->dispatchBrowserEvent('showAnnounce', [
            'title' => $announce->title,
            'what' =>  '<b>What:</b> '.$announce->what,
            'when' =>  '<b>When:</b> '.$announce->when,
            'where' =>  '<b>Where:</b> '.$announce->where,
            'details' =>  '<b>Details:</b>'.$announce->details,
        ]);
    }
    public function showAnnounceAdmin($id){
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
        $announcements = Announcement::whereYear('when', Carbon::now()->year)
        ->whereMonth('when', Carbon::now()->month)->get();
        $brgyAnnouncements = AdminAnnouncement::whereYear('when', Carbon::now()->year)
        ->whereMonth('when', Carbon::now()->month)->get();
        return view('livewire.paper', compact('announcements', 'brgyAnnouncements'));
    }
}
