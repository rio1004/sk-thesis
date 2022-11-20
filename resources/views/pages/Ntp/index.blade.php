@extends('layouts.app')
@section('page-name')
Notice To Proceed
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Notice To Proceed</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('notice-to-proceed.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Notice To Proceed
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>NTP Date</th>
                        <th>Project Location</th>
                        <th>NTP Effectivity Date</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ntps as $ntp)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$ntp->canvass->project_name}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$ntp->ntp_date}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$ntp->project_location}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$ntp->ntp_effectivity_date}}
                        </td>
                        <td class="text-center">
                            @livewire('pages.ntp', ['ntp' => $ntp], key($ntp->id))
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
