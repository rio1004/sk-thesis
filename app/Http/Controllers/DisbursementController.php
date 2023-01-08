<?php

namespace App\Http\Controllers;

use App\Http\Requests\DV\StoreRequest;
use App\Http\Requests\DV\UpdateRequest;
use App\Models\Disbursement;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DisbursementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dibursements = Disbursement::get();
        return view('pages.DisbursementVoucher.index', compact('dibursements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Supplier::get();
        return view('pages.DisbursementVoucher.create', compact('suppliers'));
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

        // total particular amount
        $totalAmount = 0;
        foreach ($validated['particular_amount'] as $item) {
            $totalAmount += floatval($item);
        }

        $disbursemment = Disbursement::updateOrCreate([
            'dv_no' => $validated['dv_no']
        ], [
            'dv_date' => $validated['dv_date'],
            'payee_id' => $validated['payee_id'],
            'check_no' => $validated['check_no'],
            'check_date' => $validated['check_date'],
            'bank_name' => $validated['bank_name'],
            'bank_branch' => $validated['bank_branch'],
            'or_no' => $validated['or_no'],
            'or_date' => $validated['or_date'],
            'particular_text' => $validated['particular_text'],
            'total_amount' => $totalAmount,
        ]);

        // store particular items
        foreach ($validated['particular_item'] as $key => $item) {
            $disbursemment->disbursementItem()->create([
                'particular_item' => $item,
                'particular_amount' => floatval($validated['particular_amount'][$key])
            ]);
        }

        // store skcc data
        $skcc = $disbursemment->skcc()->create([
            'skcc_no' => $validated['skcc_no'],
            'skcc_date' => $validated['skcc_date'],
            'to_name' => $validated['to_name'],
            'to_company' => $validated['to_company'],
            'to_address' => $validated['to_address'],
        ]);

        // store skcc items
        foreach ($validated['acct_no'] as $key => $item) {
            $skcc->skccItem()->create([
                'account_no' => $item,
                'check_no' => $validated['acct_check_no'][$key],
                'date' => $validated['acct_check_date'][$key],
                'payee_name' => $validated['payee'][$key],
                'amount' => $validated['amount'][$key],
                'purpose' => $validated['purpose'][$key],
            ]);
        }
        return back()->with('success-message','Disbursement voucher has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disbursement  $dibursement
     * @return \Illuminate\Http\Response
     */
    public function show(Disbursement $dibursement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disbursement  $dibursement
     * @return \Illuminate\Http\Response
     */
    public function edit(Disbursement $dibursement)
    {
        $suppliers = Supplier::get();
        return view('pages.DisbursementVoucher.edit', compact('suppliers','dibursement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disbursement  $dibursement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Disbursement $dibursement)
    {
        $validated=$request->validated();
        $totalAmount = 0;
        foreach ($validated['particular_amount'] as $item) {
            $totalAmount += floatval($item);
        }
        $dibursement->update(Arr::only($validated,['dv_no','dv_date','payee_id','check_no','check_date','bank_name','bank_branch','or_no', 'or_date', 'particular_text']));
        $dibursement->update([
            'total_amount' => $totalAmount
        ]);
        // get the existing items
        $disbursementItems = $dibursement->disbursementItem()->pluck('id');
        $deletedDisbursementIds = $disbursementItems->diff($validated['particularId'])->toArray();
        if ($deletedDisbursementIds) {
            $dibursement->disbursementItem()->whereIn('id', $deletedDisbursementIds)->delete();
        }
        foreach ($validated['particularId'] as $key => $prItem) {
            if (!$prItem) {
                $dibursement->disbursementItem()->create([
                    'particular_item' => $validated['particular_item'][$key],
                    'particular_amount' => floatval($validated['particular_amount'][$key])
                ]);
            } else {
                $dibursement->disbursementItem()
                    ->where('id', $prItem)
                    ->update([
                        'particular_item' => $validated['particular_item'][$key],
                        'particular_amount' => floatval($validated['particular_amount'][$key])
                    ]);
            }
        }

        $dibursement->skcc()->update(Arr::only($validated, ['skcc_no', 'skcc_date', 'to_name', 'to_company', 'to_address']));
        $skccItems = $dibursement->skcc->skccItem()->pluck('id');
        $deletedSkccId = $skccItems->diff($validated['skccItemId'])->toArray();
        if ($deletedSkccId) {
            $dibursement->skcc->skccItem()->whereIn('id', $deletedSkccId)->delete();
        }
        foreach ($validated['skccItemId'] as $key => $prItem) {
            if (!$prItem) {
                $dibursement->skcc->skccItem()->create([
                    'account_no' => $validated['acct_no'][$key],
                    'check_no' => $validated['acct_check_no'][$key],
                    'date' => $validated['acct_check_date'][$key],
                    'payee_name' => $validated['payee'][$key],
                    'amount' => $validated['amount'][$key],
                    'purpose' => $validated['purpose'][$key],
                ]);
            } else {
                $dibursement->skcc->skccItem()
                    ->where('id', $prItem)
                    ->update([
                        'account_no' => $validated['acct_no'][$key],
                        'check_no' => $validated['acct_check_no'][$key],
                        'date' => $validated['acct_check_date'][$key],
                        'payee_name' => $validated['payee'][$key],
                        'amount' => $validated['amount'][$key],
                        'purpose' => $validated['purpose'][$key],
                    ]);
            }
        }
        return back()->withSuccess('Purchase request has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disbursement  $dibursement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disbursement $dibursement)
    {
        //
    }
}
