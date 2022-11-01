@extends('layouts.app')
@section('page-name')
    Purchase Order
@endsection
@section('content')
<form action="{{route('purchase-order.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Purchase Order</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('purchase-order.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Purchase Order No.</label>
                        <input type="text" class="form-control " id="block-form1-username" name="po_no" value="{{old('po_no')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Date</label>
                        <input type="date" class="form-control " id="block-form1-username" name="po_date" value="{{old('po_date')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Mode of Procurement</label>
                        <input type="text" class="form-control " id="block-form1-username" name="mode_of_procurement" value="{{old('mode_of_procurement')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Place of Delivery</label>
                        <input type="text" class="form-control " id="block-form1-username" name="place_of_delivery" value="{{old('place_of_delivery')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Date of Delivery</label>
                        <input type="date" class="form-control " id="block-form1-username" name="date_of_delivery" value="{{old('date_of_delivery')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Delivery Term</label>
                        <input type="text" class="form-control " id="block-form1-username" name="delivery_term" value="{{old('delivery_term')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Payment Term</label>
                        <input type="text" class="form-control " id="block-form1-username" name="payment_term" value="{{old('payment_term')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="example-select">Supplier:</label>
                        <select class="form-control" id="example-select" name="supplier_id">
                            <option value="">Please select</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Purchase Order Item</h3>
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
                    <input type="text" class="form-control" id="block-form1-username" name="units[]" value="{{old('units.0')}}" placeholder="Enter Unit Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Unit Cost</label>
                    <input type="number" class="form-control" id="block-form1-username" name="unitCosts[]" value="{{old('unitCosts.0')}}" placeholder="Enter Unit Name">
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
