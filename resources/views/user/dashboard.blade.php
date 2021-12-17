@extends('layouts.dashboard')

@section('content')


          
          
          <div class="content-i">
            <div class="content-box">
              <div class="os-tabs-w">
                <div class="os-tabs-controls os-tabs-complex">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#tab_overview"><span class="tab-label">Balance</span></a>
                    </li>
                    
                  </ul>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-lg-8 col-xxl-6">
                  
                    <div class="row">

                      <div class="col-lg-6">

                          <div class="element-balances justify-content-between mobile-full-width">
                            <div class="balance balance-v2">
                                <div class="balance-title">
                                  Portfolio Balance
                                </div>
                                <div class="balance-value">
                                  
                                      @include('user.livedata.get_balance')                            

                                </div>
                                <br><p>Account Balance: ${{ number_format(auth()->user()->balance, 2) }}</p>
                              </div>                        
                          </div>

                     
                  
                          <div class="element-wrapper pb-4 mb-4 border-bottom">
                            <div class="element-box-tp">
                              <a class="btn btn-primary" href="/dashboard/account/main"><i class="os-icon os-icon-log-out"></i><span>Go To Main Account</span></a><a data-target=".sendmoney" data-toggle="modal" class="btn btn-grey d-sm-inline-block" href="#"><i class="os-icon os-icon-plus-circle"></i><span>Send Money</span></a>

                              <!-- Deposit Model -->
                              <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade sendmoney" role="dialog" tabindex="-1">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                            Send Money
                                            </h5>
                                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('send.money') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label for=""> Send to Email ID</label><input class="form-control" name="sendto" type="text" required>
                                            </div>
                                            <div class="form-group">
                                                <label for=""> Amount in USD</label><input class="form-control" name="amount" type="text" required>
                                            </div>                                                                    
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-success" type="submit"> Send</button>
                                        </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Deposit Model -->
                            </div>
                          </div>
                      </div>

                          <div class="col-lg-6" style="padding: 20px;">

                            @forelse($singlechart as $chart)
                            @if(auth()->user()->theme_set == 1)
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><span class="blue-text">{{$chart->symbol}}USDT </span>Market Price</div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                            {
                            "symbol": "BINANCE:{{$chart->symbol}}USDT",
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
                            <div class="tradingview-widget-copyright"><span class="blue-text">{{$chart->symbol}}USDT </span>Market Price</div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                            {
                            "symbol": "BINANCE:{{$chart->symbol}}USDT",
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
                            @empty
                            @if(auth()->user()->theme_set == 1)
                            <!-- TradingView Widget BEGIN -->
                            <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            <div class="tradingview-widget-copyright"><span class="blue-text">BTCUSDT </span>Market Price</div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                            {
                            "symbol": "BINANCE:BTCUSDT",
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
                            <div class="tradingview-widget-copyright"><span class="blue-text">BTCUSDT </span>Market Price</div>
                            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-mini-symbol-overview.js" async>
                            {
                            "symbol": "BINANCE:BTCUSDT",
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
                            @endforelse
                            
                          </div>

                    </div>


                  <div class="element-wrapper compact">
                    <div class="element-box-tp">
                      <div class="element-actions d-none d-sm-block">
                        
                      
                        
                      </div>
                      
                        @forelse($singlechart as $chart)
                        @if(auth()->user()->theme_set == 1)
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                        <div id="tradingview_8ca0c"></div>
                        <div class="tradingview-widget-copyright"><span class="blue-text">{{$chart->symbol}}USDT </span>Overview</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.MediumWidget(
                        {
                        "symbols": [
                            [
                            "Bitcoin",
                            "BINANCE:{{$chart->symbol}}USDT|12M"
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
                        <div class="tradingview-widget-copyright"><span class="blue-text">{{$chart->symbol}}USDT </span>Overview</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.MediumWidget(
                        {
                        "symbols": [
                            [
                            "Bitcoin",
                            "BINANCE:{{$chart->symbol}}USDT|12M"
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
                        @empty
                        @if(auth()->user()->theme_set == 1)
                        <!-- TradingView Widget BEGIN -->
                        <div class="tradingview-widget-container">
                        <div id="tradingview_8ca0c"></div>
                        <div class="tradingview-widget-copyright"><span class="blue-text">BTCUSDT </span>Overview</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.MediumWidget(
                        {
                        "symbols": [
                            [
                            "Bitcoin",
                            "BINANCE:BTCUSDT|12M"
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
                        <div class="tradingview-widget-copyright"><span class="blue-text">BTCUSDT </span>Overview</div>
                        <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                        <script type="text/javascript">
                        new TradingView.MediumWidget(
                        {
                        "symbols": [
                            [
                            "Bitcoin",
                            "BINANCE:BTCUSDT|12M"
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
                        @endforelse
                      

                    </div>
                  </div>
                </div>
                <div class="col-sm-2 d-none d-xxl-block">
                  <div style="width: auto; height: 510px; overflow: hidden;">
                    <div class="balance-title">
                          <strong>Ballance By Crypto Assets</strong>
                        </div>
                    <!-- Balance Side Panel -->
                    @include('user.livedata.get_crypto_blnc')                    
                  </div>
                  <a class="centered-load-more-link" href="/dashboard/balances/cryptos"><span>See All Balances</span></a>
                </div>
                
                @foreach($ads as $siteads)
                <div class="col-sm-4 d-none d-lg-block">
                  <div class="cta-w cta-with-media" style="background-image: url('/images/ads/{{$siteads->background_image}}');">
                    <div class="cta-content">
                      <div class="highlight-header">
                        {{$siteads->hilight_text}}
                      </div>
                      <h3 class="cta-header">
                        {!! $siteads->headline !!}
                      </h3>
                      <p style="line-height: 1.4;">
                        {!! $siteads->body_text !!}
                      </p><br>
                        <a class="btn btn-primary" href="{{$siteads->button_link}}">Click Here</a>
                    </div>
                    <div class="cta-media">
                      <img alt="" src="/images/ads/{{$siteads->ad_image}}">
                    </div>
                  </div>
                </div>
                @endforeach

                
              </div>
              <br>


              <!-- All crypto Data collected from live_data_update.js -->  
              <div class="element-wrapper">
              <h6 class="element-header">
              ALL Crypto Coins
              </h6>
              
              <div style="padding-right: 10px; width: auto; height: 400px; overflow-y: scroll; overflow-x: hidden;">
                  <div id="loadingDiv" style="margin-top: 7%; text-align: center; width: auto;">
                  <img alt="" width="40px" src="/img/loading-2.gif"><br><br>
                  <span>Loading<br><strong>Crypto Coins</strong></span>
                  </div>

                <div class="row pt-2" id="allcryptosdata">
                  
                
                </div>
                
              </div>
              </div>
              <!-- All crypto Data collected from live_data_update.js -->
              
              <a class="centered-load-more-link" href="/dashboard/cryptos/all"><span>See All Cryptos</span></a>
              <div class="row">
                <div class="col-sm-8">
                  
                  <div class="row">
                    <div class="col-12 col-xxl-8">
                      <div class="element-wrapper compact pt-4">
                        
                        <h6 class="element-header">
                          Blogs
                        </h6>
                        <div class="element-box-tp">

                        @foreach($blogs as $val)
                          <div class="post-box">
                            <div class="post-media" style="background-image: url(/images/blog/{{$val->image}})"></div>
                            <div class="post-content">
                              <h6 class="post-title">
                                {{$val->blog_tittle}}
                              </h6>
                              <div class="post-text">
                              {{$val->blog_short}} 
                              </div>
                              <div class="post-foot">
                                
                                <a class="post-link" href="/blogs/{{$val->blog_link}}" target="_balnk"><span>Read Full Story</span><i class="os-icon os-icon-arrow-right7"></i></a>
                              </div>
                            </div>
                          </div>
                          @endforeach
                          
                          <a class="centered-load-more-link" href="/blogs" target="_blank"><span>Read Our Blog</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 d-sm-none d-xxl-block col-xxl-4">
                      <br>
                      <div class="cta-w orange text-center">
                        <div class="cta-content extra-padded">
                          <div class="highlight-header">
                            Bonus
                          </div>
                          <h5 class="cta-header">
                            Invite your friends and make money with referrals
                          </h5>
                          <form action="">
                            <div class="newsletter-field-w">
                              <input placeholder="Email address..." type="text"><button class="btn btn-sm btn-primary">Send</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="element-wrapper compact pt-4">
                    <div class="element-actions">
                      
                    </div>
                    <h6 class="element-header">
                      Transactions
                    </h6>
                    <div class="element-box-tp">
                      <table class="table table-clean">

                        @foreach($transections as $val)
                        <tr>
                          <td>
                            <div class="value">
                              {{$val->method_name}}
                            </div>
                            <span class="sub-value">{{$val->method_symbol}}</span>
                          </td>
                          <td class="text-right">
                            <div class="value">
                              ${{$val->amount}}
                            </div>
                            <span class="sub-value">{{$val->created_at->diffForHumans()}}</span>
                          </td>
                        </tr>
                        @endforeach
                        
                      </table>
                      <a class="centered-load-more-link" href="/dashboard/account/main"><span>View All Account Transections</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>



          <script>
          function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("SearchmyInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("SearchmyTable");
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
      
@endsection
