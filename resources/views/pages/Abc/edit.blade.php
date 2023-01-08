@extends('layouts.app')
@section('page-name')
    Approved Budget for Contract
@endsection
@section('content')
<form action="{{route('abc.update', [$abc])}}" method="POST">
    @csrf
    @method('PUT')
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Edit Approved Budget for Contract</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('abc.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label>Procurement Title: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="procurement_title" placeholder="Enter a Procurement Title" value="{{$abc->procurement_title}}"/>
                    </div>
                    <div class="form-group">
                        <label>Approved Bidder: <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="bidder" placeholder="Enter the Approved Bidder" value="{{$abc->bidder}}"/>
                    </div>
                    <div class="form-group">
                        <label>Prepared by: <span class="text-danger">*</span></label>
                        <select name="submitted_by_id" class="form-control">
                            <option value="">-- Please select --</option>
                            @foreach($officials as $official)
                                <option value="{{ $official->id }}" @selected($official->id == $abc->submitted_by_id)>{{ $official->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Recommending Approval: <span class="text-danger">*</span></label>
                        <select class="form-control" name="recommend_by_id">
                            <option value="">-- Please select --</option>
                            @foreach ($officials as $official)
                                <option value="{{$official->id}}" @selected($abc->recommend_by_id   == $official->id)>{{$official->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Approved by: <span class="text-danger">*</span></label>
                        <select name="approved_by_id" class="form-control">
                            <option value="">-- Please select --</option>
                            @foreach($officials as $official)
                                <option value="{{ $official->id }}" @selected($abc->approved_by_id == $official->id)>{{ $official->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Approved Budget for Contract Item</h3>
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
            @foreach ($abc->abc_items as $abc )
            <div class="row justify-content-left" {{ $loop->first ? 'data-parent' : '' }}>
                <input type="hidden" name="abcId[]" value="{{ $abc->id }}">
                <div class="form-group col-lg-4">
                    <label>Description <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Quantity" name="items[]" value="{{$abc->item}}"/>
                </div>
                <div class="form-group col-lg-2">
                    <label>Unit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Quantity" name="units[]" value="{{$abc->unit}}"/>
                </div>
                <div class="form-group col-lg-3">
                    <label>Quantity:</label>
                    <input type="number" class="form-control" placeholder="Enter Quantity" name="qtys[]" value="{{$abc->qty}}"/>
                </div>
                <div class="form-group col-lg-3">
                    <label>Current Market Price:</label>
                    <input type="number" class="form-control" placeholder="Enter Current Market Price" name="prices[]" value="{{$abc->market_price}}"/>
                </div>
                <div class="form-group col-lg-3">
                    <label>VAT other Taxes and/or Dutes Applicable</label>
                    <input type="number" class="form-control" placeholder="Enter VAT other Taxes and/or Dutes Applicable" name="taxes[]" value="{{$abc->tax}}"/>
                </div>
                <div class="form-group col-lg-3">
                    <label>Freight and Insurance</label>
                    <input type="number" class="form-control" placeholder="Enter Freight and Insurance" name="insurances[]" value="{{$abc->insurance}}"/>
                </div>
                <div class="form-group col-lg-3">
                    <label>Other Indirect Costs:</label>
                    <input type="number" class="form-control" placeholder="Enter Other Indirect Costs" name="indirects_costs[]" value="{{$abc->indirect_cost}}"/>
                </div>
                <div class="form-group col-md-5">
                    <label for="block-form1-username">Other Cost Factors Inflation, Currency Valuation adjustment</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="block-form1-username" name="adjustments[]" value="{{$abc->valuation_adjustment}}" placeholder="Enter quantity">
                        <div class="input-group-appen {{ $loop->first ? 'd-none' :'' }}" data-item-hide="">
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
