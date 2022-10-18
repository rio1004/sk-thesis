@extends('layouts.app')
@section('page-name')
    Supplier
@endsection
@section('content')
<div class="block block-rounded">
    <div class="block-header">
        <h3 class="block-title">List of Supplier</h3>
        <div class="block-options">
            <a type="button" class="btn btn-sm btn-alt-primary" href="{{route('suppliers.create')}}">
                <i class="fa fa-user-plus mr-1"></i> Add Supplier
            </a>
        </div>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Contact No.</th>
                        <th>Address</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                    <tr>
                        <td class="font-w600 font-size-sm">
                          {{$supplier->supplier_name}}
                        </td>
                        <td class="font-w600 font-size-sm">
                            {{$supplier->contact_no}}
                        </td>
                        <td class="font-w600 font-size-sm">
                           {{$supplier->address}}
                        </td>
                        <td class="text-center">
                            @livewire('pages.supplier', ['supplier' => $supplier], key($supplier->id))
                        </td>
                    </tr>
                    @empty
                        <td class="font-size-sm" colspan="7">No Supplier Available</td>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
