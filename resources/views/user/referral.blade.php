@extends('layouts.dashboard')
@section('content')



        <div class="content-i">
            <div class="content-box">
              <div class="os-tabs-w">
                <div class="os-tabs-controls os-tabs-complex">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#tab_overview"><span class="tab-label">Referral System</span></a>
                    </li>
                    
                  </ul>
                </div>
              </div>
                <div class="row">
                    <div class="col-lg-2">
                        <div class="element-balances justify-content-between mobile-full-width">
                            <div class="balance balance-v2">
                            <div class="balance-title">
                            Total Reffered Users
                            </div>                           

                            <div class="balance-value">
                                
                            {{$totalref}}

                            </div>
                            </div>                           
                            
                        </div>

                    </div>

                    <div class="col-lg-4">
                        <div class="element-balances justify-content-between mobile-full-width">
                            <div class="balance balance-v2">
                            <div class="balance-title">
                            Total Earning
                            </div>                           

                            <div class="balance-value">
                                
                            ${{number_format (auth()->user()->ref_earnings, 2)}}

                            </div>
                            </div>                           
                            
                        </div>

                    </div>

                    <div class="col-lg-6">

                        <div class="element-balances justify-content-between mobile-full-width">
                            <div class="balance balance-v2">
                            <div class="balance-title">
                            Your Referral Link Bellow
                            </div>                           
                                
                            <span style="font-size: 20px;"><strong>{{ url('/')}}/new<span style="color: green;">?ref={{auth()->user()->ref_id}}<span></strong></span><br>
                            <span style="font-size: 12px; color: gray;">Referr to more people and earning more. now referral bonus <span style="color: green;">${{$set->ref_bonus}}</span> for every user.</span>

                            </div>                           
                            
                        </div>

                    </div>                    
                    

                </div>

                <br>

                <div class="row">
                        
                
                    
                    <div class="col-lg-12">
                        
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="element-box">

                                    <h5 class="form-header">
                                    Exchange Widget Code
                                    </h5>

                                    <textarea class="form-control" rows="20" onclick="this.focus();this.select()" readonly="readonly">
<style>
/* iframe itself */
iframe {
    display: block;
    width: 100%;
    height: auto;
    border: none;
    border-radius: 15px;
    }
</style>
<script>
function resizeIframe(obj)
    {
    obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }
</script>
<div><iframe src="{{ url ('/')}}/crypto/exchange/widget/{{auth()->user()->ref_id}}" frameborder="0" scrolling="no" onload="resizeIframe(this)"></iframe></div>
                                    </textarea>
                                    <br>
                                    <p>Copy all the above codes and paste them on your website page. <strong>You will get ${{$set->exchange_widget_ref_earning}} of all exchange orders that referred you.</strong></p>
                                
                                </div> 
                            </div>

                            <div class="col-lg-6">
                                <div class="element-box">

                                    <h5 class="form-header">
                                    Widget Privew
                                    </h5>

                                    <style>
                                    /* iframe itself */
                                    iframe {
                                        display: block;
                                        width: 100%;
                                        height: auto;
                                        border: none;
                                        border-radius: 15px;
                                        }
                                    </style>
                                    <script>
                                    function resizeIframe(obj)
                                        {
                                        obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
                                        }
                                    </script>
                                    <div><iframe src="{{ url ('/')}}/crypto/exchange/widget/{{auth()->user()->ref_id}}" frameborder="0" scrolling="no" onload="resizeIframe(this)"></iframe></div>

                                </div>                                                       
                            </div>

                        </div>                                                       
                    </div>
                    

                </div>

                <div class="row">
                        
                
                    
                    <div class="col-lg-12">
                        <div class="element-box">
                        <h5 class="form-header">
                        Refered User Details
                        </h5>
                        <div class="form-desc">
                            
                        </div>
                        <div class="table-responsive">
                            <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                                <thead>
                                    <tr>
                                    <th>#</th>
                                    <th>Name</th>                                    
                                    <th>Earnings</th>
                                    <th>Date</th>                                        
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                    <th>#</th>
                                    <th>Name</th>                                    
                                    <th>Earnings</th>
                                    <th>Date</th>
                                    </tr>
                                </tfoot>
                                
                                <tbody>

                                                    
                    
                        

                                        @foreach($referral as $k=>$val)
                                        <tr>
                                        <td>{{++$k}}.</td>
                                        <td> {{$val->name}} </a></td>
                                        <td>${{$val->earnings}}</td> 
                                        <td>{{$val->created_at}}</td>                                        
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