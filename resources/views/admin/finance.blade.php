@extends('layouts.dashboard')
@section('content')

<div class="content-i">
	<div class="content-box">
		  
		<div class="os-tabs-w">
			<div class="os-tabs-controls os-tabs-complex">
			  <ul class="nav nav-tabs">
				<li class="nav-item">
				  <a aria-expanded="false" class="nav-link @if(app('request')->input('active') == 'depositrequest') active @else @endif" data-toggle="tab" href="#depositrequest"><span class="tab-label">Deposit Request</span></a>
				</li>
				<li class="nav-item">
				  <a aria-expanded="false" class="nav-link @if(app('request')->input('active') == 'withdrawrequest') active @else @endif" data-toggle="tab" href="#withdrawrequest"><span class="tab-label">Withdraw Request</span></a>
				</li> 
                <li class="nav-item">
				  <a aria-expanded="false" class="nav-link @if(app('request')->input('active') == 'cryptofees') active @else @endif" data-toggle="tab" href="#cryptofees"><span class="tab-label">Crypto Fees W</span></a>
				</li>
                <li class="nav-item">
				  <a aria-expanded="false" class="nav-link @if(app('request')->input('active') == 'depositgetaway') active @else @endif" data-toggle="tab" href="#depositgetaway"><span class="tab-label">Deposit Getaways</span></a>
				</li>                   
			  </ul>
			</div>
		</div>

		<div class="tab-content">

			<!-- Tab Deposit Request -->
			<div class="tab-pane @if(app('request')->input('active') == 'depositrequest') active @else @endif" id="depositrequest">
				
                <livewire:deposit-request-admin/>
				
			</div>
			<!-- Tab Deposit Request -->
				
			<!-- Tab Withdraw Request -->
			<div class="tab-pane @if(app('request')->input('active') == 'withdrawrequest') active @else @endif" id="withdrawrequest">
				
                <livewire:withdraw-request-admin/>

			</div>
			<!-- Tab Withdraw Request -->

            <!-- Tab Crypto Fees -->
			<div class="tab-pane @if(app('request')->input('active') == 'cryptofees') active @else @endif" id="cryptofees">
				
                <livewire:crypto-fees-admin/>

            </div>
            <!-- Tab Crypto Fees -->

            <!-- Tab Deposit Getaway Fees -->
            <div class="tab-pane @if(app('request')->input('active') == 'depositgetaway') active @else @endif" id="depositgetaway">
                
                <livewire:deposit-getaway-admin/>

            </div>
            <!-- Tab Deposit Getaway Fees -->

		</div> 

	</div> 
</div>
@endsection