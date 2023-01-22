@extends('layouts.app')
@section('page-name')
    Abstract of Canvass
@endsection
@section('content')
<form action="{{route('canvass.update', [$canvass])}}" method="POST">
    @csrf
    @method('PUT')
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Abstract of Canvass</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('canvass.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Project Name</label>
                        <input type="text" class="form-control " id="block-form1-username" name="project_name" value="{{$canvass->project_name}}" placeholder="Enter Project Name ">
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
                                    <option value="{{ $supplier->id }}" @selected($f_supplier->id   == $supplier->id)>{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text custom-control custom-radio custom-control-success ">
                                    <input type="radio" class="custom-control-input" id="example-rd-custom-success-lg1" name="radios5" value="1"  {{$f1_supplier->status == 1 ? 'checked="checked"' : ''}}>
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
                                    <option value="{{ $supplier->id }}" @selected($s_supplier->id   == $supplier->id)>{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text custom-control custom-radio custom-control-success ">
                                    <input type="radio" class="custom-control-input" id="example-rd-custom-success-lg2" name="radios5" value="2" {{$s2_supplier?->status == 1 ? 'checked="checked"' : ''}}>
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
                                    <option value="{{ $supplier->id }}" @selected($t_supplier->id == $supplier->id)>{{ $supplier->supplier_name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <div class="input-group-text custom-control custom-radio custom-control-success ">
                                    <input type="radio" class="custom-control-input" id="example-rd-custom-success-lg3" name="radios5" value="3" {{$t3_supplier->status == 1 ? 'checked="checked"' : ''}}>
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
            @foreach ($canvass->canvass_items as $canvass_item)
            <div class="row" {{ $loop->first ? 'data-parent' : '' }}>
                <input type="hidden" name="canvassItemId[]" value="{{ $canvass_item->id }}">
                <div class="form-group col-md-2">
                    <label>Select item:</label>
                    <input type="text" class="form-control" id="block-form1-username" name="items[]" value="{{$canvass_item->item}}" placeholder="Enter Item Name">
                </div>
                <div class="form-group col-md-2">
                    <label>Select unit:</label>
                    <input type="text" class="form-control" id="block-form1-username" name="units[]" value="{{$canvass_item->unit}}" placeholder="Enter Unit Name">
                </div>
                <div class="form-group col-md-2">
                    <label>First Supplier:</label>
                    <input type="number" class="form-control " placeholder="Enter Amount for the first Supplier" name="f_suppliers[]" value="{{ $canvass_item->canvass_suppliers->where('type',1)->first()->amount }}"/>
                </div>
                <div class="form-group col-md-2">
                    <label>Second Supplier:</label>
                    <input type="number" class="form-control" placeholder="Enter Amount for the first Supplier" name="s_suppliers[]" value="{{ $canvass_item->canvass_suppliers->where('type',2)->first()->amount }}"/>
                </div>
                <div class="form-group col-md-2">
                    <label>Third Supplier:</label>
                    <input type="number" class="form-control" placeholder="Enter Amount for the first Supplier" name="t_suppliers[]" value="{{ $canvass_item->canvass_suppliers->where('type',3)->first()->amount }}"/>
                </div>
                <div class="form-group col-md-2">
                    <label>Qty:</label>
                    <div class="input-group">
                        <input type="number" name="qtys[]" class="form-control" placeholder="Enter quantity" value="{{ $canvass_item->qty }}">
                        <div class="input-group-append {{ $loop->first ? 'd-none' :'' }}" data-item-hide>
                            <button class="btn btn-danger" type="button" data-remove-item>
                                <span class="far fa-trash-alt"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
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
