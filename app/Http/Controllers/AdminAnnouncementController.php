<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminAnnouncement\StoreRequest;
use App\Http\Requests\AdminAnnouncement\UpdateRequest;
use App\Models\AdminAnnouncement;
use Illuminate\Http\Request;

class AdminAnnouncementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = AdminAnnouncement::get();
        return view('adminAnnouncement.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('adminAnnouncement.create');
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
        AdminAnnouncement::create($validated);
        return redirect()->back()->with('success-message', 'Announcement Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AdminAnnouncement  $adminAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function show(AdminAnnouncement $adminAnnouncement)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AdminAnnouncement  $adminAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function edit(AdminAnnouncement $adminAnnouncement)
    {
        return view('adminAnnouncement.edit', compact('adminAnnouncement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AdminAnnouncement  $adminAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, AdminAnnouncement $adminAnnouncement)
    {
        $validated = $request->validated();

        $adminAnnouncement->update($validated);

        return redirect()->back()->with('success-message', 'Announcement Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AdminAnnouncement  $adminAnnouncement
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdminAnnouncement $adminAnnouncement)
    {
        //
    }
}
