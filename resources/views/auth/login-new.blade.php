@extends('layouts.front')

@section('content')


<div class="authincation section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                           
                        <div class="auth-form card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title">Sign in</h4>
                            </div>
                            <p class="text-center pt-2" style="color: green; padding: 15px;">{{$msgalert}}</p>
                            <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                        @csrf
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="hello@example.com"
                                            name="email">
                                            @error('email')
                                            <span style="color: red;"><strong>{{ $message }}</strong></span>
                                            @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password">

                                            @error('password')
                                                <span style="color: red;"><strong>{{ $message }}</strong></span>
                                            @enderror
                                    </div>
                                    <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                        <div class="form-group mb-0">
                                            <label class="toggle">
                                                <input class="toggle-checkbox" type="checkbox">
                                                <span class="toggle-switch"></span>
                                                <span class="toggle-label">Remember me</span>
                                            </label>
                                        </div>
                                        <div class="form-group mb-0">
                                            <a href="reset.html">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-success btn-block">Sign in</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p>Don't have an account? <a class="text-primary" href="/new">Sign
                                            up</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
