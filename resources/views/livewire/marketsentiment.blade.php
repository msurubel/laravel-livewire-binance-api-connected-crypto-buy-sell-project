<div class="row" wire:poll="refreshalldata">

    <div class="col-lg-6" style="color: gray;">
        @if(substr($symbol, -4) == 'USDT')
        <p>Share your prediction for see next 15 days sentiment of <strong>{{substr($symbol, 0, -4)}}</strong> and earn ${{$set->prediction_earning}} for your prediction. You can add pradiction every 7 days.</p>
        @else
        <p>Share your prediction for see next 15 days sentiment of <strong>{{substr($symbol, 0, -3)}}</strong> and earn ${{$set->prediction_earning}} for your prediction. You can add pradiction every 7 days.</p>
        @endif
    </div>

    <div class="col-lg-6">        
        @if($addsentiment == 1)
            @if($pubdaycount == 2)
            <div><span>Next 15 Days sentiment</span>  <span style="color: green;">{{number_format ($percent, 2)}}% Up Trend</span></div>
            <style>
                .progress{ position: relative; background: red; }
                .percent{ position: absolute; left: 50%; top: 0;}
            </style>
            <div class="progress">
                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: {{number_format ($percent, 2)}}%">
                <div class="percent"></div>
                </div>
            </div>
            @else
            <button class="btn btn-success" wire:click="addbuypradiction" type="button"><span wire:loading.remove wire:target="addbuypradiction" style="padding-right: 5px;"><i class="os-icon os-icon-arrow-up5"></i></span><span><div wire:loading wire:target="addbuypradiction" style="padding-right: 5px;"><div class="spinner-border" role="status"></div></div> Up Trend</span></button>
        <button class="btn btn-danger" wire:click="addsellpradiction" type="button"><span wire:loading.remove wire:target="addsellpradiction" style="padding-right: 5px;"><i class="os-icon os-icon-arrow-down5"></i></span><span><div wire:loading wire:target="addsellpradiction" style="padding-right: 5px;"><div class="spinner-border" role="status"></div></div> Down Trend</span></button>   
        @endif
        @else        
        <button class="btn btn-success" wire:click="addbuypradiction" type="button"><span wire:loading.remove wire:target="addbuypradiction" style="padding-right: 5px;"><i class="os-icon os-icon-arrow-up5"></i></span><span><div wire:loading wire:target="addbuypradiction" style="padding-right: 5px;"><div class="spinner-border" role="status"></div></div> Up Trend</span></button>
        <button class="btn btn-danger" wire:click="addsellpradiction" type="button"><span wire:loading.remove wire:target="addsellpradiction" style="padding-right: 5px;"><i class="os-icon os-icon-arrow-down5"></i></span><span><div wire:loading wire:target="addsellpradiction" style="padding-right: 5px;"><div class="spinner-border" role="status"></div></div> Down Trend</span></button>      
        @endif
    </div>

</div>