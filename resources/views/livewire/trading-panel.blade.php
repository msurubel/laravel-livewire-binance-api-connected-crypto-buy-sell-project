<div>
<form wire:submit.prevent="cryptobuy">
                                                
                                                <h5 class="form-header">
                                                    Buy {{ app('request')->input('name') }}
                                                </h5>
                                                <div class="form-desc">
                                                    The order Execute if you have money on your Main Account Blance, Please deposit your Main Account Balance before place {{ app('request')->input('name') }} BUY Order Your Avilable Balance <span style="color: green;"><strong>
                                                    @if(substr(app('request')->input('symbol'), -4) == 'USDT')
                                                    {{ number_format( $sellcryptoblnc, 2) }} USDT
                                                    @else
                                                    {{ number_format( $sellcryptoblnc, 6)}} {{substr(app('request')->input('symbol'), -3)}}
                                                    @endif
                                                </strong></span>
                                                </div>
                                                @if(app('request')->input('details') == 'Active')

                                                    @if(substr(app('request')->input('symbol'), -4) == 'USDT')
                                                    <p>Total Cost: <span style="color: red;">-{{ number_format (app('request')->input('cost'), 10) }}</span> {{substr(app('request')->input('symbol'), -4) }}</p>
                                                    @else
                                                    <p>Total Cost: <span style="color: red;">-{{ number_format (app('request')->input('cost'), 10) }}</span> {{substr(app('request')->input('symbol'), -3) }}</p>
                                                    @endif

                                                @else
                                                @endif
                                                <div class="form-group">
                                                    @if(substr(app('request')->input('symbol'), -4) == 'USDT')
                                                    <label for="">Amount ({{substr(app('request')->input('symbol'), 0, -4) }})</label>
                                                    @else
                                                    <label for="">Amount ({{substr(app('request')->input('symbol'), 0, -3) }})</label>
                                                    @endif
                                                    <input class="form-control" wire:model="amount" value="{{$amount}}" name="amount" type="text" required>
                                                    <input class="form-control" value="{{app('request')->input('symbol')}}" name="symbol" wire:model="symbol" type="hidden">
                                                </div>                                            
                                                
                                                <div class="form-check">
                                                    <label class="form-check-label"><input class="form-check-input" type="checkbox" required>I agree to terms and conditions</label>
                                                </div>
                                                <div class="form-buttons-w">
                                                    <button class="btn btn-success" onclick="actionbuybutton(this)" type="submit"> Buy Now</button>
                                                    <div id="buyprocessingtext"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                                                    <script>
                                                    const actionbuybutton = (element) => {
                                                        element.hidden = true;                                                    
                                                        document.getElementById('buyprocessingtext').style.display = "block";
                                                        
                                                    }
                                                    </script>                                                
                                                </div>
                                            </form>
</div>
