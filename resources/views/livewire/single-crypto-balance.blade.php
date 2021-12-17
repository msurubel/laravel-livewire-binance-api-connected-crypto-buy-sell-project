<div wire:poll="UpdateAssetsAll">
    <div class="element-balances justify-content-between mobile-full-width">
        <div class="balance balance-v2">
        <div class="balance-title">
        {{ app('request')->input('name') }} 
        </div>                           

        <div class="balance-value">
        
            @if($buycryptoblnc > 1 || $buycryptoblnc == 0)
            <span class="d-xxl-none">{{number_format ( $buycryptoblnc, 2 ) }}</span><span class="d-none d-xxl-inline-block">{{number_format ( $buycryptoblnc, 2 ) }}</span></span><div style="margin-left: 102%;">@livewire('single-crypto-u-s-d-balance', ['symbol' => "{$getsymbol}"])</div>
            @else
            <span class="d-xxl-none">{{number_format ( $buycryptoblnc, 6 ) }}</span><span class="d-none d-xxl-inline-block">{{number_format ( $buycryptoblnc, 6 ) }}</span></span><div style="margin-left: 102%;">@livewire('single-crypto-u-s-d-balance', ['symbol' => "{$getsymbol}"])</div>
            @endif
        
        </div>
        </div>
    </div>
    
    <div class="row" style="padding-bottom: 20px;">

        <div class="col-lg-6">
            <div class="buy-range tablebox" style="padding: 15px;">
                @if(substr($symbol, -4) == 'USDT')
                    <span style="font-size: 13px; font-weight: 500;">Locked Amount</span><br>
                    @if($lockedamount > 1 || $lockedamount == 0)
                    <span style="font-size: 25px; font-weight: 900;">{{number_format($lockedamount, 2)}} {{substr($symbol, 0, -4)}}</span>
                    @else
                    <span style="font-size: 25px; font-weight: 900;">{{number_format($lockedamount, 7)}} {{substr($symbol, 0, -4)}}</span>
                    @endif
                @else
                    <span style="font-size: 13px; font-weight: 500;">Locked Amount</span><br>
                    @if($lockedamount > 1 || $lockedamount == 0)
                    <span style="font-size: 25px; font-weight: 900;">{{number_format($lockedamount, 2)}} {{substr($symbol, 0, -3)}}</span>
                    @else
                    <span style="font-size: 25px; font-weight: 900;">{{number_format($lockedamount, 7)}} {{substr($symbol, 0, -3)}}</span>
                    @endif
                @endif
            </div>
        </div>

        @if($showprofitwithdraw == 1)
        <div class="col-lg-6" wire:click="lockedprofitfolded">
            <div class="buy-range tablebox" style="padding: 15px;">
                <span style="font-size: 13px; font-weight: 500;"><div wire:loading wire:target="lockedprofitfolded"><div class="spinner-border" role="status"></div></div> Auto Profit</span><br>
                @if(substr($symbol, -4) == 'USDT')
                    @if($lockedamount > 1 || $lockedamount == 0)
                        <span style="font-size: 25px; font-weight: 900;">{{number_format($lockedamountprofit, 2)}} {{substr($symbol, 0, -4)}}</span>
                    @else
                        <span style="font-size: 25px; font-weight: 900;">{{number_format($lockedamountprofit, 7)}} {{substr($symbol, 0, -4)}}</span>
                    @endif
                @else
                    @if($lockedamount > 1 || $lockedamount == 0)
                        <span style="font-size: 25px; font-weight: 900;">{{number_format($lockedamountprofit, 2)}} {{substr($symbol, 0, -3)}}</span>
                    @else
                        <span style="font-size: 25px; font-weight: 900;">{{number_format($lockedamountprofit, 7)}} {{substr($symbol, 0, -3)}}</span>
                    @endif
                @endif
            </div>
        </div>
        @else
        <div class="col-lg-6" style="text-align: center;">
            <div style="padding: 4px; border-style: solid; border-color: gray; border-width: 1px;">
                @if(substr($symbol, -4) == 'USDT')
                <span style="font-size: 10px; font-weight: 500;">Auto Profit Withdraw <span onclick="" wire:click="lockedprofitfoldedclose" style="color: blue; cursor: pointer;">Close</span></span><br>
                    @if($lockedamount > 1 || $lockedamount == 0)
                        <span style="font-size: 15px; font-weight: 900;">{{number_format($lockedamountprofit, 2)}} {{substr($symbol, 0, -4)}}</span>
                    @else
                        <span style="font-size: 15px; font-weight: 900;">{{number_format($lockedamountprofit, 7)}} {{substr($symbol, 0, -4)}}</span>
                    @endif
                @else
                <span style="font-size: 10px; font-weight: 500;">Auto Profit Withdraw <span onclick="" wire:click="lockedprofitfoldedclose" style="color: blue; cursor: pointer;">Close</span></span><br>
                    @if($lockedamount > 1 || $lockedamount == 0)
                        <span style="font-size: 15px; font-weight: 900;">{{number_format($lockedamountprofit, 2)}} {{substr($symbol, 0, -4)}}</span>
                    @else
                        <span style="font-size: 15px; font-weight: 900;">{{number_format($lockedamountprofit, 7)}} {{substr($symbol, 0, -4)}}</span>
                    @endif
                @endif<br>
                <div style="padding-top: 5px;">
                    <button class="mr-2 mb-2 btn btn-success btn-sm" type="button"><div wire:loading wire:target="LockedProfitWithdraw"><div class="spinner-border" role="status"></div></div> Withdraw Now</button>
                </div>
            </div>
        </div>
        @endif
    </div>

    <div class="element-wrapper pb-4 mb-4 border-bottom">
        <div class="element-box-tp">
            
            @if($buycryptoblnc==0)
                @if(substr(app('request')->input('symbol'), -4) == 'USDT')
                    You have <span style="color: red;">No {{ substr($symbol, 0, -4) }} Balance</span> please buy some using {{ substr($symbol, -4) }} Balance for see additional functions or view <a href="/dashboard/cryptos/all">All Coins</a>.
                @else
                    You have <span style="color: red;">No {{ substr($symbol, 0, -3) }} Balance</span> please buy some using {{ substr($symbol, -3) }} Balance for see additional functions or view <a href="/dashboard/cryptos/all">All Coins</a>.
                @endif
            @else

            
            @livewire('single-crypto-buttons', ['symbol' => "{$symbol}"])


                      
            @endif
        </div>

    </div>
</div>
