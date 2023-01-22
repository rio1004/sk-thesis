@extends('layouts.app')
@section('page-name')
    Abstract of Canvass
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Canvasses</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('canvass.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Abstract of Canvass
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($canvasses as $canvass)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$canvass->project_name}}
                        </td>
                        <td class="text-center">
                            @livewire('pages.canvass', ['canvass' => $canvass], key($canvass->id))
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
