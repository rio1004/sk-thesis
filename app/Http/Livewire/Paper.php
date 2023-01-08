<?php

namespace App\Http\Livewire;

use App\Models\Announcement;
use Livewire\Component;

class Paper extends Component
{
    public $paper;
    public $title;
    public $when;
    public $what;
    public $details;
    public $where;

    public function show($id){

        $announcement = Announcement::find($id);
        $this->title = $announcement->title;
        $this->when = $announcement->when;
        $this->what = $announcement->what;
        $this->details = $announcement->details;
        $this->where = $announcement->where;
    }
    public function close(){
        $this->title = '';
        $this->when ='';
        $this->what ='';
        $this->details = '';
        $this->where ='';
    }
    public function render()
    {
        return view('livewire.paper');
    }
}
