@if(auth()->user()->theme_set == 1)
@foreach($balances as $val)
    <div class="col-lg-2" onclick="location.href='/dashboard/trade/spot/{{$val->symbol}}USDT?symbol={{$val->symbol}}USDT'" style="border-radius: 15px; cursor: pointer;">
        <div class="m-2 hover-item">
            <div class="row">
                <div class="col-lg-12" style="background: #5abb66; border-radius: 15px 15px 0px 0px; padding: 30px; text-align: center; color: white;">
                    <i class="cf cf-{{$val->name}}" style="font-size: 55px;"></i><br>
                    <span style="font-size: 20px; font-weight: 900;">{{$val->symbol}}</span>
                </div>
                <div class="col-lg-12" style="padding-top: 25px; padding-bottom: 25px; background: #e7e7e7; border-radius: 0px 0px 15px 15px; text-align: center;">
                    <p><span style="font-size: 15px; font-weight: 500;">{{number_format($val->balance, 6)}}</span><br><span style="font-size: 30px; font-weight: 900;">${{number_format($val->balance_usd, 2)}}</span></p>
                </div>
            </div>
        </div>    
    </div>
    @endforeach  
    @else 
    @foreach($balances as $val)    
    <div class="col-lg-2" onclick="location.href='/dashboard/trade/spot/{{$val->symbol}}USDT?symbol={{$val->symbol}}USDT'" style="border-radius: 15px; cursor: pointer;">
        <div class="m-2 hover-item">
            <div class="row">
                <div class="col-lg-12" style="background: #131826; border-radius: 15px 15px 0px 0px; padding: 30px; text-align: center; color: white;">
                    <i class="cf cf-{{$val->name}}" style="font-size: 55px;"></i><br>
                    <span style="font-size: 20px; font-weight: 900;">{{$val->symbol}}</span>
                </div>
                <div class="col-lg-12" style="padding-top: 25px; padding-bottom: 25px; background: #313c5d; border-radius: 0px 0px 15px 15px; text-align: center;">
                    <p><span style="font-size: 15px; font-weight: 500;">{{number_format($val->balance, 6)}}</span><br><span style="font-size: 30px; font-weight: 900;">${{number_format($val->balance_usd, 2)}}</span></p>
                </div>
            </div>
        </div>    
    </div>    
    @endforeach
    @endif                  
                        