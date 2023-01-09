                
                    <div class="block block-rounded">
                        <div class="block-header">
                            <h3 class="block-title">Change Password</h3>
                        </div>
                        <div class="block-content">
                            <form method="POST" action="{{route('update-my-password' , $profile->id)}}">
                                @method('PUT')
                                @csrf
                                <div class="row push">
                                    <div class="col-lg-4">
                                        <p class="font-size-sm text-muted">
                                            Changing your sign in password is an easy way to keep your account secure.
                                        </p>
                                    </div>
                                    <div class="col-lg-8 col-xl-5">
                                        <div class="form-group">
                                            <label for="one-profile-edit-password">Current Password</label>
                                            <input type="password" class="form-control" id="one-profile-edit-password" name="current_password">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="one-profile-edit-password-new">New Password</label>
                                                <input type="password" class="form-control" id="one-profile-edit-password-new" name="password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <label for="one-profile-edit-password-new-confirm">Confirm New Password</label>
                                                <input type="password" class="form-control" id="one-profile-edit-password-new-confirm" name="confirm_password">
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
             