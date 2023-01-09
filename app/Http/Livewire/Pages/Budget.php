<?php

namespace App\Http\Livewire\Pages;

use Livewire\Component;

class Budget extends Component
{
    public $budget;
    public function render()
    {
        return view('livewire.pages.budget');
    }
}
