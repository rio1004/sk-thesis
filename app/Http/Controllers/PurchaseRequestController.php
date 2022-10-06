<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest\StoreRequest;
use App\Models\Official;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;

class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseRequests = PurchaseRequest::get();
        return view('pages.PurchaseRequest.index', compact('purchaseRequests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $officials = Official::get();
        return view('pages.PurchaseRequest.create', compact('officials'));

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
        $totalSum = 0;
        foreach ($validated['qtys'] as $key => $qty) {
            $totalSum += ($qty * $validated['unitCosts'][$key]);
        }

        $pr = PurchaseRequest::create([
            'requested_by_id' => $validated['requested_by_id'],
            'purpose' => $validated['purpose'],
            'pr_no' => $validated['pr_no'],
            'pr_date' => $validated['pr_date'],
            'total_amount' => $totalSum
        ]);

        foreach ($validated['items'] as $key => $item) {
            $pr->purchaseRequestItem()->create([
                'item_no' => $key + 1,
                'item' => $validated['items'][$key],
                'unit' => $validated['units'][$key],
                'estimated_unit_cost' => $validated['unitCosts'][$key],
                'qty' => $validated['qtys'][$key],
            ]);
        }

        return redirect()->back()->with('success-message', 'Purchase Request has been Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseRequest $purchaseRequest)
    {
        //
    }
}
