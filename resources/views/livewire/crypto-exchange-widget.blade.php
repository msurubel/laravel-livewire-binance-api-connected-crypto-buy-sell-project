@if($exchangep == 1)
<div>
    @if(empty($paysymbol) || empty($getsymbol))
    <div class="row">
    @else
    <div class="row" wire:poll.15s="pricerefresh">
    @endif
        <form wire:submit.prevent="exchangeorder">
            <div class="col-12"> 
                <div class="row" style="background: #5abb66; color: white;">
                    <div class="col-lg-12" style="background: #2d7837;">
                        <div style="padding: 30px; text-align: center;">
                            <div wire:loading.delay><div class="spinner-border" role="status"></div></div> <img width="150px" src="/img/settings/{{$set->image_logow}}">
                        </div>
                    </div>
                    <hr>        
                    <div style="padding: 30px;">            
                        <div class="col-lg-12">
                            <div style="padding: 5px; text-align: center;">
                                <p style="font-size: 30px; font-weight: 900;">Faster Exchanger<br><span style="font-size: 12px; font-weight: 300;">Referred By: {{$refname}}</span></p>
                            </div>
                        </div>            
                        <div class="col-lg-12">
                            <div style="padding: 10px;">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Pay Symbol <span wire:loading.remove wire:target="updated"><strong>{{$payinvalid}}</strong></label></span>
                                            <input class="form-control" wire:model="paysymbol" style="text-transform:uppercase; background-color: {{$payinvalidcolor}};" placeholder="write crypto Symbol" maxlength="6" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Amount {{strtoupper($paysymbol)}}</label>
                                            @if($btnhide == 2)
                                            <input class="form-control" wire:model.defer="payamount" step="any" type="number" required>
                                            @else
                                            <input class="form-control" wire:model.defer="payamount" step="any" type="number" readonly required>
                                            @endif
                                            <input class="form-control" wire:model="inputfeestotal" type="hidden">
                                            <input class="form-control" wire:model="inputfeesusd" type="hidden">
                                            <input class="form-control" wire:model="userrefid" type="hidden">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div style="padding: 10px;">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Get Symbol <span wire:loading.remove wire:target="updated"><strong>{{$getinvalid}}</strong></label></span>
                                            <input class="form-control" placeholder="write crypto Symbol" style="text-transform:uppercase; background-color: {{$getinvalidcolor}};" wire:model="getsymbol" maxlength="6" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="">Get Amount</label>                                        
                                            <span style="font-size: 20px; font-weight: 900;"><p>@if($getamount>1){{number_format($getamount, 2)}}@else{{number_format($getamount, 8)}}@endif <span style="font-size: 15px;">{{strtoupper($getsymbol)}}</span></p></span>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div style="padding: 10px;">
                                <div class="form-group">
                                    <label for="">Get Wallet Address</label>
                                    <input class="form-control" wire:model.defer="getaddress" type="text" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">                        
                            <div style="padding: 10px; text-align: center;">
                                @if(empty($feesusd))

                                @else
                                <p>Total Payable Amount: {{number_format ($feestotal, 6)}} {{strtoupper($paysymbol)}}</p>
                                @endif
                                @if($btnhide == 2)
                                
                                    @if($payinvalid == "Not Valid!" || $getinvalid == "Not Valid!")
                                        <div wire:loading.remove>
                                            <button class="btn btn-danger" type="button"><div wire:loading wire:target="exchangeorder"><div class="spinner-border" role="status"></div></div> A Symbol Not Valid</button>                                
                                        </div>
                                        <div wire:loading><button class="btn btn-danger" type="button"><div class="spinner-border" role="status"></div> Update....</button></div>
                                    @else
                                        <div wire:loading.remove>
                                            <button class="btn btn-primary" type="submit"><div wire:loading wire:target="exchangeorder"><div class="spinner-border" role="status"></div></div> Exhange Now</button>                                
                                        </div>
                                        <div wire:loading><button class="btn btn-primary" type="button"><div class="spinner-border" role="status"></div> Update....</button></div>
                                    @endif
                                @else
                                <p>Your Get & Pay Crypto is Same!</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div style="padding: 10px; text-align: center;">
                                <p>All Exchange order complete instantly, But you get the coin when network is confirmed.</a>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div style="text-align: center;">
                                <p>Powered By <a href="{{url('/')}}" target="_blank">{{$set->name}}</a>
                            </div>
                        </div>            
                    </div> 
                </div>   
            </div>
        </from> 
    </div>    
