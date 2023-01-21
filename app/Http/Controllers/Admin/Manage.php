<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Manage extends Controller
{
    public function pr_index(){
        return view('manage');
    }
    public function po_index(){
        return view('manage_po');
    }
}
