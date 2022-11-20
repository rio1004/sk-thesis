@extends('layouts.app')
@section('page-name')
    Purchase Request
@endsection
@section('content')
<form action="{{route('notice-to-proceed.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Notice To Proceed</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('notice-to-proceed.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Date</label>
                        <input type="date" class="form-control " id="block-form1-username" name="ntp_date" value="{{old('ntp_date')}}" placeholder="Enter Date.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Effectivity Date</label>
                        <input type="date" class="form-control " id="block-form1-username" name="ntp_effectivity_date" value="{{old('ntp_effectivity_date')}}">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Project Location</label>
                        <input type="text" class="form-control " id="block-form1-username" name="project_location" value="{{old('project_location')}}">
                    </div>
                    <div class="form-group">
                        <label for="example-select">Approved Project:</label>
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
