<?php

namespace App\Http\Controllers;

use App\Http\Requests\Official\StoreRequest;
use App\Models\Official;
use App\Services\Constant;
use Illuminate\Http\Request;

class OfficialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $officials = Official::get();
        return view('pages.Officials.index', compact('officials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $positions = Constant::getPositions();
        $otherPos = Constant::getOtherPositions();

        return view('pages.Officials.create', compact('positions', 'otherPos'));

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

        Official::create($validated);

        return redirect()->back()->with('success-message', 'Official has been Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function show(Official $official)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function edit(Official $official)
    {
        $positions = Constant::getPositions();
        $otherPos = Constant::getOtherPositions();
        return view('pages.Officials.edit', compact('official','positions', 'otherPos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function update(StoreRequest $request, Official $official)
    {
        $validated = $request->validated();
        $official->update($validated);

        return redirect()->back()->with('success-message', 'Official has been Created Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Official  $official
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete = Official::findOrFail($id);
        $delete->delete();
        return response()->json(['status'=> 'Successfully Deleted.']);
    }
}
