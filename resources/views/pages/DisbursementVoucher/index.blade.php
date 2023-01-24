@extends('layouts.app')
@section('page-name')
    Disbursement Voucher
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Disbursement Voucher</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('dibursement.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Disbursement Voucher
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>DV No.</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Check No.</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @forelse($dibursements as $disbursement)
                    <tr>
                        <td>{{ $disbursement->dv_no }}</td>
                        <td>{{ $disbursement->dv_date->format('M. d, Y') }}</td>
                        <td>{{ $disbursement?->supplier?->supplier_name }}</td>
                        <td>{{ $disbursement->check_no }}</td>
                        <td>Php. {{ number_format($disbursement->total_amount, 2) }}</td>
                        <td>{{ $disbursement->status }}</td>
                        <td>
                            @livewire('pages.disbursement', ['disbursement' => $disbursement], key($disbursement->id))
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
