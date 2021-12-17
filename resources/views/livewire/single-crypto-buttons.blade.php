
<div>
    <button class="btn btn-primary" data-target=".withdraw" data-toggle="modal" type="button"><i class="os-icon os-icon-refresh-ccw"></i><span>Withdraw</span></button> 

    <!-- Withdraw Model -->
    <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade withdraw" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                Withdraw
                </h5>
                <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('withdraw.crypto') }}">
                @csrf
                <div class="form-group">
                    <label for="">
                    @if(substr(app('request')->input('symbol'), -4) == 'USDT')
                    Withdraw Amount ({{substr(app('request')->input('symbol'), 0, -4)}})
                    @else
                    Withdraw Amount ({{substr(app('request')->input('symbol'), 0, -3)}})
                    @endif
                    </label><input class="form-control" name="amount" type="text" required>
                    
                    <input class="form-control" value="{{ app('request')->input('symbol') }}" name="crypto_symbol" type="hidden">
                    <input class="form-control" value="{{ app('request')->input('name') }}" name="crypto_name" type="hidden">
                </div>
                

                <div class="form-group">
                    <label for="">
                    @if(substr(app('request')->input('symbol'), -4) == 'USDT')
                    {{substr(app('request')->input('symbol'), 0, -4)}} Wallet Address
                    @else
                    {{substr(app('request')->input('symbol'), 0, -3)}} Wallet Address
                    @endif
                    </label><input class="form-control" name="details" type="text" required>
                </div>
                                                
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Process</button>
            </div>
            </form>
            </div>
        </div>
    </div>
    <!-- withdraw Model -->  
    
    <button class="btn btn-primary" onclick="location.href='/dashboard/cryptos/all'" type="button"><span class="fas fa-coins" style="padding-right: 5px;"></span><span>All Coins</span></button>
    @if($showinpute == "hide")
    <button class="btn btn-success" wire:click="showinputeclick" type="button"><span><div wire:loading wire:target="showinputeclick"><div class="spinner-border" role="status"></div></div> Auto Profit</span></button>
    @else
    <button class="btn btn-danger" wire:click="hideinputeclick" type="button"><span><div wire:loading><div class="spinner-border" role="status"></div></div> Close Panel</span></button>
    
    <div style="padding-top: 20px;">
        <div style="padding-right: 20px; background: ;">
            <form wire:submit.prevent="LockNowAmount">
            <div class="row">    
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="">
                            Amount <strong><span>${{number_format($usdvalue, 2)}}</span></strong> @if($usdvalue > $set->locked_amount_minimum || $usdvalue == $set->locked_amount_minimum) @else <span style="color: red;">  Minimum ${{$set->locked_amount_minimum}}</span> @endif  <span wire:loading><img alt="" width="20px" src="/img/loading-2.gif"></span>
                            </label><br>
                            @if(empty($amount))
                                @if(substr($symbol, -4) == 'USDT')
                                    <span style="font-size: 30px; font-weight: 900;">0 {{substr($symbol, 0, -4) }} </span>
                                @else
                                    <span style="font-size: 30px; font-weight: 900;">0 {{substr($symbol, 0, -3) }} </span>
                                @endif
                            @else
                                @if(substr($symbol, -4) == 'USDT')
                                    @if($amount > 1)
                                        <span style="font-size: 30px; font-weight: 900;">{{number_format ($amount, 2)}} {{substr($symbol, 0, -4) }}</span>
                                    @else
                                        <span style="font-size: 30px; font-weight: 900;">{{number_format ($amount, 7)}} {{substr($symbol, 0, -4) }}</span>
                                    @endif
                                @else
                                    @if($amount > 1)
                                        <span style="font-size: 30px; font-weight: 900;">{{number_format ($amount, 2)}} {{substr($symbol, 0, -3) }}</span>
                                    @else
                                        <span style="font-size: 30px; font-weight: 900;">{{number_format ($amount, 7)}} {{substr($symbol, 0, -3) }}</span>
                                    @endif
                                @endif
                            @endif
                            @if(empty($lockeddays))
                            
                            @else
                                @if(substr($symbol, -4) == 'USDT')
                                    <div style="padding-top: 8px;">
                                        @if($earnings > 1)
                                        <span style="font-size: 12px;">Estimated Auto Profit: <span style="color: green;"><strong>{{number_format ($earnings, 2)}} {{substr($symbol, 0, -4) }}</strong></span> After {{$lockeddays}} Days</span>
                                        @else
                                        <span style="font-size: 12px;">Estimated Auto Profit: <span style="color: green;"><strong>{{number_format ($earnings, 7)}} {{substr($symbol, 0, -4) }}</strong></span> After {{$lockeddays}} Days</span>
                                        @endif
                                    </div>
                                @else
                                <div style="padding-top: 8px;">
                                        @if($earnings > 1)
                                        <span style="font-size: 12px;">Estimated Auto Profit: <span style="color: green;"><strong>{{number_format ($earnings, 2)}} {{substr($symbol, 0, -3) }}</strong></span> After {{$lockeddays}} Days</span>
                                        @else
                                        <span style="font-size: 12px;">Estimated Auto Profit: <span style="color: green;"><strong>{{number_format ($earnings, 7)}} {{substr($symbol, 0, -3) }}</strong></span> After {{$lockeddays}} Days</span>
                                        @endif
                                </div>
                                @endif
                            @endif
                            
                            <input class="form-control" type="hidden" wire:model="crypto_symbol" id="crypto_symbol">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="">
                            Lock for {{$lockeddays}} Days
                            </label><input class="form-control" type="number" wire:model="lockeddays" min="30" id="days" required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="row">
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
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" type="checkbox" required>I agree to terms and conditions</label>
                        </div>                
                    </div>

                    <div class="col-lg-12">
                        <div style="padding-top: 20px;">
                            <button class="btn btn-success" type="submit"><div wire:loading wire:target="LockNowAmount"><div class="spinner-border" role="status"></div></div> Lock Now</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
        @endif
</div>