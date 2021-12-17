<div>
    <div class="element-box">
            <form wire:submit.prevent="buyminingdevices">
            
                <div class="row">
                    
                    <div class="col-lg-8">
                        <div class="form-group">
                            <label for="">Device</label>
                            <select class="form-control" wire:model="deviceid" required>
                                <option value="" style="color: gray;">
                                    Select a Device
                                </option> 
                                @foreach($devices as $lists)
                                <option value="{{$lists->id}}" style="color: gray;">
                                    {{$lists->name}} - {{$lists->power_khs}} kh/s
                                </option>                                
                                @endforeach                                   
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for=""> Quantity</label><input class="form-control" wire:model="dqty" type="number" required>                            
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="">Select Coin</label>
                            <select class="form-control" wire:model="coinid" required> 
                                <option value="" style="color: gray;">
                                    Select a Coin
                                </option>                               
                                @foreach($setminingc as $lists)
                                <option value="{{$lists->symbol}}" style="color: gray;">
                                    {{$lists->name}} / {{$lists->symbol}}
                                </option>                                
                                @endforeach                                   
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <hr>
                                    <p>Estimated Cost: <strong>${{$cost}}</strong></p>  
                                    <hr>
                                    <p>Installation Fees: <strong>${{$deviceintfees}}</strong></p>  
                                    <hr>
                                    <p>Mining Power: {{$khs}} kH/s</p> 
                                    <hr>
                                    <p>kWHS: {{$kwhs}}</p> 
                                    <hr>
                                </div> 
                                
                                <div class="col-lg-6" style="margin-top: 12%; text-align: center;">
                                    <p>{{$devicename}}<br>
                                    Your approx. income with <strong>{{$set->name}}</strong><br>
                                    @if(auth()->user()->theme_set == 1)
                                    <span style="font-size: 35px;"><strong><span style="color: green;">{{$earnings}} USD</span></strong></span> <span>/ Day</span> 
                                    @else
                                    <span style="font-size: 35px;"><strong>{{$earnings}} USD</strong></span> <span>/ Day</span>
                                    @endif                                      
                                    </p>
                                </div> 
                            </div>                        
                        </div>
                    </div>                  
                         
                    <div class="col-lg-12">
                        <div class="form-check">
                            <label class="form-check-label"><input class="form-check-input" type="checkbox">I agree to terms and conditions</label>
                        </div>   

                        <div class="form-buttons-w">
                            <button class="btn btn-primary" type="submit"><div wire:loading wire:target="buyminingdevices"><div class="spinner-border" role="status"></div></div> Buy Now</button>
                        </div>
                    </div>                     
                </div>
        </form>
    </div>
</div>
