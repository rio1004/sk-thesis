@extends('layouts.app')
@section('page-name')
    Dashboard
@endsection
@section('content')
@role('admin')

<div class="row">

    <div class="col">
        <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Budget Remaining</div>
                <div class="font-size-h2 font-w400 text-dark">{{ number_format($budget?->remaining_budget, 2) }}</div>
            </div>
        </a>
    </div>
    <div class="col">
        <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total Purchase Request</div>
                <div class="font-size-h2 font-w400 text-dark">{{$pr}}</div>
            </div>
        </a>
    </div>
    <div class="col">
        <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Release Vouchers</div>
                <div class="font-size-h2 font-w400 text-dark">{{$dv}}</div>
            </div>
        </a>
    </div>
    <div class="col">
        <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total Purchase Orders</div>
                <div class="font-size-h2 font-w400 text-dark">{{$po}}</div>
            </div>
        </a>
    </div>
</div>
@livewire('paper')
@endrole
@role('super-admin')
@livewire('admin-dashboard');
@endrole

@endsection
