<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ntp\StoreRequest;
use App\Models\Canvass;
use App\Models\Ntp;
use Illuminate\Http\Request;

class NtpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ntps = Ntp::get();
        return view('pages.Ntp.index', compact('ntps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $canvasses = Canvass::get();
        return view('pages.Ntp.create', compact('canvasses'));
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
        Ntp::create([
            'ntp_date' => $validated['ntp_date'],
            'ntp_effectivity_date' => $validated['ntp_effectivity_date'],
            'project_location' => $validated['project_location'],
            'canvass_id' => $validated['canvass_id'],
        ]);
        return redirect()->back()->with("success-message","NTP has been created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ntp  $ntp
     * @return \Illuminate\Http\Response
     */
    public function show(Ntp $ntp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ntp  $ntp
     * @return \Illuminate\Http\Response
     */
    public function edit(Ntp $ntp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ntp  $ntp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ntp $ntp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ntp  $ntp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ntp $ntp)
    {
        //
    }
}
