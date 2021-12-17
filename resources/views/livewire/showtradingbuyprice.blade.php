<div>    
        <form wire:submit.prevent="CryptoBuy">        
            <h5 class="form-header">
                Buy {{ app('request')->input('name') }}
            </h5>
            <div class="form-desc">
                @if(substr($symbol, -4) == 'USDT')
                The order Execute if you have money on your Main Account Blance, Please make sure you have Main Account Balance before place this BUY Order Your Avilable Balance <span style="color: green;"><strong>{{ number_format( $sellcryptoblnc, 2) }} USDT</strong></span>
                @else
                The order Execute if you have money on your {{substr($symbol, -3)}} Account Blance, Please make sure you have {{substr($symbol, -3)}} Account Balance before place this BUY Order Your Avilable Balance <span style="color: green;"><strong>{{ number_format( $sellcryptoblnc, 6)}} {{substr($symbol, -3)}}</strong></span>
                @endif         
            </div>
            @if(app('request')->input('details') == 'Active')

                @if(substr(app('request')->input('symbol'), -4) == 'USDT')
                <p>Total Cost: <span style="color: red;">-{{ number_format (app('request')->input('cost'), 10) }}</span> {{substr(app('request')->input('symbol'), -4) }}</p>
                @else
                <p>Total Cost: <span style="color: red;">-{{ number_format (app('request')->input('cost'), 10) }}</span> {{substr(app('request')->input('symbol'), -3) }}</p>
                @endif

            @else
            @endif
            <div class="form-group">
                @if(substr($symbol, -4) == 'USDT')
                <label for="">Amount ({{substr($symbol, 0, -4) }}) <span wire:loading wire:target="buyrangefst"><img alt="" width="20px" src="/img/loading-2.gif"></span></label>
                @else
                <label for="">Amount ({{substr($symbol, 0, -3) }}) <span wire:loading wire:target="buyrangefst"><img alt="" width="20px" src="/img/loading-2.gif"></span></label>
                @endif   
                
    <input class="form-control" name="amount" wire:model="amount" required>
    <input class="form-control" value="{{$symbol}}" wire:model="symbol" type="hidden">    
    <input class="form-control" wire:model="userbalance" type="hidden">
    <div class="row" style="padding-right: 2px; padding-left: 2px; padding-top: 10px;">

        <div class="col-3">
            <p class="buy-range @if($ranges == 25){{$color}} @else @endif" wire:click="buyrangefst(25)">25%</p>
        </div>

        <div class="col-3">
            <p class="buy-range @if($ranges == 50){{$color}} @else @endif" wire:click="buyrangefst(50)">50%</p>
        </div>

        <div class="col-3">
            <p class="buy-range @if($ranges == 75){{$color}} @else @endif" wire:click="buyrangefst(75)">75%</p>
        </div>

        <div class="col-3">
            <p class="buy-range @if($ranges == 99){{$color}} @else @endif" wire:click="buyrangefst(99)">100%</p>
        </div>

    </div>    
    @if($costs == 0)

    @else
        @if($costs<$userbalance)
        @if(substr("$symbol", -4) == 'USDT')      
        <p style="font-size: 12px; padding-top: 7px;">Estimated Cost: <span style="color: green;">{{number_format ($costs, 2)}} USD</span></p> 
        @else
        <p style="font-size: 12px; padding-top: 7px;">Estimated Cost: <span style="color: green;">{{number_format ($costs, 6)}} {{substr("$symbol", -3)}}</span></p>
        @endif
        @else
        <p style="font-size: 12px; padding-top: 7px;"><span style="color: red;">Insufficient Balance</span></p>
        @endif
    @endif    
    </div>                                            
                                                
        <div class="form-check">
            <label class="form-check-label"><input class="form-check-input" type="checkbox" required>I agree to terms and conditions</label>
        </div> 


        <div class="form-buttons-w">
            <button class="btn btn-success" id="myButton" type="submit">            
            <div wire:loading wire:target="CryptoBuy"><div class="spinner-border" role="status"></div> </div>             
            Buy Now</button>                                                                     
        </div>
        
    </form>    
</div>

