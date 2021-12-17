@extends('layouts.dashboard')
@section('content')



        <div class="content-i">
            <div class="content-box">
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
                            Main Account
                            </div>                           

                            <div class="balance-value">
                                
                            <span class="d-xxl-none">${{ number_format( auth()->user()->balance , 2) }}</span><span class="d-none d-xxl-inline-block">${{ number_format( auth()->user()->balance, 2) }}</span></span>
                            </div>
                            </div>                           
                            
                        </div>
                        
                        <div class="element-wrapper pb-4 mb-4 border-bottom">
                            <div class="element-box-tp"> 
                                <button class="btn btn-primary" onclick="location.href='/dashboard/account/main/deposit/methods#coinmethods'" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Deposit</span></button>                              
                                <button class="btn btn-gray" data-target=".withdraw" data-toggle="modal" type="button"><i class="os-icon os-icon-refresh-ccw"></i><span>Withdraw</span></button>
                            </div>                        
                        </div>

                        

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
                                        <label for="">Deposit Method</label>
                                        <select class="form-control" name="method" required>

                                        @foreach($withdraw_method as $val)
                                        <option value="{{$val->id}}" style="color: gray;">
                                        {{$val->name}}
                                        </option>
                                        @endforeach

                                        </select>
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
                
                    <div class="col-sm-12">
                        <div class="element-box">
                            <h5 class="form-header">
                            Main Account Transections
                            </h5>
                            <div class="form-desc">
                                Here you can find all detailed Main Account Transections
                            </div>
                            <div class="table-responsive">
                                <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
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

                                        @foreach($transections as $k=>$val)
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

                                        <td>{{$val->created_at->format('d/m/Y')}}</td>

                                        <td>
                                            @if($val->method_name == "Prediction Earning")
                                            N/A
                                            @else
                                                @if($val->crypto_txid == '0')
                                                <button class="btn btn-primary" data-target=".addtrxid{{$val->id}}" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add TxID</span></button>
                                                @else
                                                TxID Already Added
                                                @endif
                                            @endif


                                            <!-- Deposit Model -->
                                            <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade addtrxid{{$val->id}}" role="dialog" tabindex="-1">
                                                <div class="modal-dialog modal-sm">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                        Add your {{$val->method_symbol}} TxID
                                                        </h5>
                                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{ route('account.deposit.txid') }}">
                                                        @csrf                                           
                                                        <div class="form-group">
                                                            <label for=""> TxID</label><input class="form-control" name="txid" type="text" required>
                                                            <input class="form-control" value="{{$val->ref}}" name="ref_id" type="hidden">
                                                        </div>                                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-success" type="submit"> Confirm</button>
                                                    </div>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Deposit Model -->
                                        </td>

                                        </tr>                                        
                                        @endforeach
                                        
                                        
                                    
                                    </tbody>
                            
                                </table>
                            </div>
                        </div>
                    </div>                    

                </div>

                <div class="row">
                    
                    <div class="col-sm-12">
                            <div class="element-box">
                                <h5 class="form-header">
                                Send Money Transections
                                </h5>
                                <div class="form-desc">
                                    Here you can find all detailed transection of other user transfer.
                                </div>
                                <div class="table-responsive">
                                    <table id="dataTable2" width="100%" class="table table-striped table-lightfont">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Ref ID</th>
                                            <th>Name</th>
                                            <th>Transfer to ID</th>
                                            <th>amount</th>
                                            <th>fees</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                            <th>#</th>
                                            <th>Ref ID</th>
                                            <th>Name</th>
                                            <th>Transfer to ID</th>
                                            <th>amount</th>
                                            <th>fees</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                            </tr>
                                        </tfoot>
                                        
                                        <tbody>

                                            @foreach($transfer as $k=>$val)
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
                                            </tr>                                        
                                            @endforeach
                                            
                                            
                                        
                                        </tbody>
                                
                                    </table>
                                </div>
                            </div>
                        </div>

                </div>


                <div class="row">
                    
                    <div class="col-sm-12">
                            <div class="element-box">
                                <h5 class="form-header">
                                Withdrawals
                                </h5>
                                <div class="form-desc">
                                    All withdraw details.
                                </div>
                                <div class="table-responsive">
                                    <table id="dataTable3" width="100%" class="table table-striped table-lightfont">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Ref ID</th>
                                            <th>Method Name</th>
                                            <th>Method Details</th>
                                            <th>amount</th>
                                            <th>fees</th>                                            
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                            <th>#</th>
                                            <th>Ref ID</th>
                                            <th>Method Name</th>
                                            <th>Method Details</th>
                                            <th>amount</th>
                                            <th>fees</th>
                                            <th>Status</th>
                                            </tr>
                                        </tfoot>
                                        
                                        <tbody>

                                            @foreach($withdraw_history as $k=>$val)
                                            <tr>
                                            <td>{{++$k}}.</td>
                                            <td>{{$val->ref}}</td>
                                            <td>{{$val->method_name}}</td>
                                            <td>{{$val->method_details}}</td>
                                            <td>{{$val->amount}}</td>
                                            <td>{{$val->fees}}</td>
                                            
                                            <td>
                                                @if($val->status==1)
                                                <span class="badge badge-warning">Pending</span>
                                                @elseif($val->status==2)<span class="badge badge-danger">Rejected</span>
                                                @elseif($val->status==3)<span class="badge badge-success">Confirmed</span>
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


                
                  
        


                

            </div>
@endsection