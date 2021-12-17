@component('mail::message')
# Your Ontime Password

<p>Hi, {{$details['name']}}<br>
Please login your account with the onetime password bellow.</p>

@component('mail::panel')
{{$details['password']}}
@endcomponent

<p>After login please change your password from dashboard profile section.</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent