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
        <div class="row  py-2">
            <form action="{{route('purchase-order.filter')}}" method="POST">
                @csrf
            <div class="col">
                <div class="form-inline">
                    <select name="filterBy" class="form-control" required>
                        <option value="">-- Please select --</option>
                        <option value="week">Weekly</option>
                        <option value="month">Monthly</option>
                        <option value="year">Yearly</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-alt-primary mx-2">
                        <i class="fa fa-filter"></i> Filter
                    </button>
                </div>
            </div>
            </form>
            <div class="col">
                <div class="form-inline">
                    <form action="{{route('purchase-order.search')}}" method="POST">
                        @csrf
                        <input type="text" name="searchTerm" class="form-control" placeholder="Please search by PO Number">
                        <button type="submit" class="btn btn-sm btn-alt-success mx-2">
                            <i class="fa fa-search"></i> Search
                        </button>
                    </form>
                    <a href="{{route('purchase-order.clear')}}" class="btn btn-sm btn-alt-info mx-2">
                        Clear
                    </a>
                </div>
            </div>

        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>PO No.</th>
                        <th>Supplier</th>
                        <th>Total Amount</th>
                        <th>Admin Approval</th>
                        <th>SK Approval</th>
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
                        <td class="font-w600 font-size-sm">
                            @if ($purchaseOrder->admin_approved ==1)
                                <span class="badge badge-success">Approved</span>
                            @elseif($purchaseOrder->admin_approved == 0)
                                <span class="badge badge-warning"> Under Approval </span>
                            @else
                                <span class="badge badge-danger"> Not Approved </span>
                            @endif
                        </td>
                        <td class="font-w600 font-size-sm">
                            @if ($purchaseOrder->status ==1)
                                <span class="badge badge-success">Approved</span>
                            @elseif($purchaseOrder->status == 0)
                                <span class="badge badge-warning"> Under Approval </span>
                            @else
                                <span class="badge badge-danger"> Not Approved </span>
                            @endif
                        </td>
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
