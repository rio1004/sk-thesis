@extends('layouts.app')
@section('page-name')
    Dashboard
@endsection
@section('content')
<div class="row">
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
        <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Budget Remaining</div>
                <div class="font-size-h2 font-w400 text-dark">{{ number_format($budget?->remaining_budget, 2) }}</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
        <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total Purchase Request</div>
                <div class="font-size-h2 font-w400 text-dark">{{$pr}}</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
        <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Release Vouchers</div>
                <div class="font-size-h2 font-w400 text-dark">{{$dv}}</div>
            </div>
        </a>
    </div>
    <div class="col-6 col-md-3 col-lg-6 col-xl-3">
        <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
            <div class="block-content block-content-full">
                <div class="font-size-sm font-w600 text-uppercase text-muted">Total Purchase Orders</div>
                <div class="font-size-h2 font-w400 text-dark">{{$po}}</div>
            </div>
        </a>
    </div>
</div>
<div class="block block-rounded">
    <div class="block-header block-header-default">
        <h2 class="block-title">Announcements</h2>
    </div>
    <div class="row justify-content-center py-sm-3 py-md-5" >
        @forelse ( $announcements as $paper )
            @livewire('paper', ['paper' => $paper], key($paper->id))
        @empty
        @endforelse

    </div>
</div>

@endsection
