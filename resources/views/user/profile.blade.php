@extends('layouts.dashboard')
@section('content')

<div class="content-box">
<div class="row">
        <div class="col-lg-6">
				<div class="element-wrapper">
				  <h6 class="element-header">
					Profile Setting
				  </h6>
				  <div class="element-box">
				  	<form method="POST" action="{{ route('profile.data.update') }}">
                    @csrf
					  <h5 class="form-header">
						User Data
					  </h5>
					  <div class="form-desc">
						You can see or change your data using this form.
					  </div>
                      <div class="form-group">
						<label for=""> Name</label><input class="form-control" value="{{auth()->user()->name}}" name="name" type="text">
					  </div>
					  <div class="form-group">
						<label for=""> Email address</label><input class="form-control" value="{{auth()->user()->email}}" name="email" type="email">
					  </div>
                      <div class="form-group">
						<label for=""> Country</label><input class="form-control" value="{{auth()->user()->country}}" name="country" type="text">
					  </div>
                      <div class="form-group">
						<label for=""> Change Password</label><input class="form-control" value=""name="password"  type="password">
					  </div>
					  
					  
					  <div class="form-check">
						<label class="form-check-label"><input class="form-check-input" type="checkbox">I agree to terms and conditions</label>
					  </div>
					  <div class="form-buttons-w">
						<button class="btn btn-primary" type="submit"> Submit</button>
					  </div>
					</form>
				  </div>
				</div>
	    </div>

            <div class="col-lg-6">

                <div class="element-wrapper">
				  <h6 class="element-header">
					Profile Setting - Section 2
				  </h6>
                    <div class="element-box">
                            <form method="POST" action="{{ route('profile.image') }}" enctype="multipart/form-data">
                            @csrf
                            <h5 class="form-header">
                                Profile Photo
                            </h5>
                            <div class="form-desc">
                                You can see or change your profile photo.
                            </div>

                            <div class="centered">
                                <div class="logo-w">
                                    <img alt="" width="200px" src="/img/avatars/{{ auth()->user()->image }}">
                                </div>
                            </div><br><br>
                            
                            <div class="form-group">
							    <label for=""> Change Image</label><input class="form-control" name="image" type="file">
                                <input class="form-control" name="user_id" value="{{auth()->user()->id}}" type="hidden">
						    </div>                    
                            <div class="form-buttons-w">
                                <button class="btn btn-primary" type="submit"> Save Change</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

</div>
</div>

@endsection