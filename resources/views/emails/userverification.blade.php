@component('mail::message')
# Email Verification

<p>Hi, {{$details['username']}}<br>
Please verify your email before use your account for security resion</p>

@component('mail::panel')
{{$details['emailcode']}}
@endcomponent

<p>Please go to the link bellow and use this abov code email verification.	</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent