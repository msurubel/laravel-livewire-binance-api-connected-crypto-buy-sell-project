                    @foreach($cryptos as $val)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="media">
                                    <span><i class="cc {{$val->symbol}}"></i></span>
                                    <div class="media-body">
                                        {{$val->name}}
                                    </div>
                                </div>
                                <p class="mb-0"> 24h</p>
                            </div>
                            <div class="card-body">
                                <h3>USD {{number_format( $val->price , 2) }}</h3>
                                <span class="text-success">{{$val->crypto_change}}</span>
                                
                                <!-- TradingView Widget BEGIN -->
                                <div class="tradingview-widget-container">
                                <div id="tradingview_9f157{{$val->id}}"></div>                                
                                <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                                <script type="text/javascript">
                                new TradingView.MediumWidget(
                                {
                                "symbols": [
                                    [
                                    "BINANCE:{{$val->symbol}}{{$set->main_crypto}}|12M"
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
                                "container_id": "tradingview_9f157{{$val->id}}"
                                }
                                );
                                </script>
                                </div>
                                <!-- TradingView Widget END -->
                            </div>
                        </div>
                    </div>
                    @endforeach