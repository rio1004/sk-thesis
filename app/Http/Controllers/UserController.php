<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Constant;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::get();
        return view('pages.user.index', compact('users'));
    }

    public function create(){
        $barangays = Constant::getBarangays();
        return view('pages.user.create',compact('barangays'));
    }
}
