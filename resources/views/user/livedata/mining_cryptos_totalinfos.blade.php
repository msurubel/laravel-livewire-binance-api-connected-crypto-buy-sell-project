    <div class="col-lg-4">
        <div class="element-box el-tablo hover-item">
            <div class="label">
                Total kH/s
            </div>
            <div class="value">
                {{$totalkhs}} <span style="font-size: 13px;">kH/s</span>
            </div>                       
        </div>
    </div>

    <div class="col-lg-4">
        <div class="element-box el-tablo hover-item">
            <div class="label">
                Mining Value (USD)
            </div>
            <div class="value">
                ${{number_format( $totalminingusd, 2)}}
            </div>                       
        </div>
    </div>

    <div class="col-lg-4">
        <div class="element-box el-tablo hover-item">
            <div class="label">
                Active Cryptos
            </div>
            <div class="value">
                {{$activecoins}}
            </div>                       
        </div>
    </div>
