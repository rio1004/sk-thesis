@extends('layouts.app')
@section('page-name')
    Officials
@endsection
@section('content')
<form action="{{route('official.store')}}" method="POST">
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create Official</h3>
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
                        <label for="block-form1-username">First Name</label>
                        <input type="text" class="form-control form-control-alt" id="block-form1-username" name="first_name" placeholder="Enter your First Name..">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Middle Name</label>
                        <input type="text" class="form-control form-control-alt" id="block-form1-username" name="middle_name" placeholder="Enter your Middle Name..">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Last Name</label>
                        <input type="text" class="form-control form-control-alt" id="block-form1-username" name="last_name" placeholder="Enter your Last Name..">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Age</label>
                        <input type="number" class="form-control form-control-alt" id="block-form1-username" name="age" placeholder="Enter your Age..">
                    </div>
                    <div class="form-group">
                        <label for="example-select">Gender</label>
                        <select class="form-control" id="example-select" name="gender">
                            <option value="">Please select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="example-select">Position</label>
                        <select class="form-control" id="example-select" name="position">
                            <option value="">Please select</option>
                            @foreach ($positions as $pos)
                                <option value="{{$pos}}">{{$pos}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="example-select">Other Position</label>
                        <select class="form-control" id="example-select" name="other_position">
                            <option value="">Please select</option>
                            @foreach ($otherPos as $pos)
                                <option value="{{$pos}}">{{$pos}}</option>
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
