@extends('layouts.app')
@section('page-name')
    Officials
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Officials</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('official.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Official
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Position</th>
                        <th>Other Position</th>
                        {{-- <th>Barangay</th> --}}
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($officials as $official)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$official->full_name}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{$official->age}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$official->gender}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$official->position}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$official->other_position}}
                        </td>
                        <td class="text-center">
                            @livewire('official.official', ['official' => $official], key($official->id))
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
