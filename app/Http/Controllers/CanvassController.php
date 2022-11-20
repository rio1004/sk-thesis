<?php

namespace App\Http\Controllers;

use App\Http\Requests\Canvass\StoreRequest;
use App\Models\Canvass;
use App\Models\Supplier;
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
        $suppliers = Supplier::get();
        return view('pages.Canvass.create',compact('suppliers'));
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
        // dd($validated);
        $canvass = Canvass::create([
            'user_id' => auth()->user()->id,
            'project_name' => $validated['project_name'],
        ]);
        foreach ($validated['items'] as $key => $value) {
            $canvass_item = $canvass->canvass_items()->create([
                'item' => $validated['items'][$key],
                'unit' => $validated['units'][$key],
                'qty' => $validated['qtys'][$key],
            ]);
            if ($validated["first_supplier"]) {
                $canvass_item->canvass_suppliers()->create([
                    "amount" => $validated["f_suppliers"][$key],
                    "supplier_id" => $validated["first_supplier"],
                    "canvass_id" => $canvass->id,
                    "type" => 1,
                    "status" => $validated["radios5"] == 1 ? 1 : 0,
                ]);
            }
            if ($validated["second_supplier"]) {
                $canvass_item->canvass_suppliers()->create([
                    "amount" => $validated["s_suppliers"][$key],
                    "supplier_id" => $validated["second_supplier"],
                    "canvass_id" => $canvass->id,
                    "type" => 2,
                    "status" => $validated["radios5"] == 2 ? 1 : 0,
                ]);
            }
            $canvass_item->canvass_suppliers()->create([
                "amount" => $validated["t_suppliers"][$key],
                "supplier_id" => $validated["third_supplier"],
                "canvass_id" => $canvass->id,
                "type" => 3,
                "status" => $validated["radios5"] == 3 ? 1 : 0,
            ]);
        }

        return redirect()->route('abstract-canvass.index')->withSuccess('Abstract Canvass has been created');
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
