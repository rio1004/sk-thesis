@extends('layouts.app')

@section('content')
    
                <!-- Hero -->
                <div class="bg-image" style="background-image: url('{{asset('assets/media/photos/photo8@2x.jpg')}}');">
                    <div class="bg-black-75">
                        <div class="content content-full text-center">
                            <div class="my-3">
                                <img class="img-avatar img-avatar-thumb" src="{{asset('assets/media/avatars/sk_logo.svg')}}" alt="">
                            </div>
                            <h1 class="h2 text-white mb-0">Update Account</h1>
                            <h2 class="h4 font-w400 text-white-75">
                                {{$profile->full_name}}
                            </h2>
                            
                        </div>
                    </div>
                </div>
                <!-- END Hero -->

                <!-- Page Content -->
                <div class="content content-boxed">
                    <!-- User Profile -->
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h3 class="block-title">User Profile</h3>
                        </div>
                        <div class="block-content">
                            <x-alert></x-alert>
                            <x-error></x-error>
                            <form action="{{route('profile.update' , $profile->id)}}" method="POST" enctype="multipart/form-data">
                                @method(('PUT'))
                                @csrf
                                <div class="row push">
                                    <div class="col-lg-4">
                                        <p class="font-size-sm text-muted">
                                           
                                        </p>
                                    </div>
                                    <div class="col-lg-8 col-xl-5">
                                        <div class="form-group">
                                            <label for="one-profile-edit-username">First Name</label>
                                            <input type="text" class="form-control" id="one-profile-edit-username" placeholder="Enter your username.." value="{{$profile->first_name}}" name="first_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="one-profile-edit-username">Middle Name</label>
                                            <input type="text" class="form-control" id="one-profile-edit-username" placeholder="Enter your username.." value="{{$profile->middle_name}}" name="middle_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="one-profile-edit-username">Last Name</label>
                                            <input type="text" class="form-control" id="one-profile-edit-username" placeholder="Enter your username.." value="{{$profile->last_name}}" name="last_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="one-profile-edit-username">Age</label>
                                            <input type="number" class="form-control" id="one-profile-edit-username" placeholder="Enter your username.." value="{{$profile->age}}" name="age">
                                        </div>
                                        <div class="form-group">
                                            <label for="example-select">Gender</label>
                                            <select class="form-control" id="example-select" name="gender">
                                                <option value="">Please select</option>
                                                    @if ($profile->gender == 'Male')
                                                        <option selected value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    @else
                                                        <option value="Male">Male</option>
                                                        <option selected value="Female">Female</option>
                                                    @endif
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="one-profile-edit-email">Email Address</label>
                                            <input type="email" class="form-control" id="one-profile-edit-email" placeholder="Enter your email.." value="{{$profile->email}}" name="email">
                                        </div>
                                        <div class="form-group">
                                            <label>Your Avatar</label>
                                            <div class="push">
                                                <img class="img-avatar" src="{{asset('assets/media/avatars/sk_logo.svg')}}" alt="">
                                            </div>
                                            
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-alt-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                   @include('pages.Profile.update-password')
                </div>
              
         
@endsection
