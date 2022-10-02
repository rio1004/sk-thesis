<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest\StoreRequest;
use App\Models\User;
use App\Services\Constant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    public function store(StoreRequest $request){
        $validated = $request->validated();
        $password = Str::random(8);
        User::create([
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'last_name' => $validated['last_name'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'email' => $validated['email'],
            'brgy' => $validated['brgy'],
            'password' => Hash::make($password)
        ])->assignRole('admin');

        return redirect()->back()->with('success-message', 'User created Successfully');
    }
}
