@extends('layouts.app')
@section('page-name')
    Purchase Order
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Purchase Orders</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('purchase-order.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Purchase Orders
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>PO No.</th>
                        <th>Supplier</th>
                        <th>Total Amount</th>
                        <th>Mode of Procurement</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>

                @forelse($purchaseOrders as $purchaseOrder)
                    <tr>
                        <td>{{ $purchaseOrder->po_date->format('M. d, Y') }}</td>
                        <td>{{ $purchaseOrder->po_no }}</td>
                        <td>{{ $purchaseOrder->supplier->supplier_name }}</td>
                        <td>Php. {{ number_format($purchaseOrder->total_amount, 2) }}</td>
                        <td>{{ $purchaseOrder->mode_of_procurement }}</td>
                        <td>
                            @livewire('pages.purchase-order', ['purchaseOrder' => $purchaseOrder], key($purchaseOrder->id))
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="text-center" colspan="7">No data</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
