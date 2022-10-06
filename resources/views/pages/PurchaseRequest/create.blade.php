@extends('layouts.app')
@section('page-name')
    Purchase Request
@endsection
@section('content')
<form action="{{route('official.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Purchase Request</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('official.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Purchase Request No.</label>
                        <input type="text" class="form-control " id="block-form1-username" name="pr_no" value="{{old('pr_no')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Date</label>
                        <input type="date" class="form-control " id="block-form1-username" name="pr_date" value="{{old('pr_date')}}">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Purpose</label>
                        <input type="text" class="form-control " id="block-form1-username" name="purpose" value="{{old('purpose')}}" placeholder="Enter purpose">
                    </div>
                    <div class="form-group">
                        <label for="example-select">Requested By:</label>
                        <select class="form-control" id="example-select" name="requested_by_id">
                            <option value="">Please select</option>
                            @foreach($officials as $official)
                                <option value="{{ $official->id }}">{{ $official->full_name }}</option>
                            @endforeach
                        </select>
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
                        <i class="far fa-trash-alt"></i>
                    </span>
                    Add new Item
                </button>
            </div>
            <div class="row justify-content-left" data-parent>
                <div class="form-group col-md-3 ml-4">
                    <label for="block-form1-username">Items</label>
                    <input type="text" class="form-control" id="block-form1-username" name="items[]" value="{{old('items.0')}}" placeholder="Enter Item Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Unit</label>
                    <input type="date" class="form-control" id="block-form1-username" name="units[]" value="{{old('units.0')}}" placeholder="Enter Unit Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Quantity</label>
                    <input type="text" class="form-control" id="block-form1-username" name="qtys[]" value="{{old('qtys.0')}}" placeholder="Enter quantity">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Unit Cost</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="block-form1-username" name="unitCosts[]" value="{{old('unitCosts.0')}}" placeholder="Enter unit cost">
                        <div class="input-group-append d-none" data-item-hide>
                            <button type="button" class="btn btn-danger " data-remove-item>
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>
@endsection
