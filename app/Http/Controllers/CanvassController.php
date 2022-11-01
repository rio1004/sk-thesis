<?php

namespace App\Http\Controllers;

use App\Models\Canvass;
use Illuminate\Http\Request;

class CanvassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $canvasses = Canvass::get();
        return view('pages.Canvass.index',compact('canvasses'));
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
     * @param  \App\Models\Canvass  $canvass
     * @return \Illuminate\Http\Response
     */
    public function show(Canvass $canvass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Canvass  $canvass
     * @return \Illuminate\Http\Response
     */
    public function edit(Canvass $canvass)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Canvass  $canvass
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Canvass $canvass)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Canvass  $canvass
     * @return \Illuminate\Http\Response
     */
    public function destroy(Canvass $canvass)
    {
        //
    }
}
