<?php

namespace App\Http\Controllers;

use App\Models\Abc;
use App\Models\Canvass;
use Illuminate\Http\Request;

class AbcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abcs = Abc::get();
        return view('pages.Abc.index', compact('abcs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $canvasses = Canvass::get();
        return view('pages.Abc.create', compact('canvasses'));
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
     * @param  \App\Models\Abc  $abc
     * @return \Illuminate\Http\Response
     */
    public function show(Abc $abc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abc  $abc
     * @return \Illuminate\Http\Response
     */
    public function edit(Abc $abc)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Abc  $abc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Abc $abc)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Abc  $abc
     * @return \Illuminate\Http\Response
     */
    public function destroy(Abc $abc)
    {
        //
    }
}
