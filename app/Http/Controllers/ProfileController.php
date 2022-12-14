<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = User::where('id' , $id)->first();
        return view('pages.Profile.edit', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $request->validate([
            'first_name' => ['required', 'string'],
            'middle_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'age' => ['required', 'string'],
            'gender' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'], 
        ]);

        $update = User::where('id' , $id)->first()
            ->update(
                $request->all()
            );
        return back()->with('success-message','Profile has been updated');
    }

     public function changePassword(Request $request, $id)
    {   
        
        $request->validate([
            'current_password'=>'required',
            'password'=>'required',
            'confirm_password'=>'required',
        ]);
        $user = User::where('id' , $id)->first();
        if(Hash::check($request->current_password, $user->password))
        {
            if($request->password == $request->confirm_password)
            {
                $user = User::where('id' , $id)
                    ->update([
                        'password' => Hash::make($request->password),
                    ]); 
              
                return redirect()->back()->with('success-message','Successfully updated password!');
            }  
            else
            {
             
                return redirect()->back()->with('error-message','New password do not match!');
            } 
        }
        else
        {
        
            return redirect()->back()->with('error-message','Current password is incorrect!');
        }
         
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
