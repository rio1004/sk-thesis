@extends('layouts.app')
@section('page-name')
Announcement
@endsection
@section('content')
<form action="{{route('admin-announcement.update', $adminAnnouncement)}}" method="POST">
    @method('PUT')
    @csrf
    <x-alert></x-alert>
    <x-error></x-error>
    <div class="block block-rounded">
        <div class="block-header block-header-default">
            <h3 class="block-title">Update an Announcement</h3>
            <div class="block-header">
                <a class="btn btn-sm btn-alt-success" href="{{route('admin-announcement.index')}}">
                    Cancel
                </a>
            </div>
        </div>
        <div class="block-content">
            <div class="row justify-content-center py-sm-3 py-md-5">
                <div class="col-sm-10 col-md-8">
                    <div class="form-group">
                        <label for="block-form1-username">Title</label>
                        <input type="text" class="form-control " id="block-form1-username" name="title" value="{{$adminAnnouncement->title}}" placeholder="Enter Title.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">What</label>
                        <input type="text" class="form-control " id="block-form1-username" name="what" value="{{$adminAnnouncement->what}}" placeholder="Enter What.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">When</label>
                        <input type="date" class="form-control " id="block-form1-username" name="when" value="{{$adminAnnouncement->when}}">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Where</label>
                        <input type="text" class="form-control " id="block-form1-username" name="where" value="{{$adminAnnouncement->where}}" placeholder="Enter Where.">
                    </div>
                    <div class="form-group">
                        <label for="block-form1-username">Details</label>
                        <textarea name="details" id="" cols="30" rows="10" class="form-control">{{$adminAnnouncement->details}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="example-select">Approved Project:</label>
                        <select class="form-control" id="example-select" name="status">
                            <option value="">Please select</option>
                            <option value="2" @selected(2 == $adminAnnouncement->status)>Very Important</option>
                            <option value="1" @selected(1 == $adminAnnouncement->status)>Fairly Important</option>
                            <option value="0" @selected(0 == $adminAnnouncement->status)>Important</option>
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
