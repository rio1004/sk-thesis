@extends('layouts.app')
@section('page-name')
    Purchase Request
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Purchase Request</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('purchase-request.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Purchase Request
            </a>
        </div>
    </div>
    <div class="block-content block-content-full">
        <div class="row  py-2">
            <form action="{{route('purchase-request.filter')}}" method="POST">
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
                    <form action="{{route('purchase-request.search')}}" method="POST">
                        @csrf
                        <input type="text" name="searchTerm" class="form-control" placeholder="Please search by PR Number">
                        <button type="submit" class="btn btn-sm btn-alt-success mx-2">
                            <i class="fa fa-search"></i> Search
                        </button>
                    </form>
                    <a href="{{route('purchase-request.clear')}}" class="btn btn-sm btn-alt-info mx-2">
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
                        <th>PR No.</th>
                        <th>Requested by</th>
                        <th>Total Amount</th>
                        <th>Admin Approval</th>
                        <th>SK Approval</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchaseRequests as $purchaseRequest)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$purchaseRequest->pr_date->format('Y-m-D')}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{$purchaseRequest->pr_no}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$purchaseRequest->requestedBy->full_name}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            Php. {{ number_format($purchaseRequest->estimated_amount, 2) }}
                        </td>
                        <td class="font-w600 font-size-sm">
                            @if ($purchaseRequest->admin_approved ==1)
                                <span class="badge badge-success">Approved</span>
                            @elseif($purchaseRequest->admin_approved == 0)
                                <span class="badge badge-warning"> Under Approval </span>
                            @else
                                <span class="badge badge-danger"> Not Approved </span>
                            @endif
                        </td>
                        <td class="font-w600 font-size-sm">
                            @if ($purchaseRequest->status ==1)
                                <span class="badge badge-success">Approved</span>
                            @elseif($purchaseRequest->status == 0)
                                <span class="badge badge-warning"> Under Approval </span>
                            @else
                                <span class="badge badge-danger"> Not Approved </span>
                            @endif
                        </td>
                        <td class="text-center">
                            @livewire('pages.purchase-request', ['purchaseRequest' => $purchaseRequest], key($purchaseRequest->id))
                        </td>
                    </tr>
                    @empty
                        <td class="font-size-sm" colspan="7">No User Available</td>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection


