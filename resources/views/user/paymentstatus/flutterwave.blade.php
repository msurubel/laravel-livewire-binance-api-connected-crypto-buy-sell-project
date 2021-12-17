@extends('layouts.dashboard')
@section('content')

<div class="content-i">
    <div class="content-box">

        <div class="row">

            <div class="col-lg-12">
                <div class="element-wrapper">
                    <div>
                        <div class="row">
                            <div class="col-lg-4">

                            </div>

                            <div class="col-lg-4" style="text-align: center;">  
                                <div style="padding-bottom: 50px;"><img width="50%" src="/images/getways/flutterwave_light.png"></div>                          
                                <p style="font-size: 55px; font-weight: 900; line-height: 0.6;">${{App\Models\transections::whereref(app('request')->input('tx_ref'))->first()->amount}}<br>
                                @if(app('request')->input('status') == "cancelled")
                                <span style="font-size: 20px; font-weight: 500;">Payment Cancelled</span>
                                @else
                                <span style="font-size: 20px; font-weight: 500;">Payment successful</span>
                                @endif
                                </p>
                                <div style="padding: 15px;"><div class="@if(app('request')->input('status') == 'cancelled') bg-danger @else bg-success @endif" style="color: white; padding: 15px; border-radius: 25px;"><span>Ref. ID: {{app('request')->input('tx_ref')}}</span></div></div>
                                <button class="btn btn-primary" onclick="location.href='/dashboard/account/main'" type="button"><i class="os-icon os-icon-arrow-left"></i><span>Back</span></button>                                 
                            </div>

                            <div class="col-lg-4">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@endsection