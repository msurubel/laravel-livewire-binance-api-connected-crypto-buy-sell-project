@extends('layouts.dashboard')
@section('content')



        <div class="content-i">
            <div class="content-box">
                <div class="os-tabs-w">

                    <div class="row">
                        
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="os-tabs-controls os-tabs-complex">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#tab_overview"><span class="tab-label">                            
                                                @if(substr(app('request')->input('symbol'), -4) == 'USDT')
                                                {{substr(app('request')->input('symbol'), 0, -4)}} Balance
                                                @else
                                                {{substr(app('request')->input('symbol'), 0, -3)}} Balance
                                                @endif
                                                </span></span></a>
                                            </li>                        
                                        </ul>
                                    </div>
                                </div>

                                <div class="col-lg-7">
                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div style="">
                                            @if(substr($symbol, -4) == 'USDT')
                                                <button class="btn btn-white" onclick="location.href='/dashboard/trade/spot/{{substr($symbol, 0, -4)}}USDT?symbol={{substr($symbol, 0, -4)}}USDT'" type="button"><i class="cf cf-usdt" style="padding-right: 5px;"></i><span>USDT</span></button>
                                                @if(substr($symbol, 0, -4) == 'BTC')

                                                @else
                                                <button class="btn btn-white" onclick="location.href='/dashboard/trade/spot/{{substr($symbol, 0, -4)}}BTC?symbol={{substr($symbol, 0, -4)}}BTC'" type="button"><i class="cf cf-btc" style="padding-right: 5px;"></i><span>BTC</span></button>
                                                @endif
                                                @if(substr($symbol, 0, -4) == 'ETH')

                                                @else
                                                <button class="btn btn-white" onclick="location.href='/dashboard/trade/spot/{{substr($symbol, 0, -4)}}ETH?symbol={{substr($symbol, 0, -4)}}ETH'" type="button"><i class="cf cf-eth" style="padding-right: 5px;"></i><span>ETH</span></button>
                                                @endif
                                            @else
                                                <button class="btn btn-white" onclick="location.href='/dashboard/trade/spot/{{substr($symbol, 0, -3)}}USDT?symbol={{substr($symbol, 0, -3)}}USDT'" type="button"><i class="cf cf-usdt" style="padding-right: 5px;"></i><span>USDT</span></button>
                                                @if(substr($symbol, 0, -3) == 'BTC')

                                                @else
                                                <button class="btn btn-white" onclick="location.href='/dashboard/trade/spot/{{substr($symbol, 0, -3)}}BTC?symbol={{substr($symbol, 0, -3)}}BTC'" type="button"><i class="cf cf-btc" style="padding-right: 5px;"></i><span>BTC</span></button>
                                                @endif
                                                @if(substr($symbol, 0, -3) == 'ETH')

                                                @else
                                                <button class="btn btn-white" onclick="location.href='/dashboard/trade/spot/{{substr($symbol, 0, -3)}}ETH?symbol={{substr($symbol, 0, -3)}}ETH'" type="button"><i class="cf cf-eth" style="padding-right: 5px;"></i><span>ETH</span></button>
                                                @endif
                                            @endif
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">                            
                            
                            @livewire('marketsentiment', ['symbol' => "{$symbol}"]) 

                        </div>

                    </div>                    

                </div>
                <div class="row">
                    <div class="col-lg-4">                        
                        @livewire('single-crypto-balance', ['symbol' => "{$symbol}"])                       
                    </div>

                    <div class="col-lg-4">

                        @if(auth()->user()->theme_set == 1)
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <div class="tradingview-widget-copyright"><span class="blue-text">{{ app('request')->input('symbol') }} </span>Market Price</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                        {
                        "symbol": "BINANCE:{{ app('request')->input('symbol') }}",
                        "width": "100%",
                        "height": "100%",
                        "locale": "en",
                        "dateRange": "1D",
                        "colorTheme": "light",
                        "trendLineColor": "rgba(41, 98, 255, 1)",
                        "underLineColor": "rgba(41, 98, 255, 0.3)",
                        "underLineBottomColor": "rgba(41, 98, 255, 0)",
                        "isTransparent": false,
                        "autosize": true,
                        "largeChartUrl": ""
                        }
                        </script>
                        </div>
                        <!-- TradingView Widget END -->
                        @else
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                        <div class="tradingview-widget-container__widget"></div>
                        <div class="tradingview-widget-copyright"><span class="blue-text">{{ app('request')->input('symbol') }} </span>Market Price</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                        {
                        "symbol": "BINANCE:{{ app('request')->input('symbol') }}",
                        "width": "100%",
                        "height": "100%",
                        "locale": "en",
                        "dateRange": "1D",
                        "colorTheme": "dark",
                        "trendLineColor": "rgba(41, 98, 255, 1)",
                        "underLineColor": "rgba(41, 98, 255, 0.3)",
                        "underLineBottomColor": "rgba(41, 98, 255, 0)",
                        "isTransparent": false,
                        "autosize": true,
                        "largeChartUrl": ""
                        }
                        </script>
                        </div>
                        <!-- TradingView Widget END -->
                        @endif

                    </div>
                    
                    <div class="col-lg-4">
                    @if(auth()->user()->theme_set == 1)
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                        <div id="tradingview_8ca0c"></div>
                        <div class="tradingview-widget-copyright"><span class="blue-text">{{ app('request')->input('symbol') }} </span>Overview</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.MediumWidget(
                        {
                        "symbols": [
                            [
                            "Bitcoin",
                            "BINANCE:{{ app('request')->input('symbol') }}|12M"
                            ]
                        ],
                        "chartOnly": true,
                        "width": "100%",
                        "height": "100%",
                        "locale": "en",
                        "colorTheme": "light",
                        "gridLineColor": "rgba(240, 243, 250, 0)",
                        "trendLineColor": "#2962FF",
                        "fontColor": "#787B86",
                        "underLineColor": "rgba(41, 98, 255, 0.3)",
                        "underLineBottomColor": "rgba(41, 98, 255, 0)",
                        "isTransparent": false,
                        "autosize": true,
                        "container_id": "tradingview_8ca0c"
                        }
                        );
                        </script>
                        </div>
                        <!-- TradingView Widget END -->
                        @else
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                        <div id="tradingview_8ca0c"></div>
                        <div class="tradingview-widget-copyright"><span class="blue-text">{{ app('request')->input('symbol') }} </span>Overview</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.MediumWidget(
                        {
                        "symbols": [
                            [
                            "Bitcoin",
                            "BINANCE:{{ app('request')->input('symbol') }}|12M"
                            ]
                        ],
                        "chartOnly": true,
                        "width": "100%",
                        "height": "100%",
                        "locale": "en",
                        "colorTheme": "dark",
                        "gridLineColor": "rgba(240, 243, 250, 0)",
                        "trendLineColor": "#2962FF",
                        "fontColor": "#787B86",
                        "underLineColor": "rgba(41, 98, 255, 0.3)",
                        "underLineBottomColor": "rgba(41, 98, 255, 0)",
                        "isTransparent": false,
                        "autosize": true,
                        "container_id": "tradingview_8ca0c"
                        }
                        );
                        </script>
                        </div>
                        <!-- TradingView Widget END -->
                        @endif

                    </div>
                    
                    
                    
                    

                </div>

                <br>


                
                  
        


                <div class="row">

                    <div class="col-sm-4">

                            <div class="content-box">
                                <div class="os-tabs-w">
                                    <div class="os-tabs-controls os-tabs-complex">
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                            <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#cryptobuy"><span class="tab-label">BUY</span></a>
                                            </li>
                                            <li class="nav-item">
                                            <a aria-expanded="false" class="nav-link" data-toggle="tab" href="#cryptosell"><span class="tab-label">SELL</span></a>
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
                                        <div class="tab-pane active" id="cryptobuy">                                       
                                            @livewire('showtradingbuyprice', ['amount' => '', 'costs' => '0', 'symbol' => "{$symbol}", 'userbalance' => "{$sellcryptoblnc}"])    
                                        </div> 
                                        <div class="tab-pane" id="cryptosell">                                               
                                            @livewire('showtradingsellprice', ['amount' => '', 'costs' => '0', 'symbol' => "{$symbol}", 'userbalance' => "{$buycryptoblnc}"])
                                        </div> 
                                    </div>

                            </div>

                        </div>

                        <div class="col-sm-3"><br><br>

                        <div class="element-wrapper compact">
                            <div class="element-actions actions-only">
                            <a class="element-action element-action-fold" href="#"><i class="os-icon os-icon-minus-circle"></i></a>
                            </div>
                            <h6 class="element-header">
                            @if(substr($symbol, -4) == 'USDT')
                                {{substr($symbol, 0, -4)}} Open Orders
                            @else
                                {{substr($symbol, 0, -3)}} Open Orders
                            @endif
                            </h6>
                            <div class="element-box-tp">
                            <div style="width: auto; height: 450px; overflow: hidden;">
                            <table class="table table-compact smaller text-faded mb-0">
                                <thead>
                                <tr>
                                    <th>
                                    Type
                                    </th>
                                    <th class="text-center">
                                    Price
                                    </th>
                                    <th class="text-right">
                                    Qty
                                    </th>
                                    <th class="text-right">
                                    Quote Qty
                                    </th>
                                </tr>
                                </thead>
                                
                                <tbody id="trades">
                                                                                                 
                                </tbody>
                                                
                            </table>
                            </div>
                            </div>
                        </div>

                        <!--
                        <div class="element-wrapper compact folded">
                            <div class="element-actions actions-only">
                            <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search crypto.." />                            
                            <a class="element-action element-action-fold" href="#"><i class="os-icon os-icon-minus-circle"></i></a>                            
                            </div>
                            <h6 class="element-header">
                            Cryptos
                            </h6>
                            <div class="element-box-tp" style="display:none;">
                            <div style="width: auto; height: 350px; overflow-y: scroll; overflow-x: hidden;">
                            <table class="table table-compact smaller text-faded mb-0" id="myTable">
                                <thead>
                                <tr>
                                    <th>
                                    Symbol
                                    </th>
                                    <th class="text-center">
                                    Price
                                    </th>
                                </tr>
                                </thead>
                                
                                <tbody id="allcryptosdataintable">
                                                                                                                                     
                                </tbody>
                                                
                            </table>
                            </div>
                            </div>
                        </div>
                    -->


                        
                        
                    </div>

                    <div class="col-sm-5">
                    @if(auth()->user()->theme_set == 1)
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                        <div id="tradingview_bb180"></div>
                        <div class="tradingview-widget-copyright"><span class="blue-text">{{ app('request')->input('symbol') }} </span>Chart</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.widget(
                        {
                        "width": 635,
                        "height": 600,
                        "symbol": "BINANCE:{{ app('request')->input('symbol') }}",
                        "interval": "240",
                        "timezone": "Etc/UTC",
                        "theme": "light",
                        "style": "1",
                        "locale": "en",
                        "toolbar_bg": "#f1f3f6",
                        "enable_publishing": false,
                        "hide_top_toolbar": true,
                        "hide_legend": true,
                        "save_image": false,
                        "container_id": "tradingview_bb180"
                        }
                        );
                        </script>
                        </div>
                        <!-- TradingView Widget END -->
                        @else
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                        <div id="tradingview_bb180"></div>
                        <div class="tradingview-widget-copyright"><span class="blue-text">{{ app('request')->input('symbol') }} </span>Chart</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.widget(
                        {
                        "width": 635,
                        "height": 600,
                        "symbol": "BINANCE:{{ app('request')->input('symbol') }}",
                        "interval": "240",
                        "timezone": "Etc/UTC",
                        "theme": "dark",
                        "style": "1",
                        "locale": "en",
                        "toolbar_bg": "#f1f3f6",
                        "enable_publishing": false,
                        "hide_top_toolbar": true,
                        "hide_legend": true,
                        "save_image": false,
                        "container_id": "tradingview_bb180"
                        }
                        );
                        </script>
                        </div>
                        <!-- TradingView Widget END -->
                        @endif

                    </div>

                

                
                </div>

                <br>

                <div class="row">
                
                    <div class="col-sm-12">
                        <div class="element-box">
                            <h5 class="form-header">
                            {{ app('request')->input('name') }} Orders
                            </h5>
                            <div class="form-desc">
                                Here you can find all detailed BUY, SELL & LIMIT Transections
                            </div>
                            <div class="table-responsive">
                                <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Ref ID</th>
                                        <th>Order ID</th>
                                        <th>Client Order ID</th>
                                        <th>Asset Name</th>
                                        <th>Amount</th>
                                        <th>Price</th>
                                        <th>Cost</th>
                                        <th>Market Type</th>
                                        <th>Order Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!--<th>Action</th>-->
                                        </tr>
                                    </thead>

                                    <tfoot>
                                        <th>#</th>
                                        <th>Ref ID</th>
                                        <th>Order ID</th>
                                        <th>Client Order ID</th>
                                        <th>Asset Name</th>
                                        <th>Amount</th>
                                        <th>Price</th>
                                        <th>Cost</th>
                                        <th>Market Type</th>
                                        <th>Order Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <!--<th>Action</th>-->
                                    </tfoot>
                                    
                                    <tbody>

                                    @livewire('single-crypto-trade-list', ['symbol' => "{{ app('request')->input('symbol') }}"])
                                    
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
                                    <table id="dataTable2" width="100%" class="table table-striped table-lightfont">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Ref ID</th>
                                            <th>Method Name</th>
                                            <th>Method Details</th>
                                            <th>amount</th>
                                            <th>fees</th>
                                            <th>Status</th>                                            
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

        
    <script>
function myFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}
</script>


            <script>
            setInterval(tradestime, 1000);
            function tradestime(){
            fetch("https://api.binance.com/api/v3/trades?symbol={{ app('request')->input('symbol') }}").then(
            res=>{
            res.json().then(
            data=>{
            console.log(data);
            if(data.length > 0){
            var temp = "";

            //---- Start for loop
            data.forEach((u)=>{
            if(u.isBuyerMaker == true){
            temp += "<tr style='color: green;'>";
            }
            else{
                temp += "<tr style='color: red;'>";
            }
            if(u.isBuyerMaker == true){
                temp += "<td>BUY</td>";
            }
            else{
                temp += "<td>SELL</td>";
            }
            temp += "<td>"+u.price+"</td>";
            temp += "<td>"+u.qty+"</td>";
            temp += "<td>"+u.quoteQty+"</td></tr>";
            })
            //---Close for loop
            document.getElementById("trades").innerHTML = temp;
            }
            }
            )}
            )}
            </script>
@endsection