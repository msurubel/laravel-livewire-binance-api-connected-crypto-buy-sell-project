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
				  <form method="POST" action="{{ route('admin.settings.update') }}">
                    @csrf
					  <h5 class="form-header">
						User Data
					  </h5>
					  <div class="form-desc">
						You can see or change your data using this form.
					  </div>
                      <div class="form-group">
						<label for=""> Site Name</label><input class="form-control" name="name" value="{{$set->name}}" type="text">
					  </div>

                      <div class="form-group">
						<label for=""> Main Crypto (Only Crypto)</label><input class="form-control"  name="maincrypto" value="{{$set->main_crypto}}" type="text">
					  </div>

                      <div class="form-group">
						<label for=""> Deposit Fees USD</label><input class="form-control" name="depositfees" value="{{$set->fees}}" type="number">
					  </div>

                      <div class="form-group">
						<label for=""> Internal Transfer Fees USD</label><input class="form-control" name="transferfees" value="{{$set->intr_fees}}" type="number">
					  </div>

                     <div class="row">
						 <div class="col-lg-6">
							<div class="form-group">
								<label for=""> Withdraw Fees USD</label><input class="form-control" name="withdrawfees" value="{{$set->withdraw_fees}}" type="number">
							</div>
						 </div>

						 <div class="col-lg-6">
							<div class="form-group">
								<label for=""> Exchange Widget Ref. Earning USD</label><input class="form-control" name="exchange_widget_ref_earning" value="{{$set->exchange_widget_ref_earning}}" type="number">
							</div>
						 </div>
					 </div>

					 <div class="row">
						 <div class="col-lg-6">
							<div class="form-group">
								<label for=""> Referral Bonus USD</label><input class="form-control" name="refbonus" value="{{$set->ref_bonus}}" type="number">
							</div>
						 </div>

						 <div class="col-lg-6">
							<div class="form-group">
								<label for=""> Prediction Earning USD</label><input class="form-control" name="prediction_earning" value="{{$set->prediction_earning}}" type="number">
							</div>
						 </div>
					 </div>	
					 
					 <div class="row">
						 <div class="col-lg-6">
							<div class="form-group">
								<label for=""> Locked Amount Profit %</label><input class="form-control" name="locked_amount_profit" value="{{$set->locked_amount_profit}}" type="number">
							</div>
						 </div>

						 <div class="col-lg-6">
						 	<div class="form-group">
								<label for=""> Locked Amount (Minimum USD)</label><input class="form-control" name="locked_amount_minimum" value="{{$set->locked_amount_minimum}}" type="number">
							</div>
						 </div>
					 </div>	

					  <fieldset class="form-group">
						<legend><span>Company Info</span></legend>
						<div class="row">
						  <div class="col-sm-12">
							<div class="form-group">
							  <label for=""> Company Short Description</label><input class="form-control" name="site_short_d" value="{{$set->site_short_d}}" type="text">
							</div>
						  </div>
						  <div class="col-sm-12">
							<div class="form-group">
							  <label for="">Address</label><input class="form-control" name="address" value="{{$set->address}}" type="text">
							</div>
						  </div>
						  <div class="col-sm-12">
							<div class="form-group">
							  <label for="">Phone Number</label><input class="form-control" name="phone_number" value="{{$set->phone_number}}" type="text">
							</div>
						  </div>
						  <div class="col-sm-12">
							<div class="form-group">
							  <label for="">Email</label><input class="form-control" name="email_id" value="{{$set->email_id}}" type="text">
							</div>
						  </div>
						  <div class="col-sm-12">
							<div class="form-group">
							  <label for="">Any Live Chat Script Code</label><input class="form-control" name="chat_script" value="{{$set->chat_script}}" type="text">
							</div>
						  </div>
						</div>						
						
					  </fieldset>

                    	<fieldset class="form-group">
							<legend><span>Binance API</span></legend>
								<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
									<label for=""> API KEY</label><input class="form-control" name="apikey" value="{{$set->api_key}}" type="text">
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
									<label for="">SECRETE KEY</label><input class="form-control" name="scrtkey" value="{{$set->scrt_key}}" type="text">
									</div>
								</div>
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
										<form method="POST" action="{{ route('admin.settings.images') }}" enctype="multipart/form-data">
										@csrf
										<h5 class="form-header">
											Site Logos
										</h5>
										<div class="form-desc">
											Change your logo and fevicon.
										</div>

										<div class="centered">
											<div class="logo-w">
												<img alt="" width="200px" src="/img/settings/{{$set->image_logo}}">
											</div>
										</div><br><br>
										<div class="form-group">
											<label for=""> Change Site Logo Colored</label><input class="form-control" name="image" type="file">
											<input class="form-control" name="user_id" value="{{auth()->user()->id}}" type="hidden">
										</div>
										<div class="centered">
											<div class="logo-w">
												<img alt="" width="200px" src="/img/settings/{{$set->image_logow}}">
											</div>
										</div><br><br>
										<div class="form-group">
											<label for=""> Change Site Logo White</label><input class="form-control" name="imagew" type="file">                                
										</div>   
										<div class="centered">
											<div class="logo-w">
												<img alt="" width="200px" src="/img/settings/{{$set->site_favicon}}">
											</div>
										</div><br><br>
										<div class="form-group">
											<label for=""> Change Site Fevicon</label><input class="form-control" name="image_fevicon" type="file">                                
										</div>                  
										<div class="form-buttons-w">
											<button class="btn btn-primary" type="submit"> Save Change</button>
										</div>
									</form>
								</div>
							</div>

						</div>

					</div>

					<div class="col-lg-12">
						
						<div class="element-wrapper">
							<h6 class="element-header">
								Social Links
							</h6>
								<div class="element-box">
										<form method="POST" action="{{ route('admin.ui.social.links') }}">
										@csrf
										
										<div class="form-group">
											<label for=""> Facebook</label><input class="form-control" value="{{ $set->facebook_link }}" name="facebook_link" type="text">											
										</div>

										<div class="form-group">
											<label for=""> Twitter</label><input class="form-control" value="{{ $set->twitter_link }}" name="twitter_link" type="text">											
										</div>

										<div class="form-group">
											<label for=""> Linkedin</label><input class="form-control" value="{{ $set->linkedin_link }}" name="linkedin_link" type="text">											
										</div>

										<div class="form-group">
											<label for=""> YouTube</label><input class="form-control" value="{{ $set->youtube_link }}" name="youtube_link" type="text">											
										</div>
										                   
										<div class="form-buttons-w">
											<button class="btn btn-primary" type="submit"> Save Change</button>
										</div>
									</form>
								</div>
							</div>

						</div>

					</div>

            </div>

</div>
</div>

@endsection