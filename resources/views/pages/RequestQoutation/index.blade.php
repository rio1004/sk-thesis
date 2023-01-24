@extends('layouts.app')
@section('page-name')
    Request for Qoutation
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Request For Qoutation</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('qoutation.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Request For Qoutation
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Qoutation No.</th>
                        <th>Qoutation Date</th>
                        <th>Supplier</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($qouatations as $qoutation)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$qoutation->qoutation_no}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{$qoutation->date}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$qoutation?->supplier?->supplier_name}}
                        </td>
                        <td class="text-center">
                            @livewire('pages.request-qoutation', ['qoutation' => $qoutation], key($qoutation->id))
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