</div>
@elseif($exchangep == 2)
<div>
    <div class="row" style="background: #5abb66; color: white; text-align: center;">
        <div class="col-lg-12" style="background: #2d7837;">
            <div style="padding: 30px;">
                <img width="150px" src="/img/settings/{{$set->image_logow}}">
            </div>
        </div>
        <hr>        
        <div style="padding: 30px;">            
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <p style="color: #A8EBB0;">Ref. ID <strong>{{$trxid}}</strong></p>
                    </div>
                    <div class="col-lg-12">                        
                        <h5>Payment Details Bellow</h5>                        
                        <h1 style="font-weight: 900;">@if($feestotal>1){{number_format ($feestotal, 2)}}@else{{number_format ($feestotal, 8)}}@endif <span style="font-size: 20px; font-weight: 900;">{{strtoupper($paysymbolp)}}</span> </h1>                       
                        <img alt="" width="40px" src="/img/arrow-down.gif">
                        <p>Please Send exect avobe amount to the address bellow</p>
                        {!! QrCode::backgroundColor(240, 240, 240)->size(165)->generate($payaddress) !!}<br>
                        <div style="padding: 25px;">
                        <p><span style="font-size: 60%; color: green; border-color: gray; border-style: solid; border-width: thin; padding: 10px; border-radius: 25px;"><strong>{{$payaddress}}</strong></span></p> 
                        </div> 
                    </div>

                    <div class="col-lg-12">                        
                        <form wire:submit.prevent="addTrxID">
                        <div class="form-group">
                            <input class="form-control" wire:model="txid" style="text-transform:uppercase" placeholder="write txid of your transection" type="text" required>
                        </div>
                        <div class="buttons-w">                            
                            <button class="btn btn-primary" type="submit"><div wire:loading wire:target="addTrxID"><div class="spinner-border" role="status"></div></div> Add TrxID</button>
                        </div>
                        </form>
                        <br>
                    </div>

                    </div>
            </div>     
        </div>        
    </div>    
</div>     
@elseif($exchangep == 3)
<div>
    <div class="row" style="background: #5abb66; color: white; text-align: center;">
        <div class="col-lg-12" style="background: #2d7837;">
            <div style="padding: 30px;">
                <img width="150px" src="/img/settings/{{$set->image_logow}}">
            </div>
        </div>
        <hr>        
        <div style="padding: 30px;">            
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <p style="color: #A8EBB0;">Ref. ID <strong>{{$trxid}}</strong></p>
                    </div>
                    <div class="col-lg-12">                        
                        <h5>Order Submited</h5>                        
                        <h1 style="font-weight: 900;">@if($getamount>1){{number_format ($getamount, 2)}}@else{{number_format ($getamount, 8)}}@endif <span style="font-size: 20px; font-weight: 900;">{{strtoupper($getsymbol)}}</span> </h1>                       
                        <img width="280px" src="/images/order-complete-01.svg">
                    </div>                    
                    <div class="col-lg-12">
                        <br>
                        <p>Your order has been successfully submitted, please wait 15-30 minutes to execute the order or transfer to the wallet address of your choice. If the order is not complete within this time please send an email to <strong>{{$set->email_id}}</strong> with your <strong>RefID: {{$trxid}}</strong><p>
                        <button class="btn btn-primary" wire:click="backtohome" type="button"><div wire:loading wire:target="backtohome"><div class="spinner-border" role="status"></div></div> Back to Home</button>
                    </div>

                    </div>
            </div>     
        </div>        
    </div>    
</div>       
@endif

<script type='text/javascript'>
    //Store your button reference at a "global" level
    var button2 = document.getElementById('AutoClick');

    //Trigger your event every 3 seconds
    setInterval(function () { button2.click(); }, 30000);
</script>

