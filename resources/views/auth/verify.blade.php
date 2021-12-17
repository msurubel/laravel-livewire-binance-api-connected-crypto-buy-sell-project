@extends('layouts.dashboard')
@section('content')

<div style="padding: 100px;">
    <div class="auth-box-w wider centered">
            <div class="logo-w">
            <a href="/dashboard"><img alt="" width="300px" src="/img/tenor.gif"></a>
            </div>
            <h5 class="auth-header">
            Verify Your Email
            </h5>

            <div class="card-body">
                                <form method="POST" action="{{ route('auth.email.success') }}">
                                @csrf
                                    <div class="form-group">
                                        <label>Email Verification Code</label>
                                        <input type="text" class="form-control" value="{{ app('request')->input('code') }}" placeholder="Write Your code"
                                            name="emailcode">
                                            <input type="hidden" class="form-control" value="{{auth()->user()->id}}" name="user_id">
                                    </div> 
                                    <div class="text-center">
                                        <button type="submit" onclick="emailverifybuttonon(this)" class="btn btn-success btn-block">Verify Now</button>
                                        <div id="verifyemailon"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                                    </div>
                                </form>
                                <script>
                                    const emailverifybuttonon = (element) => {
                                    element.hidden = true;                                                    
                                    document.getElementById('verifyemailon').style.display = "block";                  
                                    }
                                </script>
                                <div class="new-account mt-3">
                                    <p>You have email verification code? <a class="text-primary" href="/dashboard/auth/email">Recent code</a></p>
                                </div>                                
                            </div>
            <br>
    </div>
</div>

@endsection