<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest\StoreRequest;
use App\Http\Requests\PurchaseRequest\UpdateRequest;
use App\Models\Official;
use App\Models\PurchaseRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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

    public function filterBy(Request $req)
    {
        if($req->filterBy == 'week'){
            $week_start = Carbon::now()->startOfWeek();
            $week_end = Carbon::now()->endOfWeek();
            $purchaseRequests = PurchaseRequest::whereBetween('pr_date', [$week_start, $week_end])->get();
            return view('pages.PurchaseRequest.index', compact('purchaseRequests'));
        }
        elseif($req->filterBy == 'month'){
            $purchaseRequests = PurchaseRequest::whereYear('pr_date', Carbon::now()->year)
            ->whereMonth('pr_date', Carbon::now()->month)->get();
            return view('pages.PurchaseRequest.index', compact('purchaseRequests'));
        }
        else{
            $purchaseRequests = PurchaseRequest::whereYear('pr_date', Carbon::now()->year)
            ->whereMonth('pr_date', Carbon::now()->month)->get();
            return view('pages.PurchaseRequest.index', compact('purchaseRequests'));
        }
        // Return the filtered requests
    }
    public function clear(){
        $this->index();
    }
    public function search(Request $req){
        $purchaseRequests =PurchaseRequest::where('pr_no', 'like' ,  "%{$req->searchTerm}%")?->get();
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
                'estimated_amount' =>  $validated['unitCosts'][$key] * $validated['qtys'][$key],
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
        $officials = Official::get();
        return view('pages.PurchaseRequest.edit', compact('officials', 'purchaseRequest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, PurchaseRequest $purchaseRequest)
    {
        $validated = $request->validated();
        $purchaseRequest->update(Arr::only($validated, ['pr_no', 'pr_date', 'purpose', 'requested_by_id']));
        // get the existing items
        $prItems = $purchaseRequest->purchaseRequestItem()->pluck('id');
        $deletedIds = $prItems->diff($validated['prItemId'])->toArray();
        if ($deletedIds) {
            $purchaseRequest->purchaseRequestItem()->whereIn('id', $deletedIds)->delete();
        }
        foreach ($validated['prItemId'] as $key => $prItem) {
            if (!$prItem) {
                $purchaseRequest->purchaseRequestItem()->create([
                    'item_no' => $key + 1,
                    'item' => $validated['items'][$key],
                    'unit' => $validated['units'][$key],
                    'estimated_unit_cost' => $validated['unitCosts'][$key],
                    'qty' => $validated['qtys'][$key],
                    'estimated_amount' => $validated['qtys'][$key] * $validated['unitCosts'][$key],
                ]);
            } else {
                $purchaseRequest->purchaseRequestItem()
                    ->where('id', $prItem)
                    ->update([
                        'item_no' => $key + 1,
                        'item' => $validated['items'][$key],
                        'unit' => $validated['units'][$key],
                        'estimated_unit_cost' => $validated['unitCosts'][$key],
                        'qty' => $validated['qtys'][$key],
                        'estimated_amount' => $validated['qtys'][$key] * $validated['unitCosts'][$key],
                    ]);
            }
        }
        return back()->with('success-message','Purchase request has been updated.');
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
