@extends('layouts.app')
@section('page-name')
Notice of Approval
@endsection
@section('content')
<form action="{{route('qoutation.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Notice of Approval</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('notice-of-award.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Qoutation No.</label>
                        <input type="text" class="form-control " id="block-form1-username" name="qoutation_no" value="{{$qoutation->qoutation_no}}" placeholder="Enter pr no.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Date</label>
                        <input type="date" class="form-control " id="block-form1-username" name="date" value="{{$qoutation->date}}">
                    </div>
                    <div class="form-group">
                        <label for="example-select">Procurement Officer:</label>
                        <select class="form-control" id="example-select" name="procurement_ofcr_id">
                            <option value="">Please select</option>
                            @foreach($officials as $official)
                                <option value="{{ $official->id }}"@selected($official->id == $qoutation->procurement_ofcr_id)>{{ $official->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="example-select">Supplier:</label>
                        <select class="form-control" id="example-select" name="supplier_id">
                            <option value="">Please select</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" @selected($supplier->id == $qoutation->supplier_id)>{{ $supplier->supplier_name }}</option>
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
            @foreach ($qoutation->request_items as $item)
            <div class="row justify-content-left" {{ $loop->first ? 'data-parent' : '' }}>
                <input type="hidden" name="rqId[]" value="{{ $item->id }}">
                <div class="form-group col-md-3 ml-4">
                    <label for="block-form1-username">Items</label>
                    <input type="text" class="form-control" id="block-form1-username" name="items[]" value="{{$item->item}}" placeholder="Enter Item Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Unit</label>
                    <input type="text" class="form-control" id="block-form1-username" name="units[]" value="{{$item->unit}}" placeholder="Enter Unit Name">
                </div>
                <div class="form-group col-md-2">
                    <label for="block-form1-username">Quantity</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="block-form1-username" name="qtys[]" value="{{$item->qty}}" placeholder="Enter quantity">
                        <div class="input-group-append {{ $loop->first ? 'd-none' :'' }}" data-item-hide>
                            <button type="button" class="btn btn-danger " data-remove-item>
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
