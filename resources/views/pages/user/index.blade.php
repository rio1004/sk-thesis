@extends('layouts.app')
@section('page-name')
    User
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Users</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary">
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
                        <th style="width: 30%;">Email</th>
                        <th style="width: 30%;">Barangay</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="font-w600 font-size-sm">
                            <a href="be_pages_generic_profile.html">Megan Fuller</a>
                        </td>
                        <td class="font-size-sm">client1<em class="text-muted">@example.com</em></td>
                        <td>
                            <span class="badge badge-primary">Personal</span>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-alt-success" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-alt-danger" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
