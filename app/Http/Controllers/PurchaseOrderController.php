<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseOrder\StoreRequest;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseOrders = PurchaseOrder::get();
        return view('pages.PurchaseOrder.index', compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::get();
        return view('pages.PurchaseOrder.create', compact('suppliers'));
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
            if (isset($validated['unitCosts'])) {
                $totalSum += ($qty * $validated['unitCosts'][$key]);
            }
        }

        $po = PurchaseOrder::create([
            // 'app_id' => auth()->user()->app_id,
            // 'pr_id' => $validated['pr_id'] ?? null,
            'po_no' => $validated['po_no'],
            'po_date' => $validated['po_date'],
            'mode_of_procurement' => $validated['mode_of_procurement'],
            'supplier_id' => $validated['supplier_id'],
            'place_of_delivery' => $validated['place_of_delivery'],
            'date_of_delivery' => $validated['date_of_delivery'],
            'delivery_term' => $validated['delivery_term'],
            'payment_term' => $validated['payment_term'],
            'total_amount' => $totalSum
        ]);

        foreach ($validated['items'] as $key => $item) {
            if ($item && $validated['units'][$key]) {
                $po->purchaseOrderItem()->create([
                    'item_no' => $key + 1,
                    'item' => $item,
                    'unit' => $validated['units'][$key],
                    'unit_price' => $validated['unitCosts'][$key],
                    'amount' => $validated['unitCosts'][$key] * $validated['qtys'][$key],
                    'qty' => $validated['qtys'][$key],
                ]);
            }
        }
        return redirect()->back()->with('success-message', 'Purchase Order has been Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseOrder  $purchaseOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseOrder $purchaseOrder)
    {
        //
    }
}
