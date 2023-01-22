<?php

namespace App\Http\Livewire;

use App\Models\AdminAnnouncement as ModelsAdminAnnouncement;
use Livewire\Component;

class AdminAnnouncement extends Component
{


    public function render()
    {
        $announcements = ModelsAdminAnnouncement::get();

        return view('livewire.admin-announcement', compact('announcments'));
    }
}
