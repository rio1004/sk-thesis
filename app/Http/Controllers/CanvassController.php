<?php

namespace App\Http\Controllers;

use App\Http\Requests\Canvass\StoreRequest;
use App\Http\Requests\Canvass\UpdateRequest;
use App\Models\Canvass;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PhpOffice\PhpSpreadsheet\IOFactory;

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
        return redirect()->route('canvass.index')->withSuccess('Abstract Canvass has been created');
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
        $f_supplier = $canvass->canvass_suppliers->where('type', 1)->first()?->supplier;
        $s_supplier = $canvass->canvass_suppliers->where('type', 2)->first()?->supplier;
        $t_supplier = $canvass->canvass_suppliers->where('type', 3)->first()?->supplier;
        $f1_supplier = $canvass->canvass_suppliers->where('type', 1)->first();
        $s2_supplier = $canvass->canvass_suppliers->where('type', 2)->first();
        $t3_supplier = $canvass->canvass_suppliers->where('type', 3)->first();
        $suppliers = Supplier::get();
        return view('pages.canvass.edit', compact('suppliers', 'canvass', 'f_supplier', 's_supplier', 't_supplier', 'f1_supplier', 's2_supplier', 't3_supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Canvass  $canvass
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Canvass $canvass)
    {
        $validated = $request->validated();
        $canvass->update(Arr::only($validated, ['project_name']));
        // get the existing items
        $canvass_items = $canvass->canvass_items()->pluck('id');
        $deletedIds = $canvass_items->diff($validated['canvassItemId'])->toArray();
        if ($deletedIds) {
            $canvass->canvass_items()->whereIn('id', $deletedIds)->delete();
        }
        foreach ($validated['canvassItemId'] as $key => $canvass_item) {
            if (!$canvass_item) {
                $c_item = $canvass->canvass_items()->create([
                    'item' => $validated['items'][$key],
                    'unit' => $validated['units'][$key],
                    'qty' => $validated['qtys'][$key],
                ]);
                if ($validated["first_supplier"]) {
                    $c_item->canvass_suppliers()->create([
                        "amount" => $validated["f_suppliers"][$key],
                        "supplier_id" => $validated["first_supplier"],
                        "canvass_id" => $canvass->id,
                        "type" => 1,
                        "status" => $validated["radios5"] == 1 ? 1 : 0,
                    ]);
                }
                if ($validated["second_supplier"]) {
                    $c_item->canvass_suppliers()->create([
                        "amount" => $validated["s_suppliers"][$key],
                        "supplier_id" => $validated["second_supplier"],
                        "canvass_id" => $canvass->id,
                        "type" => 2,
                        "status" => $validated["radios5"] == 2 ? 1 : 0,
                    ]);
                }
                if ($validated["second_supplier"]) {
                    $c_item->canvass_suppliers()->create([
                        "amount" => $validated["t_suppliers"][$key],
                        "supplier_id" => $validated["third_supplier"],
                        "canvass_id" => $canvass->id,
                        "type" => 3,
                        "status" => $validated["radios5"] == 3 ? 1 : 0,
                    ]);
                }
            } else {
                $c_item = $canvass->canvass_items()->where('id', $canvass_item)->first();
                $c_item->update([
                    'item' => $validated['items'][$key],
                    'unit' => $validated['units'][$key],
                    'qty' => $validated['qtys'][$key],
                ]);
                if ($validated["first_supplier"]) {
                    $c_item->canvass_suppliers()->where('id', $c_item->canvass_suppliers()->where('type', 1)->first()->id)->update([
                        "amount" => $validated["f_suppliers"][$key],
                        "supplier_id" => $validated["first_supplier"],
                        "canvass_id" => $canvass->id,
                        "type" => 1,
                        "status" => $validated["radios5"] == 1 ? 1 : 0,
                    ]);
                }
                if ($validated["second_supplier"]) {
                    $c_item->canvass_suppliers()->where('id', $c_item->canvass_suppliers()->where('type', 2)->first()->id)->update([
                        "amount" => $validated["s_suppliers"][$key],
                        "supplier_id" => $validated["second_supplier"],
                        "canvass_id" => $canvass->id,
                        "type" => 2,
                        "status" => $validated["radios5"] == 2 ? 1 : 0,
                    ]);
                }
                if ($validated["third_supplier"]) {
                    $c_item->canvass_suppliers()->where('id', $c_item->canvass_suppliers()->where('type', 3)->first()->id)->update([
                        "amount" => $validated["t_suppliers"][$key],
                        "supplier_id" => $validated["third_supplier"],
                        "canvass_id" => $canvass->id,
                        "type" => 3,
                        "status" => $validated["radios5"] == 3 ? 1 : 0,
                    ]);
                }
            }
        }
        return back()->withSuccess('Requisition and Issue Slip has been updated.');
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
