@extends('layouts.app')
@section('page-name')
    Supplier
@endsection
@section('content')
<form action="{{route('suppliers.update', [$supplier])}}" method="POST">
    @csrf
    @method('PUT')
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Supplier</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('suppliers.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Supplier Name</label>
                        <input type="text" class="form-control " id="block-form1-username" name="supplier_name" value="{{$supplier->supplier_name}}" placeholder="Enter Supplier Name">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Contact No.</label>
                        <input type="text" class="form-control " id="block-form1-username" name="contact_no" value="{{$supplier->contact_no}}" placeholder="Enter Contact No.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Address</label>
                        <input type="text" class="form-control " id="block-form1-username" name="address" value="{{$supplier->address}}" placeholder="Enter Address">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Submit
                        </button>
                        <button type="reset" class="btn btn-sm btn-alt-primary">
                            Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>
@endsection
