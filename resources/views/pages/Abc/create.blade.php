@extends('layouts.app')
@section('page-name')
    Approved Budget for Contract
@endsection
@section('content')
<form action="{{route('abc.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Approved Budget for Contract</h3>
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
                        <label>Procurement Title<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('proc_title')}}" name="proc_title" placeholder="Enter a Procurement Title"/>
                    </div>
                    <div class="form-group">
                        <label>Approved Bidder<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" value="{{old('bidder')}}"  name="bidder" placeholder="Enter the Approved Bidder"/>
                    </div>
                    <div class="form-group">
                        <label>Prepared By: <span class="text-danger">*</span></label>
                        <select class="form-control "  value="{{old('prepared_by')}}" name="prepared_by">
                            <option value="">-- Please select --</option>
                            @foreach ($officials as $official)
                                <option value="{{$official->id}}">{{$official->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Recommending Approval: <span class="text-danger">*</span></label>
                        <select class="form-control" name="recommended_by" required>
                            <option value="">-- Please select --</option>
                            @foreach ($officials as $official)
                                <option value="{{$official->id}}">{{$official->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Approved by: <span class="text-danger">*</span></label>
                        <select name="approved_by" class="form-control" required>
                            <option value="">-- Please select --</option>
                            @foreach($officials as $official)
                                <option value="{{ $official->id }}" {{ old('approved_by')==$official->id ? 'selected' : ''  }}>{{ $official->full_name }}</option>
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
            <div class="row justify-content-left" data-parent>
                <div class="form-group col-lg-2">
                    <label>Description <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Quantity" name="items[]" value="{{old('items.0')}}"/>
                </div>
                <div class="form-group col-lg-2">
                    <label>Unit <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" placeholder="Enter Quantity" name="units[]" value="{{old('units.0')}}"/>
                </div>
                <div class="form-group col-lg-2">
                    <label>Quantity:</label>
                    <input type="number" class="form-control" placeholder="Enter Quantity" name="qtys[]" value="{{old('qtys.0')}}"/>
                </div>
                <div class="form-group col-lg-2">
                    <label>Current Market Price:</label>
                    <input type="number" class="form-control" placeholder="Enter Market Price" name="prices[]" value="{{old('prices.0')}}"/>
                </div>

                <div class="form-group col-lg-2">
                    <label>Frieght and Insurance</label>
                    <input type="number" class="form-control" placeholder="Enter Frieght and Insurance"  name="insurances[]"  value="{{old('insurances.0')}}"/>
                </div>
                <div class="form-group col-lg-2">
                    <label>Other Indirect Costs:</label>
                    <input type="number" class="form-control" placeholder="Other Costs"  name="indirects_costs[]" value="{{old('indirects_costs.0')}}"/>
                </div>
                <div class="form-group col-lg-3">
                    <label>VAT other Taxes and/or Dutes Applicable</label>
                    <input type="number" class="form-control" placeholder="Enter VAT and Taxes" name="taxes[]" value="{{old('taxes.0')}}"/>
                </div>
                <div class="form-group col-md-5">
                    <label for="block-form1-username">Other Cost Factors Inflation, Currency Valuation adjustment</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="block-form1-username" name="adjustments[]" value="{{old('qtys.0')}}" placeholder="Enter quantity">
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
