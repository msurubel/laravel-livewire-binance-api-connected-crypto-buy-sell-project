<div>
    <div class="element-box">
        <div class="row">
            <div class="col-lg-5">
                <form wire:submit.prevent="TransferFund">
                <div class="form-group">
                    <label for="">Select Coin</label>
                    <select class="form-control" wire:model="sender" required> 
                        <option value="" style="color: gray;">
                            Select a Coin
                        </option>                               
                        @foreach($minigcryptos as $lists)
                        <option value="{{$lists->symbol}}" style="color: gray;">
                            {{$lists->name}} / {{$lists->symbol}}
                        </option>                                
                        @endforeach                                   
                    </select>                    
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="">Select Transfer To</label>
                    <select class="form-control" wire:model="reciver" required>                                                     
                        
                        <option value="mainaccount" style="color: gray;">
                            Main Account
                        </option>
                        
                        <option value="{{$sender}}" style="color: gray;">
                            Crypto Wallet ({{$sender}})
                        </option> 
                                                        
                    </select>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="form-group"> 
                    @if($notvalid == 1)  
                    @if($confirm == 1)
                    <div style="text-align: center; margin: 0; position: absolute; top: 55%; -ms-transform: translateY(-50%); transform: translateY(-50%);"><button class="btn btn-success" type="submit"><div wire:loading wire:target="TransferFund"><div class="spinner-border" role="status"></div></div> Confirm</button></div>                    
                    @else                 
                    <div style="text-align: center; margin: 0; position: absolute; top: 55%; -ms-transform: translateY(-50%); transform: translateY(-50%);"><button class="btn btn-primary" wire:click="FundTransferConfirm" type="button"><div wire:loading wire:target="FundTransferConfirm"><div class="spinner-border" role="status"></div></div> Transfer</button></div>
                    @endif
                    @else
                    <div style="color: red; text-align: center; margin: 0; position: absolute; top: 55%; -ms-transform: translateY(-50%); transform: translateY(-50%);">Sorry! Can't Transfer</div>
                    @endif
                </div>
            </div>
            </form>

            
        </div>
    </div>
</div>
