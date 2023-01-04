@extends('layouts.app')
@section('page-name')
Announcement
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">Announcement</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('announcement.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Announcement
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Announcement Title</th>
                        <th>What</th>
                        <th>Where</th>
                        <th>When</th>
                        <th>Details</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($announcements as $announcement)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$announcement->title}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$announcement->what}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$announcement->where}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$announcement->when}}
                        </td>
                        <td class="font-w600 font-size-sm">
                          {{$announcement->details}}
                        </td>
                        <td class="text-center">
                            @livewire('pages.announcement', ['announcement' => $announcement], key($announcement->id))
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
