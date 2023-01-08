<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Official\Official;
use App\Http\Requests\Abc\StoreRequest;
use App\Http\Requests\Abc\UpdateRequest;
use App\Models\Abc;
use App\Models\Canvass;
use App\Models\Official as ModelsOfficial;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $officials = ModelsOfficial::get();
        return view('pages.Abc.create', compact('officials'));
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

        $abc = Abc::create([
            'bidder' => $validated['bidder'],
            'submitted_by_id' => $validated['prepared_by'],
            'approved_by_id' => $validated['approved_by'],
            'recommend_by_id' => $validated['recommended_by'],
            'procurement_title' => $validated['proc_title'],
        ]);

        foreach ($validated['items'] as $key => $value) {
            if ($value && $validated['units'][$key]) {
                $total_qty_mp = $validated['prices'][$key] * $validated['qtys'][$key];
                $costs = array($total_qty_mp, $validated['insurances'][$key], $validated['indirects_costs'][$key],
                    $validated['adjustments'][$key], $validated['taxes'][$key]);
                $total_cost = array_sum($costs);
                $abc->abc_items()->create([
                    'item_no' => $key + 1,
                    'item' => $validated['items'][$key],
                    'unit' => $validated['units'][$key],
                    'qty' => $validated['qtys'][$key],
                    'tax' => $validated['taxes'][$key],
                    'market_price' => $validated['prices'][$key],
                    'insurance' => $validated['insurances'][$key],
                    'indirect_cost' => $validated['indirects_costs'][$key],
                    'valuation_adjustment' => $validated['adjustments'][$key],
                    'total_cost' => $total_cost,
                    'unit_cost' => $validated['prices'][$key],
                ]);
            }
        }
        return back()->with('success-message','ABC request has been updated.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Abc  $abc
     * @return \Illuminate\Http\Response
     */
    public function show(Abc $abc)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Abc  $abc
     * @return \Illuminate\Http\Response
     */
    public function edit(Abc $abc)
    {
        $officials = ModelsOfficial::get();
        return view('pages.Abc.edit', compact('officials', 'abc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Abc  $abc
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Abc $abc)
    {
        $validated = $request->validated();

        $abc->update(Arr::only($validated, ['procurement_title', 'bidder', 'submitted_by_id', 'approved_by_id', 'recommend_by_id']));

        // get the existing items
        $abc_items = $abc->abc_items()->pluck('id');
        $deletedIds = $abc_items->diff($validated['abcId'])->toArray();
        if ($deletedIds) {
            $abc->abc_items()->whereIn('id', $deletedIds)->delete();
        }
        foreach ($validated['abcId'] as $key => $abc_item) {
            if (!$abc_item && $validated['items'][$key] && $validated['units'][$key]) {
                $total_qty_mp = $validated['prices'][$key] * $validated['qtys'][$key];
                $costs = array($total_qty_mp, $validated['insurances'][$key], $validated['indirects_costs'][$key],
                    $validated['adjustments'][$key], $validated['taxes'][$key]);
                $total_cost = array_sum($costs);
                $abc->abc_items()->create([
                    'item_no' => $key + 1,
                    'item' => $validated['items'][$key],
                    'unit' => $validated['units'][$key],
                    'qty' => $validated['qtys'][$key],
                    'tax' => $validated['taxes'][$key],
                    'market_price' => $validated['prices'][$key],
                    'insurance' => $validated['insurances'][$key],
                    'indirect_cost' => $validated['indirects_costs'][$key],
                    'valuation_adjustment' => $validated['adjustments'][$key],
                    'total_cost' => $total_cost,
                    'unit_cost' => $validated['prices'][$key],
                ]);
            } else {
                $total_qty_mp = $validated['prices'][$key] * $validated['qtys'][$key];
                $costs = array($total_qty_mp, $validated['insurances'][$key], $validated['indirects_costs'][$key],
                    $validated['adjustments'][$key], $validated['taxes'][$key]);
                $total_cost = array_sum($costs);
                $abc->abc_items()
                    ->where('id', $abc_items)
                    ->update([
                        'item_no' => $key + 1,
                        'item' => $validated['items'][$key],
                        'unit' => $validated['units'][$key],
                        'qty' => $validated['qtys'][$key],
                        'tax' => $validated['taxes'][$key],
                        'market_price' => $validated['prices'][$key],
                        'insurance' => $validated['insurances'][$key],
                        'indirect_cost' => $validated['indirects_costs'][$key],
                        'valuation_adjustment' => $validated['adjustments'][$key],
                        'total_cost' => $total_cost,
                        'unit_cost' => $validated['prices'][$key],
                    ]);
            }
        }
        return back()->withSuccess('ABC has been updated.');
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
