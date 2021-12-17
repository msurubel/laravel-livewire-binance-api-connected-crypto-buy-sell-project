<div>
    <div class="element-box">
        <div class="row">
            <div class="col-lg-5">
                <form wire:submit.prevent="TransferPower">
                <div class="form-group">
                    <label for="">Select Coin</label>
                    <select class="form-control" wire:model="sender" required> 
                        <option value="" style="color: gray;">
                            @if (count($mscryptos) == 0)
                            No Active coins
                            @else
                            Select a Coin
                            @endif
                        </option>                               
                        @foreach($mscryptos as $lists)
                        <option value="{{$lists->symbol}}" style="color: gray;">
                            {{$lists->name}} / {{$lists->symbol}}
                        </option>                                
                        @endforeach                                   
                    </select>                    
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="">Select Coin</label>
                    <select class="form-control" wire:model="reciver" required> 
                        <option value="" style="color: gray;">
                            Select a Coin
                        </option>                               
                        @foreach($mrcryptos as $lists)
                        <option value="{{$lists->symbol}}" style="color: gray;">
                            {{$lists->name}} / {{$lists->symbol}}
                        </option>                                
                        @endforeach                                   
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group"> 
                    @if($notvalid == 1)  
                    @if($confirm == 1)
                    <div style="text-align: center; margin: 0; position: absolute; top: 55%; -ms-transform: translateY(-50%); transform: translateY(-50%);"><button class="btn btn-success" type="submit"><div wire:loading wire:target="TransferPower"><div class="spinner-border" role="status"></div></div> Confirm</button></div>                    
                    @else                 
                    <div style="text-align: center; margin: 0; position: absolute; top: 55%; -ms-transform: translateY(-50%); transform: translateY(-50%);"><button class="btn btn-primary" wire:click="PowerTransferConfirm" type="button"><div wire:loading wire:target="PowerTransferConfirm"><div class="spinner-border" role="status"></div></div> Transfer</button></div>
                    @endif
                    @else
                    <div style="color: red; text-align: center; margin: 0; position: absolute; top: 55%; -ms-transform: translateY(-50%); transform: translateY(-50%);">Sorry! Sender & Reciver same.</div>
                    @endif
                </div>
            </div>
            </form> 
            
        </div>
    </div>
</div>
