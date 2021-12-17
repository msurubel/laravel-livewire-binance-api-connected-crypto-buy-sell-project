@extends('layouts.dashboard')
@section('content')

<div class="content-box">
<div class="row">
        <div class="col-lg-6">
				<div class="element-wrapper">
				  <h6 class="element-header">
					Main Settings
				  </h6>
				  <div class="element-box">
				  <form method="POST" action="{{ route('admin.users.edit.save') }}">
                    @csrf
					  <h5 class="form-header">
						User Data
					  </h5>
					  <div class="form-desc">
						You can see or change your data using this form.
					  </div>

                        <fieldset class="form-group">
						    <legend><span>Non Editable Data</span></legend>
                                <!--START - Non Editable Data Table-->
                                <div class="element-wrapper">                                    
                                    <div class="element-box-tp">
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                            <thead>
                                                <tr>
                                                <th class="text-left">
                                                    Name
                                                </th>
                                                <th class="text-left">
                                                    Details
                                                </th>                                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <a href="#">
                                                    <tr>
                                                        <td class="text-left">
                                                            <strong>Balance</strong>
                                                        </td>
                                                        <td class="text-left"><strong>${{ number_format ($user->balance, 2) }}</strong></td>                                            
                                                    </tr>
                                                </a>

                                                <a href="#">
                                                    <tr style="color: green;">
                                                        <td class="text-left">
                                                            <strong>Total Deposit</strong>
                                                        </td>
                                                        <td class="text-left"><strong>+ ${{ number_format ($totaldeposits, 2) }}</strong></td>                                            
                                                    </tr>
                                                </a>

                                                <a href="#">
                                                    <tr style="color: red;">
                                                        <td class="text-left">
                                                            <strong>Total Withdraw</strong>
                                                        </td>
                                                        <td class="text-left"><strong>- ${{ number_format ($totalwithdraws, 2) }}</strong></td>                                            
                                                    </tr>
                                                </a>

                                                <a href="#">
                                                    <tr>
                                                        <td class="text-left">
                                                            <strong>Total Trades</strong>
                                                        </td>
                                                        <td class="text-left"><strong>{{ $totaltrades }}</strong></td>                                            
                                                    </tr>
                                                </a>

                                                <a href="#">
                                                    <tr>
                                                        <td class="text-left">
                                                            <strong>REF. ID</strong>
                                                        </td>
                                                        <td class="text-left"><strong>{{ $user->ref_id }}</strong></td>                                            
                                                    </tr>
                                                </a>

                                                <a href="#">
                                                    <tr>
                                                        <td class="text-left">
                                                            <strong>Total Referred Users</strong>
                                                        </td>
                                                        <td class="text-left"><strong>{{ $user->ref_users }}</strong></td>                                            
                                                    </tr>
                                                </a>

                                                <a href="#">
                                                    <tr>
                                                        <td class="text-left">
                                                            <strong>Total Referral Earnings</strong>
                                                        </td>
                                                        <td class="text-left"><strong>${{ number_format ($user->ref_earnings, 2) }}</strong></td>                                            
                                                    </tr>
                                                </a>
                                                
                                                
                                            </tbody>
                                            </table>                                            
                                        </div>
                                    </div>
                                </div>
                                <!--END - Non Editable Data Table--> 
                        </fieldset>

                        <fieldset class="form-group">
						    <legend><span>Editable Data</span></legend>
                                <div class="form-group">
                                    <label for=""> Name</label><input class="form-control" name="editedname" value="{{$user->name}}" type="text">
                                    <input class="form-control"  name="userid" value="{{$user->id}}" type="hidden">
                                </div>

                                <div class="form-group">
                                    <label for=""> Email</label><input class="form-control"  name="newemail" value="{{$user->email}}" type="text">
                                </div>

                                <div class="form-group">
                                    <label for="">Access Type</label>
                                        <select class="form-control" name="type">
                                            @if($user->type == 1)
                                            <option selected value="1" style="color: gray;">
                                            Generel User
                                            </option>
                                            <option value="2" style="color: gray;">
                                            Admin
                                            </option>
                                            <option value="3" style="color: gray;">
                                            Editor
                                            </option>
                                            @elseif($user->type == 2)
                                            <option value="1" style="color: gray;">
                                            Generel User
                                            </option>
                                            <option selected value="2" style="color: gray;">
                                            Admin
                                            </option>
                                            <option value="3" style="color: gray;">
                                            Editor
                                            </option>
                                            @elseif($user->type == 3)
                                            <option value="1" style="color: gray;">
                                            Generel User
                                            </option>
                                            <option value="2" style="color: gray;">
                                            Admin
                                            </option>
                                            <option selected value="3" style="color: gray;">
                                            Editor
                                            </option>
                                            @endif
                                            
                                        </select>
                                </div>
                        </fieldset>
					 
					  <div class="form-buttons-w">
						<button class="btn btn-primary" type="submit"> Submit</button>
					  </div>
					</form>
				  </div>
				</div>
	    </div>

            <div class="col-lg-6">

                <div class="row">

					<div class="col-lg-12">

						<div class="element-wrapper">
							<h6 class="element-header">
								Settings 2
							</h6>
								<div class="element-box">
										
										<h5 class="form-header">
											User Profile Photo
										</h5>										

										<div class="centered">
											<div class="logo-w">
												<img alt="" width="200px" src="/img/avatars/{{ $user->image }}">
											</div>
										</div><br><br>									                 
										

								</div>
							</div>

						</div>

					</div>
					
            </div>


            <div class="col-sm-12">
                        <div class="element-box">
                        <h5 class="form-header">
                        All Trades of {{ $user->name }}
                        </h5>
                        <div class="form-desc">
                            
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                                <thead>
                                    <tr>                                    
                                    <th>Ref ID</th>
                                    <th>Order Id</th>
                                    <th>Client Order ID</th> 
                                    <th>Symbol</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>Cost</th>
                                    <th>Fees</th>
                                    <th>Order Teyp</th>
                                    <th>Side</th>
                                    <th>Status</th>                                            
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                    <th>Ref ID</th>
                                    <th>Order Id</th>
                                    <th>Client Order ID</th> 
                                    <th>Symbol</th>
                                    <th>Amount</th>
                                    <th>Price</th>
                                    <th>Cost</th>
                                    <th>Fees</th>
                                    <th>Order Teyp</th>
                                    <th>Side</th>
                                    <th>Status</th>
                                    </tr>
                                </tfoot>
                                
                                <tbody>

                                        @foreach($trades as $val)
                                        <tr>
                                        <td>{{$val->ref}}.</td>
                                        <td><strong> {{$val->orderId}} </strong></td>
                                        <td> {{$val->clientOrderId}}</td>
                                        <td>{{$val->method_symbol}}</td>
                                        <td>{{$val->amount}}</td>
                                        <td>{{$val->price}}</td>
                                        <td>{{$val->cost}}</td>
                                        <td>{{$val->fees}}</td>
                                        <td>{{$val->market_type}}</td>
                                        <td>{{$val->market_side}}</td>
                                        <td>
                                            @if($val->status =='FILLED')                                            
                                            <span class="badge badge-success">{{$val->status}}</span>
                                            @elseif($val->status =='NEW') 
                                            <span class="badge badge-info">{{$val->status}}</span>
                                            @elseif($val->status =='CANCELED')
                                            <span class="badge badge-danger">{{$val->status}}</span>
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