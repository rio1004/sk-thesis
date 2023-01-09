@extends('layouts.app')
@section('page-name')
    Notice of Award
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">Notice of Award</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('notice-of-award.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Notice of Award
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                            <th>Project Name</th>
                            <th>NOA Date.</th>
                            <th>NOA Approved Price</th>
                            <th>Bid Date</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($noas as $noa)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$noa->canvass->project_name}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$noa->noa_date->format('M. d, Y')}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$noa->noa_approved_price}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$noa->bid_date->format('M. d, Y')}}
                        </td>
                        <td class="text-center">
                          
                            
                            @livewire('pages.noa', ['noa' => $noa], key($noa->id))
                          
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
