@extends('layouts.dashboard')
@section('content')

<div class="content-box">

    <div class="row">
        <div class="col-lg-6">
            <div class="element-wrapper">
                <div class="row">
                    
                        <div class="col-lg-12">
                            
                            <h6 class="element-header">
                                Accounts
                            </h6>                
                            
                            <livewire:mining-cryptos-all/>             
                            
                        </div>

                        <div class="col-lg-12" style="padding-top: 20px;">
                            <div class="element-wrapper">
                                    <div class="os-tabs-w">
                                        <div class="os-tabs-controls os-tabs-complex">
                                            <ul class="nav nav-tabs">
                                                <li class="nav-item">
                                                <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#transferpower"><span class="tab-label">Transfer kH/s Power</span></a>
                                                </li>
                                                <li class="nav-item">
                                                <a aria-expanded="false" class="nav-link" data-toggle="tab" href="#transferfund"><span class="tab-label">Transfer Fund</span></a>
                                                </li>
                                                <!--
                                                <li class="nav-item">
                                                <a aria-expanded="false" class="nav-link" data-toggle="tab" href="#cryptobuylimit"><span class="tab-label">LIMIT</span></a>
                                                </li>    
                                                -->                                    
                                            </ul>
                                        </div>
                                </div> 
                                <div class="tab-content">
                                    <div class="tab-pane active" id="transferpower">              
                                        <livewire:mining-power-transfer-form/>
                                    </div>
                                    <div class="tab-pane" id="transferfund">
                                        <livewire:mining-fund-transfer/>
                                    </div>
                                </div>               
                            </div> 
                        </div>               
                </div> 
            </div>         
        </div>

        <div class="col-lg-6">
                <div class="element-wrapper">
                <h6 class="element-header">
                    Active Infos
                </h6>                

                <div class="row"> 

                       <div class="col-lg-12">
                            
                                <livewire:mining-active-infos-all/> 
                           
                        </div>
                    
                    

                        <div class="col-lg-12" style="padding-top: 20px;">
                        
                            <h6 class="element-header">
                                Add More Mining Power
                            </h6>                            
                            <livewire:cryptominingform/> 
                        
                    </div>

                </div>
            </div> 
        </div>

        <div class="col-sm-12" style="padding-top: 20px;">
            <div class="element-wrapper">
                <h6 class="element-header">
                   Purchased Devices
                </h6>
                 
                <livewire:mining-purchased-devices/>
                
            </div>
        </div>
    </div>

</div>

@endsection