<?php

namespace App\Http\Controllers;

use App\Models\RequestQoutation;
use App\Models\Supplier;
use App\Models\Official;
use App\Http\Requests\RequestQoutation\StoreRequest;
use App\Http\Requests\RequestQoutation\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class RequestQoutationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qouatations = RequestQoutation::get();
        return view('pages.RequestQoutation.index',compact('qouatations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::get();
        $officials = Official::get();
        return view('pages.RequestQoutation.create', compact('suppliers', 'officials'));
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
        $validated = $request->validated();
        $qoutation = RequestQoutation::create([
            'qoutation_no' => $validated['qoutation_no'],
            'date' => $validated['date'],
            'procurement_ofcr_id' => $validated['procurement_ofcr_id'],
            'supplier_id' => $validated['supplier_id'],
        ]);

        foreach($validated['items'] as $key => $value){
            $qoutation->request_items()->create([
                'item' => $validated['items'][$key],
                'unit' => $validated['units'][$key],
                'qty' => $validated['qtys'][$key],
            ]);
        }

        return redirect()->route('qoutation.index')->withSuccess('Request for Qoutation has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestQoutation  $requestQoutation
     * @return \Illuminate\Http\Response
     */
    public function show(RequestQoutation $requestQoutation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestQoutation  $requestQoutation
     * @return \Illuminate\Http\Response
     */
    public function edit(RequestQoutation $qoutation)
    {
        $suppliers = Supplier::get();
        $officials = Official::get();
        return view('pages.RequestQoutation.edit', compact('suppliers', 'officials', 'qoutation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestQoutation  $requestQoutation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, RequestQoutation $requestQoutation)
    {
        $validated = $request->validated();

        $requestQoutation->update(Arr::only($validated, ['qoutation_no','date', 'supplier_id','procurement_ofcr_id']));
        // get the existing items
        $qoutations = $requestQoutation->request_items()->pluck('id');
        $deletedIds = $qoutations->diff($validated['rqId'])->toArray();
        if ($deletedIds) {
            $requestQoutation->request_items()->whereIn('id', $deletedIds)->delete();
        }
        foreach ($validated['rqId'] as $key => $qoutation_item) {
            if (!$qoutation_item) {
                $requestQoutation->request_items()->create([
                    'item' => $validated['items'][$key],
                    'unit' => $validated['units'][$key],
                    'qty' => $validated['qtys'][$key],
                ]);
            } else {
                $requestQoutation->request_items()
                    ->where('id', $qoutation_item)
                    ->update([
                        'item' => $validated['items'][$key],
                        'unit' => $validated['units'][$key],
                        'qty' => $validated['qtys'][$key],
                    ]);
            }
        }
        return back()->withSuccess('Request for Qoutation has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestQoutation  $requestQoutation
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $delete = RequestQoutation::findOrFail($id);
        $delete->delete();
        return response()->json(['status'=> 'Successfully Deleted.']);
    }
}
