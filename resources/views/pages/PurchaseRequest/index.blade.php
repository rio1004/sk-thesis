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
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>PR No.</th>
                        <th>Requested by</th>
                        <th>Total Amount</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($purchaseRequests as $purchaseRequest)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$purchaseRequest->pr_date}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{$purchaseRequest->pr_no}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$purchaseRequest->requestedBy->full_name}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            Php. {{ number_format($purchaseRequest->total_amount, 2) }}
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
