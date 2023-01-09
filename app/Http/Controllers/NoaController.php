<?php

namespace App\Http\Controllers;

use App\Http\Requests\Noa\StoreRequest;
use App\Http\Requests\Noa\UpdateRequest;
use App\Models\Canvass;
use App\Models\Noa;
use Illuminate\Http\Request;

class NoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $noas = Noa::get();
        return view('pages.Noa.index', compact('noas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $canvasses = Canvass::get();

        return view('pages.Noa.create', compact('canvasses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        Noa::create([
            'user_id' => auth()->user()->appTenant?->app_id,
            'noa_date' => $validated['noa_date'],
            'noa_approved_price' => $validated['noa_approved_price'],
            'bid_date' => $validated['bid_date'],
            'canvass_id' => $validated['canvass_id'],
        ]);
        return redirect()->back()->with('success-message', "NOA has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Noa  $noa
     * @return \Illuminate\Http\Response
     */
    public function show(Noa $noa)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Noa  $noa
     * @return \Illuminate\Http\Response
     */
    public function edit(Noa $noa , $id)
    {
        $noa = Noa::find($id);
        $canvasses = Canvass::get();
        return view('pages.Noa.edit', compact('canvasses' , 'noa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Noa  $noa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Noa $noa , $id)
    {
        $noa = Noa::find($id);
        $validated = $request->validated();
        $noa->update([
            'noa_date' => $validated['noa_date'],
            'noa_approved_price' => $validated['noa_approved_price'],
            'bid_date' => $validated['bid_date'],
            'canvass_id' => $validated['canvass_id'],
        ]);
        return redirect()->back()->with('success-message', "NOA has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Noa  $noa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Noa $noa)
    {
        //
    }
}
