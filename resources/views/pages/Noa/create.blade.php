@extends('layouts.app')
@section('page-name')
    Notice of Approval
@endsection
@section('content')
<form action="{{route('notice-of-award.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Notice of Approval</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('purchase-request.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Noa Date</label>
                        <input type="date" class="form-control " id="block-form1-username" name="noa_date" value="{{old('noa_date')}}">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Bid Date</label>
                        <input type="date" class="form-control " id="block-form1-username" name="bid_date" value="{{old('bid_date')}}">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">NOA Approved Price</label>
                        <input type="number" class="form-control " id="block-form1-username" name="noa_approved_price" value="{{old('noa_approved_price')}}">
                    </div>

                    <div class="form-group">
                        <label for="example-select">Choose an Abstract of Canvass:</label>
                        <select class="form-control" id="example-select" name="canvass_id">
                            <option value="">Please select</option>
                            @foreach($canvasses as $canvass)
                                <option value="{{ $canvass->id }}">{{ $canvass->project_name }}</option>
                            @endforeach
                        </select>
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
