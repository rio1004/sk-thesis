@extends('layouts.app')
@section('page-name')
    Purchase Order
@endsection
@section('content')
<form action="{{route('purchase-order.update', [$purchaseOrder])}}" method="POST">
    @csrf
    @method('PUT')
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
                        <input type="text" class="form-control " id="block-form1-username" name="po_no" value="{{$purchaseOrder->po_no}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Date</label>
                        <input type="date" class="form-control " id="block-form1-username" name="po_date" value="{{$purchaseOrder->po_date->format('Y-m-d')}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Mode of Procurement</label>
                        <input type="text" class="form-control " id="block-form1-username" name="mode_of_procurement" value="{{$purchaseOrder->mode_of_procurement}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Place of Delivery</label>
                        <input type="text" class="form-control " id="block-form1-username" name="place_of_delivery" value="{{$purchaseOrder->place_of_delivery}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Date of Delivery</label>
                        <input type="date" class="form-control " id="block-form1-username" name="date_of_delivery" value="{{$purchaseOrder->date_of_delivery}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Delivery Term</label>
                        <input type="text" class="form-control " id="block-form1-username" name="delivery_term" value="{{$purchaseOrder->delivery_term}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Payment Term</label>
                        <input type="text" class="form-control " id="block-form1-username" name="payment_term" value="{{$purchaseOrder->payment_term}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="example-select">Supplier:</label>
                        <select class="form-control" id="example-select" name="supplier_id">
                            <option value="">Please select</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}"@selected($supplier->id == $purchaseOrder->supplier_id)>{{ $supplier->supplier_name }}</option>
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
            @foreach ($purchaseOrder->purchaseOrderItem  as $item)
            <div class="row justify-content-left"  {{ $loop->first ? 'data-parent' : '' }}>
                <input type="hidden" name="poItemId[]" value="{{ $item->id }}">
                <div class="form-group col-md-3 ml-4">
                    <label for="block-form1-username">Items</label>
                    <input type="text" class="form-control" id="block-form1-username" name="items[]" value="{{$item->item}}" placeholder="Enter Item Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Unit</label>
                    <input type="text" class="form-control" id="block-form1-username" name="units[]" value="{{$item->unit}}" placeholder="Enter Unit Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Unit Cost</label>
                    <input type="number" class="form-control" id="block-form1-username" name="unitCosts[]" value="{{$item->unit_price}}" placeholder="Enter Unit Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Quantity</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="block-form1-username" name="qtys[]" value="{{$item->qty}}" placeholder="Enter quantity">
                        <div class="input-group-appen {{ $loop->first ? 'd-none' :'' }}" data-item-hide>
                            <button type="button" class="btn btn-danger " data-item-hide>
                                <i class="far fa-trash-alt"></i>
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
