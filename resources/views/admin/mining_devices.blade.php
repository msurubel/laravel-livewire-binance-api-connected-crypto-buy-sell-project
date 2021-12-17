@extends('layouts.dashboard')
@section('content')


    <div class="content-i">
        <div class="content-box">
              
            <div class="os-tabs-w">
                <div class="os-tabs-controls os-tabs-complex">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a aria-expanded="false" class="nav-link @if(app('request')->input('active') == 'devicelists') active @else @endif" data-toggle="tab" href="#devicelists"><span class="tab-label">All Devices</span></a>
                    </li>
                    <li class="nav-item">
                      <a aria-expanded="false" class="nav-link @if(app('request')->input('active') == 'purchaseddevices') active @else @endif" data-toggle="tab" href="#purchaseddevices"><span class="tab-label">Purchased Orders</span></a>
                    </li>                    
                  </ul>
                </div>
            </div>

            <div class="tab-content">

                <!-- Tab Device Lists -->
                <div class="tab-pane @if(app('request')->input('active') == 'devicelists') active @else @endif" id="devicelists">
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="element-balances justify-content-between mobile-full-width">
                                <div class="balance balance-v2">
                                <div class="balance-title">
                                Total Devices
                                </div>                           

                                <div class="balance-value">
                                    
                                {{$devices->count()}}

                                </div>
                                </div>                           
                                
                            </div>       
                            
                            <div class="element-wrapper pb-4 mb-4 border-bottom">
                                <div class="element-box-tp"> 
                                    <button class="btn btn-primary" data-target=".addgetawaysnew" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add New Device</span></button>                              
                                </div>                        
                            </div>
                            


                            <!-- Device Add Model -->
                            <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade addgetawaysnew" role="dialog" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                        Add New Device
                                        </h5>
                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('crypto.mining.devices.add') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for=""> Device Name</label><input class="form-control" name="name" type="text" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for=""> Cost Per kWHS</label><input class="form-control" value="0.1" name="costkwhs" type="number" required>                                        
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for=""> Use kWHS</label><input class="form-control" name="kwhspower" type="number" required>                                        
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for=""> Can mine in a Day (USD)</label><input class="form-control" name="dayincome" type="number" required>                                        
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for=""> Maximum kh/s</label><input class="form-control" name="khspower" type="number" required>                                        
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for=""> Buy Cost Per Device (For User)</label><input class="form-control" name="buycost" type="number" required>                                        
                                                </div>
                                            </div>
                                        
                                        </div>                                                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Add Now</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Device Add Model -->

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
                            All Devices Lists
                            </h5>
                            <div class="form-desc">
                                
                            </div>
                            <div class="table-responsive">
                                <table id="dataTable2" width="100%" class="table table-striped table-lightfont">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Cost Per kWHS</th>
                                        <th>kWSH Power</th>
                                        <th>Daily Mining Range</th> 
                                        <th>kh/s Power</th>  
                                        <th>Buy Price</th> 
                                        <th>Status</th>
                                        <th>Action</th>                                     
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Cost Per kWHS</th>
                                        <th>kWSH Power</th>
                                        <th>Daily Mining Range</th> 
                                        <th>kh/s Power</th>  
                                        <th>Buy Price</th> 
                                        <th>Status</th> 
                                        <th>Action</th> 
                                        </tr>
                                    </tfoot>
                                    
                                    <tbody>

                                            @foreach($devices as $k=>$val)
                                            <tr>
                                            <td>{{++$k}}.</td>
                                            <td><strong> {{$val->name}} </strong></td>
                                            <td>{{$val->cost_kwhs}}</td>
                                            <td>{{$val->power_kwhs}} kWHS</td>
                                            <td>${{$val->day_income}}</td>
                                            <td>{{$val->power_khs}} kh/s</td>
                                            <td>{{$val->buy_cost}}</td>
                                            <td>
                                                @if($val->status == 1)
                                                <span class="badge badge-success">Active</span>
                                                @else
                                                <span class="badge badge-danger">Disabled</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($val->status == 1)
                                                <a href="/admin/deposit/getaways/disabled/{{$val->id}}">Disabled Now</a>
                                                @else
                                                <a href="/admin/deposit/getaways/activated/{{$val->id}}">Active Now</a>
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
                <!-- Tab Device Lists -->
                    
                <!-- Tab Device Purchased Manager -->
                <div class="tab-pane @if(app('request')->input('active') == 'purchaseddevices') active @else @endif" id="purchaseddevices">
                    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="element-balances justify-content-between mobile-full-width">
                                <div class="balance balance-v2">
                                <div class="balance-title">
                                Total Devices Purchased Order
                                </div>                           

                                <div class="balance-value">
                                    
                                {{$devicesp->count()}}

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
                            All Devices Lists
                            </h5>
                            <div class="form-desc">
                                
                            </div>
                            <div class="table-responsive">
                                <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Device Name</th>
                                        <th>Order Ref</th> 
                                        <th>Purchased By</th>
                                        <th>Power kH/s</th> 
                                        <th>Quantity</th>  
                                        <th>Buy Price</th> 
                                        <th>Status</th>
                                        <th>Action</th>                                     
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <tr>                                        
                                        <th>#</th>
                                        <th>Device Name</th>
                                        <th>Order Ref</th> 
                                        <th>Purchased By</th>
                                        <th>Power kH/s</th> 
                                        <th>Quantity</th>  
                                        <th>Buy Price</th> 
                                        <th>Status</th>
                                        <th>Action</th> 
                                        </tr>
                                    </tfoot>
                                    
                                    <tbody>

                                            @foreach($devicesp as $k=>$val)
                                            <tr>
                                            <td>{{++$k}}.</td>
                                            <td>{{$val->name}}</td>
                                            <td><strong> {{$val->order_ref}} </strong></td> 
                                            <td><a href="/admin/user/{{App\Models\User::whereid($val->user_id)->first()->email}}" target="_blank">{{App\Models\User::whereid($val->user_id)->first()->name}}</a></td>                                           
                                            <td>${{$val->power_khs}}</td>
                                            <td>{{$val->quantity}} kh/s</td>
                                            <td>{{$val->buy_cost}}</td>
                                            <td>
                                                @if($val->status == 1)
                                                <span class="badge badge-success">Active</span>
                                                @elseif($val->status == 2)
                                                <span class="badge badge-warning">Processing</span>
                                                @else
                                                <span class="badge badge-danger">Destroyed</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($val->status == 1)
                                                <a href="/admin/deposit/getaways/disabled/{{$val->id}}">Disabled Now</a>
                                                @else
                                                <a href="/admin/crypto/mining/devices/purchased/active/{{$val->id}}">Active Now</a>
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
                <!-- Tab Device Purchased Manager -->

            </div> 

        </div> 
    </div>    
@endsection
