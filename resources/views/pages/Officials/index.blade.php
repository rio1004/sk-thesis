@extends('layouts.app')
@section('page-name')
    Officials
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Users</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('user.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add User
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
                        <th>Email</th>
                        <th>Default Password</th>
                        <th>Barangay</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$user->full_name}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{$user->age}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$user->gender}}
                        </td>
                        <td class="font-size-sm">{{$user->email}}</td>
                        <td class="font-size-sm">{{$user->default_password}}</td>
                        <td>
                            <span class="badge badge-primary">{{$user->brgy}}</span>
                        </td>
                        <td class="text-center">
                            @livewire('user.user', ['user' => $user], key($user->id))
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
