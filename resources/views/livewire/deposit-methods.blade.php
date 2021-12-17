<div class="content-i">
    <div class="content-box">
        <div class="row">                     
            
            <div class="col-lg-12">

                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">Cryptocurrency</h6>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="element-wrapper">

                            <div class="row">
                                @foreach($coingetaways as $val)
                                @if($folded == 1)
                                <div class="col-lg-2" onclick="" wire:click="inputamount({{$val->id}})" style="border-radius: 15px; @if($folded == 1) cursor: pointer; @else @if($getawayid == $val->id) @else cursor: pointer; @endif @endif">
                                @else
                                    @if($getawayid == $val->id)
                                    <div class="col-lg-2" style="border-radius: 15px; @if($folded == 1) cursor: pointer; @else @if($getawayid == $val->id) @else cursor: pointer; @endif @endif">
                                    @else
                                    <div class="col-lg-2" onclick="" wire:click="inputamount({{$val->id}})" style="border-radius: 15px; @if($folded == 1) cursor: pointer; @else @if($getawayid == $val->id) @else cursor: pointer; @endif @endif">
                                    @endif
                                @endif
                                    <div class="m-2">
                                        <div class="row">
                                            <div class="col-lg-12 hover-item" style="background: #4ba756; border-radius: 15px; @if($folded == 1) padding: 55px; @else @if($getawayid == $val->id) padding: 28px; @else padding: 55px; @endif @endif text-align: center; color: white;">
                                                
                                                @if($folded == 1)                                                    
                                                    <i class="cf cf-{{strtolower($val->symbol)}}" style="font-size: 90px;"></i><br>                                                    
                                                    <div style="padding-top: 10px;">
                                                        <span wire:loading.remove wire:target="inputamount({{$val->id}})" style="font-size: 20px; font-weight: 900;">{{$val->name}}</span>                                                            
                                                        <div wire:loading wire:target="inputamount({{$val->id}})" style="padding-bottom: 7px;"><div class="spinner-border" role="status"></div><span style="padding-left: 5px;">Loading</span></div><br>                                                        
                                                        Crypto Payment                                                        
                                                    </div>
                                                @else
                                                    @if($getawayid == $val->id)
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row" style="padding-bottom: 8px;">
                                                                <div class="col-lg-6" style="text-align: left;">
                                                                    <!--<div wire:loading style="padding-right: 5px;"><div class="spinner-border" role="status"></div><span style="padding-left: 5px;">Loading</span></div>-->
                                                                </div>

                                                                <div class="col-lg-6" onclick="" wire:click="foldclose" style="cursor: pointer; text-align: right;">
                                                                    Close
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="col-lg-3" style="padding-bottom: 8px;">
                                                                <i class="cf cf-{{strtolower($val->symbol)}}" style="font-size: 40px;"></i><br>
                                                            </div>

                                                            <div class="col-lg-9">
                                                                <div style="text-align: left; line-height: 1.1;">
                                                                    <span style="font-size: 100%; font-weight: 900;">{{$val->name}}</span><br>                                                                    
                                                                    <span style="font-size: 80%;">Crypto Payment</span>                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                            
                                                                <div style="padding-top: 10px;">                                                                    
                                                                    <input class="form-control" placeholder="Amount in USD" wire:model="amount" type="number" style="background: {{$noamount}};" required>
                                                                    @if($needtopay>1 || $needtopay == 0)
                                                                    <span style="font-size: 12px; padding-top: 8px;">Estimated: <strong>{{number_format($needtopay, 2)}} {{$val->symbol}}</strong></span>
                                                                    @else
                                                                    <span style="font-size: 12px; padding-top: 8px;">Estimated: <strong>{{number_format($needtopay, 6)}} {{$val->symbol}}</strong></span>
                                                                    @endif                                                                    
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12" style="padding-top: 8px;">                                                                
                                                                @if(empty($amount))
                                                                <button class="paybutton" wire:click="noamountclicked" style="outline: none;" type="button">No Amount</button>
                                                                @else                                                               
                                                                <div wire:loading.remove><button class="paybutton" wire:click="cryptodepositsub({{$amount}})" style="outline: none;" type="button">Deposit Now</button></div>
                                                                <div wire:loading><button class="paybutton active" wire:click="cryptodepositsub({{$amount}})" style="outline: none;" type="button">Deposit Now</button></div>
                                                                @endif
                                                            </div>                                                            
                                                        </div>
                                                    </div>

                                                    @else
                                                        @if($val->getaways_type == "coin")
                                                        <i class="cf cf-{{strtolower($val->symbol)}}" style="font-size: 90px;"></i><br>
                                                        @elseif($val->name == "Flutterwave")
                                                        <img width="90px" src="/images/getways/flutterwave_dark.png">
                                                        @endif
                                                        <div style="padding-top: 10px;">                                                            
                                                            <span wire:loading.remove wire:target="inputamount({{$val->id}})" style="font-size: 20px; font-weight: 900;">{{$val->name}}</span>                                                            
                                                            <div wire:loading wire:target="inputamount({{$val->id}})" style="padding-bottom: 7px;"><div class="spinner-border" role="status"></div><span style="padding-left: 5px;">Loading</span></div><br>
                                                            @if($val->getaways_type == "coin")
                                                            Crypto Payment
                                                            @elseif($val->name == "Flutterwave")
                                                            Bank Card
                                                            @endif
                                                        </div>
                                                    @endif
                                                    
                                                @endif

                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                @endforeach
                            </div>

                        </div>                        
                    </div>

                </div>
                
            </div>

            <div class="col-lg-12" id="cardmethods">

                <div class="row">
                    
                    <div class="col-lg-12">
                        <div class="element-wrapper">
                            <h6 class="element-header">Card & eWallets</h6>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="element-wrapper">

                            <div class="row">
                                @foreach($cardwalletsgetaways as $val)
                                @if($folded == 1)
                                <div class="col-lg-2" onclick="" wire:click="inputamount({{$val->id}})" style="border-radius: 15px; @if($folded == 1) cursor: pointer; @else @if($getawayid == $val->id) @else cursor: pointer; @endif @endif">
                                @else
                                    @if($getawayid == $val->id)
                                    <div class="col-lg-2" style="border-radius: 15px; @if($folded == 1) cursor: pointer; @else @if($getawayid == $val->id) @else cursor: pointer; @endif @endif">
                                    @else
                                    <div class="col-lg-2" onclick="" wire:click="inputamount({{$val->id}})" style="border-radius: 15px; @if($folded == 1) cursor: pointer; @else @if($getawayid == $val->id) @else cursor: pointer; @endif @endif">
                                    @endif
                                @endif
                                    <div class="m-2">
                                        <div class="row">
                                            <div class="col-lg-12 hover-item" style="background: #4ba756; border-radius: 15px; @if($folded == 1) padding: 55px; @else @if($getawayid == $val->id) padding: 28px; @else padding: 55px; @endif @endif text-align: center; color: white;">
                                                
                                                @if($folded == 1)
                                                    @if($val->name == "Flutterwave")                                                    
                                                    <img width="90px" src="/images/getways/flutterwave_dark.png">
                                                    @elseif($val->name == "Stripe")
                                                    <img width="90px" src="/images/getways/stripe_dark.png">
                                                    @elseif($val->name == "PayPal")
                                                    <img width="90px" src="/images/getways/PayPal_dark.png">
                                                    @elseif($val->name == "PerfectMoney")
                                                    <img width="90px" src="/images/getways/perfectmoney_dark.png">
                                                    @endif
                                                    <div style="padding-top: 10px;">
                                                        <span wire:loading.remove wire:target="inputamount({{$val->id}})" style="font-size: 20px; font-weight: 900;">{{$val->name}}</span>                                                            
                                                        <div wire:loading wire:target="inputamount({{$val->id}})" style="padding-bottom: 7px;"><div class="spinner-border" role="status"></div><span style="padding-left: 5px;">Loading</span></div><br>
                                                        @if($val->getaways_type == "card")
                                                        Bank Card
                                                        @elseif($val->getaways_type == "ewallet")
                                                        eWallet Payment
                                                        @endif
                                                    </div>                                                    
                                                @else
                                                    @if($getawayid == $val->id)
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="row" style="padding-bottom: 8px;">
                                                                <div class="col-lg-6" style="text-align: left;">
                                                                    <!--<div wire:loading style="padding-right: 5px;"><div class="spinner-border" role="status"></div><span style="padding-left: 5px;">Loading</span></div>-->
                                                                </div>

                                                                <div class="col-lg-6" onclick="" wire:click="foldclose" style="cursor: pointer; text-align: right;">
                                                                    Close
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12">
                                                            <div class="col-lg-3" style="padding-bottom: 8px;">
                                                                @if($val->name == "Flutterwave")                                                                
                                                                <img width="40px" src="/images/getways/flutterwave_dark.png">
                                                                @elseif($val->name == "Stripe")
                                                                <img width="40px" src="/images/getways/stripe_dark.png">
                                                                @elseif($val->name == "PayPal")
                                                                <img width="40px" src="/images/getways/PayPal_dark.png">
                                                                @elseif($val->name == "PerfectMoney")
                                                                <img width="40px" src="/images/getways/perfectmoney_dark.png">
                                                                @endif
                                                            </div>

                                                            <div class="col-lg-9">
                                                                <div style="text-align: left; line-height: 1.1;">
                                                                    <span style="font-size: 100%; font-weight: 900;">{{$val->name}}</span><br>
                                                                    @if($val->getaways_type == "card")
                                                                    <span style="font-size: 80%;">Bank Card</span>
                                                                    @elseif($val->getaways_type == "ewallet")
                                                                    <span style="font-size: 80%;">eWallet Payment</span>                                                    
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12">
                                                                <div style="padding-top: 10px;">
                                                                    <form>
                                                                        <input class="form-control" placeholder="Amount in USD" wire:model="amount" type="number" style="background: {{$noamount}};" required>
                                                                        @if($val->getaways_type == "coin")
                                                                            @if($needtopay>1 || $needtopay == 0)
                                                                            <span style="font-size: 12px; padding-top: 8px;">Need to Pay: <strong>{{number_format($needtopay, 2)}} {{$val->symbol}}</strong></span>
                                                                            @else
                                                                            <span style="font-size: 12px; padding-top: 8px;">Need to Pay: <strong>{{number_format($needtopay, 6)}} {{$val->symbol}}</strong></span>
                                                                            @endif
                                                                        @else
                                                                        <span style="font-size: 12px; padding-top: 8px;">Need to Pay: <strong>${{number_format($needtopay, 2)}}</strong></span>
                                                                        @endif
                                                                    </form>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-12" style="padding-top: 8px;"> 
                                                                @if(empty($amount))
                                                                <button class="paybutton" wire:click="noamountclicked" style="outline: none;" type="button">No Amount</button>
                                                                @else                                                               
                                                                <div wire:loading.remove><button class="paybutton" wire:click="cardorewalletpay({{$amount}})" style="outline: none;" type="button">Deposit Now</button></div>
                                                                <div wire:loading><button class="paybutton active" wire:click="cardorewalletpay({{$amount}})" style="outline: none;" type="button">Deposit Now</button></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @else
                                                        @if($val->name == "Flutterwave")                                                       
                                                        <img width="90px" src="/images/getways/flutterwave_dark.png">
                                                        @elseif($val->name == "Stripe")
                                                        <img width="90px" src="/images/getways/stripe_dark.png">
                                                        @elseif($val->name == "PayPal")
                                                        <img width="90px" src="/images/getways/PayPal_dark.png">
                                                        @elseif($val->name == "PerfectMoney")
                                                        <img width="90px" src="/images/getways/perfectmoney_dark.png">
                                                        @endif
                                                        <div style="padding-top: 10px;">
                                                            <span wire:loading.remove wire:target="inputamount({{$val->id}})" style="font-size: 20px; font-weight: 900;">{{$val->name}}</span>                                                            
                                                            <div wire:loading wire:target="inputamount({{$val->id}})" style="padding-bottom: 7px;"><div class="spinner-border" role="status"></div><span style="padding-left: 5px;">Loading</span></div><br>
                                                            @if($val->getaways_type == "card")
                                                            Bank Card
                                                            @elseif($val->getaways_type == "ewallet")
                                                            eWallet Payment
                                                            @endif                                                            
                                                        </div>
                                                    @endif
                                                    
                                                @endif

                                            </div>
                                        </div>
                                    </div>    
                                </div>
                                @endforeach
                            </div>

                        </div>                        
                    </div>

                </div>
                
            </div>

        </div>
    </div>
</div>
