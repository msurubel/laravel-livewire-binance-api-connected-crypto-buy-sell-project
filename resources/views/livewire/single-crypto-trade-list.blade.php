@foreach($orders as $k=>$val)
<tr>
<td>{{++$k}}.</td>
<td>{{$val->ref}}</td>
<td>{{$val->orderId}}</td>
<td>{{$val->clientOrderId}}</td>
<td>{{$val->method_name}}</td>
<td>{{$val->amount}}</td>
<td>{{$val->price}}</td>
<td>
    @if(substr(app('request')->input('symbol'), -4) == 'USDT')
    {{$val->cost}} {{substr(app('request')->input('symbol'), -4)}}
    @else
    {{$val->cost}} {{substr(app('request')->input('symbol'), -3)}}
    @endif                                            
</td>                                                                                
<td>{{$val->market_type}}</td>
<td>{{$val->market_side}}</td>                                         

<td>
    @if($val->status =='FILLED')                                            
    <span class="badge badge-success">{{$val->status}}</span>
    @elseif($val->status =='NEW') 
    <span class="badge badge-info">{{$val->status}}</span>
    @elseif($val->status =='CANCELED')
    <span class="badge badge-danger">{{$val->status}}</span>
    @endif                                            
</td>

<td>
    @if($val->market_type == 'LIMIT')
        @if($val->status == 'NEW')
        <a href="/dashboard/crypto/order/cancel/{{$val->method_symbol}}/{{$val->orderId}}/{{$val->ref}}/{{ auth()->user()->id }}">Cancel Order</a>
        @else
        @endif
    @else
    @endif
</td>
<!--
<td>
    @if($val->market_type == 'LIMIT')
        @if($val->status == 'FILLED')
        <a href="/dashboard/crypto/order/cancel/{{$val->method_symbol}}/{{$val->orderId}}/{{$val->id}}/{{$val->crypto_id}}/{{ auth()->user()->id }}">Cancel</a>
        @else
        @endif
    @else
    @endif
</td>
    -->
</tr>                                        
@endforeach