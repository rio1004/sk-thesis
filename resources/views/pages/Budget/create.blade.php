@extends('layouts.app')
@section('page-name')
Budget
@endsection
@section('content')
<form action="{{route('budget.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create an Budget</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('budget.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Year</label>
                        <input type="number" class="form-control " id="block-form1-username" name="fy_year" value="{{old('fy_year')}}" placeholder="Enter Year.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Initial Budget</label>
                        <input type="number" class="form-control " id="block-form1-username" name="initial_budget" value="{{old('initial_budget')}}" placeholder="Enter Initial Budget.">
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
