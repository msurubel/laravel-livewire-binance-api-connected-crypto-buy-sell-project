<div class="row">
    <div class="col-lg-4">
        <div class="element-balances justify-content-between mobile-full-width">
            <div class="balance balance-v2">
            <div class="balance-title">
            Total Deposits Count
            </div>                           

            <div class="balance-value">
                
            <span class="d-xxl-none">{{$depositcount}}</span><span class="d-none d-xxl-inline-block">{{$depositcount}}</span></span>
            </div>
            </div>                           
            
        </div>
    </div>

    <div class="col-lg-4">
        <div class="element-balances justify-content-between mobile-full-width">
            <div class="balance balance-v2">
            <div class="balance-title">
            Total Deposits Amount
            </div>                           

            <div class="balance-value">
                
            <span class="d-xxl-none">${{$depositamount}}</span><span class="d-none d-xxl-inline-block">${{$depositamount}}</span></span>
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
                @if(empty(app('request')->input('address')))
                Here you can find all detailed Main Account Transections
                @else
                <p>Our <strong>{{app('request')->input('symbol')}}</strong> Address is <span style="color: green;"><strong>{{app('request')->input('address')}}</strong></span></p>
                @endif
            </div>
            <div class="table-responsive">
                <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                    <thead>
                        <tr>
                        <th>#</th>
                        <th>Ref ID</th>
                        <th>TxID</th>
                        <th>View OCA</th>
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
                        <th>TxID</th>
                        <th>View OCA</th>
                        <th>Method Name</th>
                        <th>Method Symbol</th>
                        <th>amount</th>
                        <th>fees</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tfoot>
                    
                    <tbody>

                        @foreach($depositall as $k=>$val)
                        <tr>
                        <td>{{++$k}}.</td>
                        <td>{{$val->ref}}</td>
                        <td>
                            @if($val->crypto_txid == '0')

                            @else
                            <a href="https://{{$val->method_symbol}}.tokenview.com/en/tx/{{$val->crypto_txid}}" target="_blank">View TxID Details</a></td>
                            @endif
                        <td>
                            @if($val->crypto_txid == '0')

                            @else
                            <a href="/admin/deposits/our/address/{{$val->method_symbol}}">View</a></td>
                            @endif
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

                        <td>{{$val->created_at->format('m-d-y  h:m:s')}}</td>

                        <td>
                        @if($val->status==1)
                        <a class="btn btn-primary" href="/admin/deposit/confirmed/{{$val->id}}/{{$val->user_id}}" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Approve Now</span></a>
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