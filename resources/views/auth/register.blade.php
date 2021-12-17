@extends('layouts.front')

@section('content')


<div class="authincation section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                           
                        <div class="auth-form card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title">Sign Up</h4>
                            </div>
                            <p class="text-center pt-2" style="color: red; padding: 15px;">{{$msgalert}}</p>
                            <div class="card-body">
                                <form method="POST" action="{{ route('user.register') }}">
                                @csrf
                                    <div class="form-group">
                                        <label>name</label>
                                        <input type="text" class="form-control" placeholder="Write Your full name"
                                            name="name">
                                            @if ($errors->has('name'))
                                                <span class="error form-error-msg ">
                                                {{ $errors->first('name') }}
                                                </span>
                                            @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="hello@example.com"
                                            name="email">
                                        <input type="hidden" class="form-control" value="{{ app('request')->input('ref') }}" name="referedby">
                                        @if ($errors->has('email'))
                                                <span class="error form-error-msg ">
                                                {{ $errors->first('email') }}
                                                </span>
                                            @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password">
                                            @if ($errors->has('password'))
                                                <span class="error form-error-msg ">
                                                {{ $errors->first('password') }}
                                                </span>
                                            @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Password Confirm</label>
                                        <input type="password" class="form-control" placeholder="Password Comfirmation"
                                            name="password_confirmation">
                                    </div>
                                    
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block">Register</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Do You have an account? <a class="text-primary" href="/login">Sign
                                            in</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br><br><br><br><br><br>
@endsection




