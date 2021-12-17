<div>
    <form wire:submit.prevent="CryptoSell">
    @csrf
        <h5 class="form-header">
            Sell {{ app('request')->input('name') }}
        </h5>
        <div class="form-desc">
                @if(substr($symbol, -4) == 'USDT')
                The order Execute if you have money on your {{substr($symbol, 0, -4)}} Account Blance, Please make sure you have {{substr($symbol, 0, -4)}} Balance before place this Sell Order. Your Avilable Balance <span style="color: green;"><strong>{{ number_format( $buycryptoblnc, 6) }} {{substr($symbol, 0, -4)}}</strong></span>
                @else
                The order Execute if you have money on your {{substr($symbol, 0, -3)}} Account Blance, Please make sure you have {{substr($symbol, 0, -3)}} Account Balance before place this BUY Order. Your Avilable Balance <span style="color: green;"><strong>{{ number_format( $buycryptoblnc, 6)}} {{substr($symbol, 0, -3)}}</strong></span>
                @endif 
        </strong></span>
        </div>
        <div class="form-group">
                @if(substr($symbol, -4) == 'USDT')
                <label for="">Amount ({{substr($symbol, 0, -4) }}) <span wire:loading wire:target="sellrangefst"><img alt="" width="20px" src="/img/loading-2.gif"></span></label>
                @else
                <label for="">Amount ({{substr($symbol, 0, -3) }}) <span wire:loading wire:target="sellrangefst"><img alt="" width="20px" src="/img/loading-2.gif"></span></label>
                @endif                                                     
                <input class="form-control" type="text" name="amount" wire:model="amount" required>
    <input class="form-control" value="{{app('request')->input('symbol')}}" wire:model="symbol" type="hidden">    
    <input class="form-control" wire:model="userbalance" type="hidden">
    <div class="row" style="padding-right: 2px; padding-left: 2px; padding-top: 10px;">

        <div class="col-3">
            <p class="buy-range @if($ranges == 25){{$color}} @else @endif" wire:click="sellrangefst(25)">25%</p>
        </div>

        <div class="col-3">
            <p class="buy-range @if($ranges == 50){{$color}} @else @endif" wire:click="sellrangefst(50)">50%</p>
        </div>

        <div class="col-3">
            <p class="buy-range @if($ranges == 75){{$color}} @else @endif" wire:click="sellrangefst(75)">75%</p>
        </div>

        <div class="col-3">
            <p class="buy-range @if($ranges == 99){{$color}} @else @endif" wire:click="sellrangefst(99)">100%</p>
        </div>

    </div>
    @if($costs == 0)

    @else       
        
        @if($amount<$userbalance)
        @if(substr("$symbol", -4) == 'USDT')      
        <p style="font-size: 12px; padding-top: 7px;">Estimated Return: <span style="color: green;">{{number_format ($costs, 2)}} USD <span wire:loading wire:target="buyrangefst"><img alt="" width="20px" src="/img/loading-2.gif"></span></span></p> 
        @else
        <p style="font-size: 12px; padding-top: 7px;">Estimated Return: <span style="color: green;">{{number_format ($costs, 6)}} {{substr("$symbol", -3)}} <span wire:loading wire:target="buyrangefst"><img alt="" width="20px" src="/img/loading-2.gif"></span></span></p>
        @endif
        @else
        <p style="font-size: 12px; padding-top: 7px;"><span style="color: red;">Insufficient Balance <span wire:loading wire:target="buyrangefst"><img alt="" width="20px" src="/img/loading-2.gif"></span></span></p>
        @endif
    @endif
    </div>                                            
                                                
        <div class="form-check">
            <label class="form-check-label"><input class="form-check-input" type="checkbox" required>I agree to terms and conditions</label>
        </div>

        

        <div class="form-buttons-w">
            <button class="btn btn-danger" type="submit">
            <div wire:loading wire:target="CryptoSell"><div class="spinner-border" role="status"></div></div>     
            Sell Now</button>
        </div>
    </form>
</div>


