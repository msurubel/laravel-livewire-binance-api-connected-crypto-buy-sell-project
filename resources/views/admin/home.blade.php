@extends('layouts.dashboard')
@section('content')


    <div class="content-box">

        <div class="row">           

            <div class="col-sm-3">

                <div class="row">

                    <div class="col-lg-12" style="padding-bottom: 30px;">                            
                        <h6 class="element-header">
                            <span style="color: green;">Total Deposited</span>
                        </h6>                            
                        <span style="font-size: 25px;"><strong>${{$deposited}}</strong></span>
                    </div>

                    <div class="col-lg-12" style="padding-bottom: 30px;">                            
                        <h6 class="element-header">
                            <span style="color: green;">Total Deposits</span>
                        </h6>                            
                        <span style="font-size: 25px;"><strong>${{number_format ($totaldeposits, 2)}}</strong></span>
                    </div>

                    <div style="border-top: 1px dotted red;"></div>

                    <div class="col-lg-12" style="padding-bottom: 30px;">                            
                        <h6 class="element-header">
                            <span style="color: #9e9e00;">Total Withdraw</span>
                        </h6>                            
                        <span style="font-size: 25px;"><strong>${{number_format ($totalwithdraw, 2)}}</strong></span>
                    </div>

                    <div class="col-lg-12" style="padding-bottom: 30px;">                            
                        <h6 class="element-header">
                            <span style="color: #ffb01f;">Total Crypto Orders</span>
                        </h6>                            
                        <span style="font-size: 25px;"><strong>{{$totalcryptoorders}}</strong></span>
                    </div>

                    <div class="col-lg-12" style="padding-bottom: 30px;">                            
                        <h6 class="element-header">
                            <span style="color: #000080;">Total Crypto Coin</span>
                        </h6>                            
                        <span style="font-size: 25px;"><strong>{{$totalcoins}}</strong></span>
                    </div>

                    <div class="col-lg-12" style="padding-bottom: 30px;">                            
                        <h6 class="element-header">
                            <span style="color: gray;">Total User</span>
                        </h6>                            
                        <span style="font-size: 25px;"><strong>{{$usersall}}</strong></span>
                    </div>

                    <hr>
                    
                </div>

            
            </div>

            <div class="col-sm-9">

                
                        <!--START - deposits Table-->
                    <div class="element-wrapper">
                        <h6 class="element-header">
                        Recent 10 Pending Deposit
                        </h6>
                        <div class="element-box-tp">
                        <div class="table-responsive">
                            <table class="table table-padded">
                            <thead>
                                <tr>
                                <th>
                                    Ref ID
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Description
                                </th>
                                <th class="text-center">
                                    Fees
                                </th>
                                <th class="text-right">
                                    Amount
                                </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($depositall as $val)
                                <a href="#">
                                <tr>
                                <td class="text-left">
                                    {{$val->ref}}
                                </td>
                                <td class="nowrap">
                                    <span class="status-pill smaller yellow"></span><span>Pending</span>
                                </td>
                                <td>
                                    <span>{{$val->created_at->diffForHumans()}}</span>
                                </td>
                                <td class="cell-with-media">
                                    <i class="cc {{$val->method_symbol}}" style="font-size: 22px;"></i> <span>{{$val->method_name}}</span>
                                </td>
                                <td class="text-center">
                                    {{$val->fees}}
                                </td>
                                <td class="text-right bolder nowrap">
                                    <span class="text-success">+ {{ number_format( $val->amount , 2 )}} USD</span>
                                </td>
                                </tr>
                                </a>
                                @endforeach
                                
                            </tbody>
                            </table>
                            <a class="centered-load-more-link" href="/admin/deposits"><span>See All Deposits</span></a>
                        </div>
                        </div>
                    </div>
                    <!--END - deposits Table--> 
                    
                    <!--START - withdraw Table-->
                    <div class="element-wrapper">
                        <h6 class="element-header">
                        Recent 10 Pending Withdraw
                        </h6>
                        <div class="element-box-tp">
                        <div class="table-responsive">
                            <table class="table table-padded">
                            <thead>
                                <tr>
                                <th>
                                    Ref ID
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Description
                                </th>
                                
                                <th class="text-right">
                                    Amount
                                </th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($withdrawall as $val)
                                <a href="#">
                                <tr>
                                <td class="text-left">
                                    {{$val->ref}}
                                </td>
                                <td class="nowrap">
                                    <span class="status-pill smaller yellow"></span><span>Pending</span>
                                </td>
                                <td>
                                    <span>{{$val->created_at->diffForHumans()}}</span>
                                </td>
                                <td class="cell-with-media">
                                    <i class="cc {{$val->method_symbol}}" style="font-size: 22px;"></i> <span>{{$val->method_name}} | {{$val->method_details}}</span>
                                </td>                                
                                <td class="text-right bolder nowrap">
                                    <span class="text-danger">- {{ number_format( $val->amount , 8 )}} {{$val->method_symbol}}</span>
                                </td>
                                </tr>
                                </a>
                                @endforeach
                                
                            </tbody>
                            </table>
                            <a class="centered-load-more-link" href="/admin/withdraw"><span>See All Withdrawals</span></a>
                        </div>
                        </div>
                    </div>
                    <!--END - withdraw Table--> 
                            
            </div>

        <div>

    </div>



@endsection