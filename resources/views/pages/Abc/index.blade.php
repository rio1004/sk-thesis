@extends('layouts.app')
@section('page-name')
    Approved budget for Contract
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Approved budget for Contract</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('abc.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Approved budget for Contract
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Procurement Title</th>
                        <th>Prepared By</th>
                        <th>Approved By</th>
                        <th>Recommending Approval</th>
                        <th>Approved Bidder</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($abcs as $abc)
                    <tr>
                        <td>{{ $abc->procurement_title }}</td>
                        <td>{{ $abc->submittedBy->full_name }}</td>
                        <td>{{ $abc->approvedBy->full_name }}</td>
                        <td>{{ $abc->recommendedBy->full_name }}</td>
                        <td>{{ $abc->bidder }}</td>
                        <td class="text-center">
                            @livewire('abc.abc', ['abc' => $abc], key($abc->id))
                        </td>
                    </tr>
                    @empty
                        <td class="font-size-sm" colspan="7">No Data Available</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
