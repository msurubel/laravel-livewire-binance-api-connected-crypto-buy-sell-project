@extends('layouts.dashboard')
@section('content')

<div style="padding-top: 100px; padding-bottom: 100px;">
    <div class="row" style="padding: 30px;">

        <div class="col-lg-2" style="text-align: center;">

        </div>

        @if(auth()->user()->theme_set == 1)
        <div class="col-lg-8 hover-item" style="text-align: center; background: #F0F0F0; border-radius: 20px;">
            
            <div class="row">

                <div class="col-lg-12" style="background: #5ABB66; border-radius: 20px 20px 0px 0px; padding-top: 30px; padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                    <p style="font-size: 20px; color: #A8EBB0;">Ref. ID <strong>{{app('request')->input('ref_id')}}</strong></p>
                </div>

                <div class="col-lg-12" style="padding: 50px;">
                    <img alt="" width="80px" src="/img/loading-2.gif">
                    <br><br>
                    <h5>Deposit Details Bellow</h5><br><br>
                    @if(app('request')->input('payamount') > 1)
                    <h1>{{number_format(app('request')->input('payamount'), 2)}}</h1><p>{{app('request')->input('paymethod')}}</p>
                    @else
                    @if(app('request')->input('paymethod') == "USDT")
                    <h1>{{app('request')->input('payamount')}}</h1><p>{{app('request')->input('paymethod')}}</p>
                    @else
                    <h1>{{number_format(app('request')->input('payamount'), 8)}}</h1><p>{{app('request')->input('paymethod')}}</p>
                    @endif
                    @endif
                    <img alt="" width="40px" src="/img/arrow-down.gif">
                    <p>Please Send exect avobe amount to the address bellow</p>
                    {!! QrCode::backgroundColor(240, 240, 240)->size(200)->generate(app('request')->input('payaddress')) !!}<br>
                    <div style="padding: 25px;">
                    <p><span style="font-size: 90%; color: green; border-color: gray; border-style: solid; border-width: thin; padding: 10px; border-radius: 25px;"><strong>{{app('request')->input('payaddress')}}</strong></span></p> 
                    </div> 
                </div>

                <div class="col-lg-12" style="background: #3B3B3C; border-radius: 0px 0px 20px 20px; padding: 15px;">
                    <div class="buttons-w">
                        <p style="color: white;">Pleae add your <strong>TxID</strong> if you already complet your transection.<p>
                        <button class="btn btn-primary" data-target=".addtrxid" data-toggle="modal">Add TrxID</button>
                    </div>
                    <br>
                </div>

            </div>

        </div>
        @else
        <div class="col-lg-8 hover-item" style="text-align: center; background: #21283a; border-radius: 20px;">
            
            <div class="row">

                <div class="col-lg-12" style="background: #5ABB66; border-radius: 20px 20px 0px 0px; padding-top: 30px; padding-bottom: 20px; padding-left: 20px; padding-right: 20px;">
                    <p style="font-size: 20px; color: #A8EBB0;">Ref. ID <strong>{{app('request')->input('ref_id')}}</strong></p>
                </div>

                <div class="col-lg-12" style="padding: 50px;">
                    <img alt="" width="80px" src="/img/loading-2.gif">
                    <br><br>
                    <h5>Deposit Details Bellow</h5><br><br>
                    @if(app('request')->input('payamount') > 1)
                    <h1>{{number_format(app('request')->input('payamount'), 2)}}</h1><p>{{app('request')->input('paymethod')}}</p>
                    @else
                    <h1>{{number_format(app('request')->input('payamount'), 8)}}</h1><p>{{app('request')->input('paymethod')}}</p>
                    @endif
                    <img alt="" width="40px" src="/img/arrow-down.gif">
                    <p>Please Send exect avobe amount to the address bellow</p>
                    {!! QrCode::backgroundColor(240, 240, 240)->size(200)->generate(app('request')->input('payaddress')) !!}<br>
                    <div style="padding: 25px;">
                    <p><span style="font-size: 90%; color: green; border-color: gray; border-style: solid; border-width: thin; padding: 10px; border-radius: 25px;"><strong>{{app('request')->input('payaddress')}}</strong></span></p> 
                    </div> 
                </div>

                <div class="col-lg-12" style="background: #3B3B3C; border-radius: 0px 0px 20px 20px; padding: 15px;">
                    <div class="buttons-w">
                        <p>Pleae add your <strong>TxID</strong> if you already complet your transection.<p>
                        <button class="btn btn-primary" data-target=".addtrxid" data-toggle="modal">Add TrxID</button>
                    </div>
                    <br>
                </div>

            </div>

        </div>
        @endif

        <div class="col-lg-2" style="text-align: center;">
        
        </div>

    </div>
</div>


                                <!-- Deposit Model -->
                                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade addtrxid" role="dialog" tabindex="-1">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                            Add your {{app('request')->input('paymethod')}} TxID
                                            </h5>
                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('account.deposit.txid') }}">
                                            @csrf                                           
                                            <div class="form-group">
                                                <label for=""> TxID</label><input class="form-control" name="cryptotxid" type="text" required>
                                                <input class="form-control" value="{{app('request')->input('ref_id')}}" name="ref_id" type="hidden">
                                            </div> 
                                            <div class="form-group" id="txidmassagess" style="display: none;">
                                                <p>Adding your TxID, <strong>Please don't do any other operation and refresh your browser now.</strong></p>
                                            </div>                                                                   
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" id="txidcloseoff" data-dismiss="modal" type="button"> Close</button><button class="btn btn-success" onclick="addmoneyaddtxidnow(this)" type="submit"> Confirm</button>
                                            <div id="txidprocessimage"  style="display:none;" ><img alt="" width="20px" src="/img/loading-2.gif">  <span style="padding-left: 10px;">Processing...</span></div>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Deposit Model -->


                                <script>
                                const addmoneyaddtxidnow = (element) => {
                                    element.hidden = true;                                                    
                                    document.getElementById('txidprocessimage').style.display = "block";
                                    document.getElementById('txidcloseoff').style.display = "none";
                                    document.getElementById('txidmassagess').style.display = "block";
                                    
                                }
                                </script>




@endsection