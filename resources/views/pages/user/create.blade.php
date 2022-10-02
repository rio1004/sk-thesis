@extends('layouts.app')
@section('page-name')
    Create User
@endsection
@section('content')
<form action="be_blocks_forms.html" method="POST">
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Create user</h3>
            <div class="block-options">
                <button type="submit" class="btn btn-sm btn-primary">
                    Submit
                </button>
                <button type="reset" class="btn btn-sm btn-alt-primary">
                    Cancel
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Username</label>
                        <input type="text" class="form-control form-control-alt" id="block-form1-username" name="block-form1-username" placeholder="Enter your username..">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-password">Email</label>
                        <input type="password" class="form-control form-control-alt" id="block-form1-password" name="block-form1-password" placeholder="Enter your password..">
                    </div>
                    <div class="form-group">
                        <label for="example-select">Select</label>
                        <select class="form-control" id="example-select" name="example-select">
                            <option value="">Please select</option>
                            @foreach ($barangays as $brgy)
                                <option value="{{$brgy}}">{{$brgy}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>
</form>
@endsection
