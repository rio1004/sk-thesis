@extends('layouts.app')
@section('page-name')
    Purchase Request
@endsection
@section('content')
<form action="{{route('abstract-canvass.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Purchase Request</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('abstract-canvass.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Project Name</label>
                        <input type="text" class="form-control " id="block-form1-username" name="project_name" value="{{old('project_name')}}" placeholder="Enter Project Name ">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="example-select">Supplier-One:</label>
                        <div class="input-group">
                            <select class="form-control" id="example-select" name="first_supplier">
                                <option value="">Please select</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text custom-control custom-radio custom-control-success ">
                                    <input type="radio" class="custom-control-input" id="example-rd-custom-success-lg1" name="radios5" checked="" value="1">
                                    <label class="custom-control-label" for="example-rd-custom-success-lg1">Choose this Supplier</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-select">Supplier-Two:</label>
                        <div class="input-group">
                            <select class="form-control" id="example-select" name="second_supplier">
                                <option value="">Please select</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text custom-control custom-radio custom-control-success ">
                                    <input type="radio" class="custom-control-input" id="example-rd-custom-success-lg2" name="radios5" checked="" value="2">
                                    <label class="custom-control-label" for="example-rd-custom-success-lg2">Choose this Supplier</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="example-select">Supplier-Three:</label>
                        <div class="input-group">
                            <select class="form-control" id="example-select" name="third_supplier">
                                <option value="">Please select</option>
                                @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text custom-control custom-radio custom-control-success ">
                                    <input type="radio" class="custom-control-input" id="example-rd-custom-success-lg3" name="radios5" checked="" value="3">
                                    <label class="custom-control-label" for="example-rd-custom-success-lg3">Choose this Supplier</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Purchase Request Item</h3>
        </div>
        <div class="block-content" data-item-container>
            <div class="block-header">
                <button class="btn btn-sm btn-alt-warning" type="button" data-add-item>
                   <span>
                        <i class="far fa-plus-square"></i>
                    </span>
                    Add new Item
                </button>
            </div>
            <div class="row justify-content-left" data-parent>
                <div class="form-group col-md-2 ">
                    <label for="block-form1-username">Items</label>
                    <input type="text" class="form-control" id="block-form1-username" name="items[]" value="{{old('items.0')}}" placeholder="Enter Item Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Unit</label>
                    <input type="text" class="form-control" id="block-form1-username" name="units[]" value="{{old('units.0')}}" placeholder="Enter Unit Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Supplier-One</label>
                    <input type="number" class="form-control" id="block-form1-username" name="f_suppliers[]" value="{{old('amount.0')}}" placeholder="Enter Amount">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Supplier-two</label>
                    <input type="number" class="form-control" id="block-form1-username" name="s_suppliers[]" value="{{old('amount.0')}}" placeholder="Enter Amount">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Supplier-three</label>
                    <input type="number" class="form-control" id="block-form1-username" name="t_suppliers[]" value="{{old('amount.0')}}" placeholder="Enter Amount">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Quantity</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="block-form1-username" name="qtys[]" value="{{old('qtys.0')}}" placeholder="Enter quantity">
                        <div class="input-group-appen d-none" data-item-hide="">
                            <button type="button" class="btn btn-danger " data-remove-item>
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group pl-5 pb-3">
            <button type="submit" class="btn btn-sm btn-primary">
                Submit
            </button>
            <button type="reset" class="btn btn-sm btn-alt-primary">
                Reset
            </button>
        </div>
    </div>

</form>
@endsection
