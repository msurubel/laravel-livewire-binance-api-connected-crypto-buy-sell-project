<div class="row">
    <div class="col-lg-4">
        <div class="element-balances justify-content-between mobile-full-width">
            <div class="balance balance-v2">
            <div class="balance-title">
            Total Withdraw Requests
            </div>                           

            <div class="balance-value">
                
            <span class="d-xxl-none">{{$withdrawcount}}</span><span class="d-none d-xxl-inline-block">{{$withdrawcount}}</span></span>
            </div>
            </div>                           
            
        </div>
    </div>

    <div class="col-lg-8">

        <!-- Balance Side Panel -->

    </div>
    

</div>

<br>

<div class="row">

    <div class="col-sm-12">
        <div class="element-box">
            <h5 class="form-header">
            Main Account Transections
            </h5>
            <div class="form-desc">
                Here you can find all detailed Main Account Transections
            </div>
            <div class="table-responsive">
                <table id="dataTable2" width="100%" class="table table-striped table-lightfont">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Ref ID</th>
                        <th>Method Name</th>
                        <th>Method Symbol</th>
                        <th>amount</th>
                        <th>fees</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                        </tr>
                    </thead>

                    <tfoot><th>#</th>
                        <th>Ref ID</th>
                        <th>Method Name</th>
                        <th>Method Symbol</th>
                        <th>amount</th>
                        <th>fees</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tfoot>
                    
                    <tbody>

                        @foreach($withdrawall as $k=>$val)
                        <tr>
                        <td>{{++$k}}.</td>
                        <td>{{$val->ref}}</td>
                        <td>{{$val->method_name}}</td>
                        <td>{{$val->method_symbol}}</td>
                        <td>{{$val->amount}}</td>
                        <td>{{$val->fees}}</td>
                        
                        <td>
                            @if($val->status==1)
                            <span class="badge badge-warning">Pending</span>
                            @elseif($val->status==2)<span class="badge badge-danger">Rejected</span>
                            @elseif($val->status==3)<span class="badge badge-success">Confirmed</span>
                            @endif
                        </td>

                        <td>{{$val->created_at->diffForHumans()}}</td>

                        <td>
                        @if($val->status==1)
                        <button class="btn btn-primary" data-target=".withdrawconfirmed{{$val->ref}}" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Confirmed Now</span></button>

                        <!-- Withdraw Confirmed Model -->
                        <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade withdrawconfirmed{{$val->ref}}" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                    Withdraw Details & Confirmation
                                    </h5>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('admin.withdraw.confirmed') }}">
                                    @csrf

                                    <div style="text-align: center;">
                                        <div style="padding: 30px;"><i class="cf cf-{{strtolower($val->method_symbol)}}" style="font-size: 150px;"></i></div>
                                        <p style="color: green; font-size: 45px; font-weight: 900;">@if($val->amount>1){{number_format ($val->amount, 2)}}@else{{number_format ($val->amount, 8)}}@endif <span style="font-size: 12px;">{{$val->method_symbol}}</span></p>
                                        <p>{{$val->method_name}}<br><strong><span style="color: blue;">{{$val->method_details}}</span></strong></p>
                                        @if($val->method_name == "Exchange Withdrawals")
                                        <hr>
                                        <p style="font-size: 25px; font-weight: 900;">@if($val->amount>1){{number_format ($val->pay_amount, 2)}}@else{{number_format ($val->pay_amount, 8)}}@endif <span style="font-size: 12px;">{{strtoupper($val->pay_symbol)}}</span></p>
                                        <a href="https://{{strtolower($val->pay_symbol)}}.tokenview.com/en/tx/{{$val->crypto_txid}}" target="_blank">Check Payment</a>
                                        @else
                                        @endif
                                    </div>


                                    <input class="form-control" value="{{$val->id}}" name="trx_id" type="hidden">
                                                                        
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-success" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Approved Now</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Withdraw Confirmed Model -->
                        @else
                        Already Approved
                        @endif 
                        </td>

                        </tr>                                        
                        @endforeach
                        
                        
                    
                    </tbody>
            
                </table>
            </div>
        </div>
    </div>                    

</div>