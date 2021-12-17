@extends('layouts.dashboard')
@section('content')


<div class="content-panel-toggler">
            <i class="os-icon os-icon-grid-squares-22"></i><span>Sidebar</span>
          </div>
        <div class="content-i">
            <div class="content-box">
              <div class="os-tabs-w">
                <div class="os-tabs-controls os-tabs-complex">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#tab_overview"><span class="tab-label">All Users</span></a>
                    </li>
                    
                  </ul>
                </div>
              </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="element-balances justify-content-between mobile-full-width">
                            <div class="balance balance-v2">
                            <div class="balance-title">
                            Total Active Users
                            </div>                           

                            <div class="balance-value">
                                
                            {{$userstotal}}

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
                        All Users
                        </h5>
                        <div class="form-desc">
                            
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>REF. ID</th> 
                                    <th>Email Verification</th>
                                    <th>Action</th>                                       
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>REF. ID</th> 
                                    <th>Email Verification</th>
                                    <th>Action</th>
                                    </tr>
                                </tfoot>
                                
                                <tbody>

                                        @foreach($users as $k=>$val)
                                        <tr>
                                        <td>{{++$k}}.</td>
                                        <td><strong> {{$val->name}} </strong></td>
                                        <td> {{$val->email}}</td>
                                        <td>{{$val->ref_id}}</td>
                                        <td>
                                            @if($val->email_auth == 2)
                                            <span class="badge badge-success">Verified</span>
                                            @else
                                            <span class="badge badge-danger">Not Verified</span>
                                            @endif
                                        </td>
                                        <td><a href="/admin/user/{{$val->email}}">View</a></td>                                        
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