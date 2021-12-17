@component('mail::message')
# Trade Confirmation

<p>Hi, {{$details['name']}}<br>
The email of your order confirmation that you make on {{ config('app.name') }}</p>

@component('mail::panel')
Order Ref. ID. <strong>{{$details['refid']}}<strong>
@endcomponent

@component('mail::table')
| Name          | Details                          |
|:--------------|---------------------------------:|
| Order #       | {{$details['orderid']}}          |
| Symbol        | {{$details['symbol']}}           |
| Amount        | {{$details['amount']}}           |
| Cost          | {{$details['cost']}}             |
| Market Type   | {{$details['markettype']}}       |
@if($details['marketside'] == "BUY")
| Market Side   | <strong><span style="color: green;">{{$details['marketside']}}</span></strong> |
@else
| Market Side   | <strong><span style="color: red;">{{$details['marketside']}}</span></strong> |
@endif
@if($details['status'] == "NEW")
| Status        | <span style="color: blue;">{{$details['status']}}</span> |
@elseif($details['status'] == "FILLED")
| Status        | <span style="color: green;">{{$details['status']}}</span> |
@else
| Status        | <span style="color: red;">{{$details['status']}}</span> |
@endif
@endcomponent

<p>We appreciate your interest in {{ config('app.name') }}</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent