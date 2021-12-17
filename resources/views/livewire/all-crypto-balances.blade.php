@if(auth()->user()->theme_set == 1) 
<div wire:poll="UpdateAssetsAll">
    <div class="os-tabs-w">
        <div class="os-tabs-controls os-tabs-complex">
            <ul class="nav nav-tabs">
            <li class="nav-item">
                <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#tab_overview"><span class="tab-label">Balance</span></a>
            </li>
            
            </ul>
        </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="element-balances justify-content-between mobile-full-width">
                    <div class="balance balance-v2">
                    <div class="balance-title">
                    Portfolio Balance
                    </div>                           

                    <div class="balance-value">
                        
                        <span class="d-xxl-none">${{number_format($totalbalance, 2)}}</span><span class="d-none d-xxl-inline-block">${{number_format($totalbalance, 2)}}</span></span>

                    </div>
                    </div>                           
                    
                </div>
                
                <!--
                <div class="element-wrapper pb-4 mb-4 border-bottom">
                    <div class="element-box-tp"> 
                        <button class="btn btn-primary" data-target=".deposit" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Deposit</span></button>                              
                        <button class="btn btn-gray" data-target=".withdraw" data-toggle="modal" type="button"><i class="os-icon os-icon-refresh-ccw"></i><span>Withdraw</span></button>
                    </div>                        
                </div>
                -->

                <!-- Deposit Model -->
                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade deposit" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            Deposit
                            </h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('account.deposit.process') }}">
                            @csrf
                            <div class="form-group">
                                <label for=""> Amount in USD</label><input class="form-control" name="amount" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deposit Method</label>
                                <select class="form-control" name="method" required>

                                @foreach($getaways as $val)
                                <option value="{{$val->id}}">
                                {{$val->name}}
                                </option>
                                @endforeach

                                </select>
                            </div>                                    
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Process</button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- Deposit Model -->

                <!-- Withdraw Model -->
                <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade withdraw" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            Withdraw
                            </h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('withdraw.money') }}">
                            @csrf
                            <div class="form-group">
                                <label for=""> Amount in USD</label><input class="form-control" name="amount" type="text" required>
                            </div>

                            <div class="form-group">
                                <label for=""> Transfer To Details</label><textarea class="form-control" name="details" style="height: 200px;" required></textarea>
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

            </div>

            <div class="col-lg-8">

                <!-- Balance Side Panel -->

            </div>
            

        </div>

        <br> 

    <div class="row">
        <div class="col-lg-12" style="padding-bottom: 20px;">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <input class="form-control" placeholder="Search Assets" wire:model="assets" type="text">
                    <div style="display: none;"><button class="btn btn-primary" wire:click="UpdateAssetsAll" type="button"> Update</button></div>
                </div>
            </div>
        </div>
        @if($found == 1)
    
        
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
        <div class="col-lg-12" style="text-align: center; padding: 100px;">
            <img alt="" width="200px" src="/img/noun_empty_wallet.svg"><br><br>
            <span style="font-weight: 500; color: green; font-size: 30px;">"{{$assets}}"</span> Not Found.<br><span style="font-size: 12px;">The Asset Not found or you have no balance to this asset.</span>
        </div>
        @endif
    </div>
</div>
@else
<div wire:poll.15s="UpdateAssetsAll">
    <div class="os-tabs-w">
        <div class="os-tabs-controls os-tabs-complex">
            <ul class="nav nav-tabs">
            <li class="nav-item">
                <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#tab_overview"><span class="tab-label">Balance</span></a>
            </li>
            
            </ul>
        </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="element-balances justify-content-between mobile-full-width">
                    <div class="balance balance-v2">
                    <div class="balance-title">
                    Portfolio Balance
                    </div>                           

                    <div class="balance-value">
                        
                    @include('user.livedata.get_balance')

                    </div>
                    </div>                           
                    
                </div>
                
                <!--
                <div class="element-wrapper pb-4 mb-4 border-bottom">
                    <div class="element-box-tp"> 
                        <button class="btn btn-primary" data-target=".deposit" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Deposit</span></button>                              
                        <button class="btn btn-gray" data-target=".withdraw" data-toggle="modal" type="button"><i class="os-icon os-icon-refresh-ccw"></i><span>Withdraw</span></button>
                    </div>                        
                </div>
                -->

                <!-- Deposit Model -->
                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade deposit" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            Deposit
                            </h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('account.deposit.process') }}">
                            @csrf
                            <div class="form-group">
                                <label for=""> Amount in USD</label><input class="form-control" name="amount" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deposit Method</label>
                                <select class="form-control" name="method" required>

                                @foreach($getaways as $val)
                                <option value="{{$val->id}}">
                                {{$val->name}}
                                </option>
                                @endforeach

                                </select>
                            </div>                                    
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Process</button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- Deposit Model -->

                <!-- Withdraw Model -->
                <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade withdraw" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            Withdraw
                            </h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('withdraw.money') }}">
                            @csrf
                            <div class="form-group">
                                <label for=""> Amount in USD</label><input class="form-control" name="amount" type="text" required>
                            </div>

                            <div class="form-group">
                                <label for=""> Transfer To Details</label><textarea class="form-control" name="details" style="height: 200px;" required></textarea>
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

            </div>

            <div class="col-lg-8">

                <!-- Balance Side Panel -->

            </div>
            

        </div>

        <br> 

    <div class="row">
        <div class="col-lg-12" style="padding-bottom: 20px;">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                    <input class="form-control" placeholder="Search Assets" wire:model="assets" type="text">
                </div>
            </div>
        </div>
        @if($found == 1)   
        
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
    
        @else
        <div class="col-lg-12" style="text-align: center; padding: 100px;">
            <img alt="" width="200px" src="/img/noun_empty_wallet_white.svg"><br><br>
            <span style="font-weight: 500; color: green; font-size: 30px;">"{{$assets}}"</span> Not Found.<br><span style="font-size: 12px;">The Asset Not found or you have no balance to this asset.</span>
        </div>
        @endif
    </div>
</div>
@endif


<script type='text/javascript'>
    //Store your button reference at a "global" level
    var button2 = document.getElementById('AutoClick');

    //Trigger your event every 3 seconds
    setInterval(function () { button2.click(); }, 3000);
</script>