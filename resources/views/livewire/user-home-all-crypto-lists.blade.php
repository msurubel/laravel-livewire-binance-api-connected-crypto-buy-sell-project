<div class="row pt-2"> 

    @foreach($allcryptos as $lists)
    <div class="col-6 col-sm-3 col-xxl-2">
    <a class="element-box el-tablo centered trend-in-corner smaller" href="#">
        <div class="label">
        {{$lists['symbol']}} Price
        </div>
        <div class="value">
        @if($lists['price'] > 1)
        {{number_format ($lists['price'], 2)}}
        @else
        {{number_format ($lists['price'], 6)}}
        @endif
        </div>
        @foreach($cryptochanges as $change)
            @if($lists['symbol'] == $change['symbol'])
                @if(substr($change['priceChange'], -0, 1) == "-")
                <div class="trending trending-down">
                @else
                <div class="trending trending-up">
                @endif
            <span>{{number_format ($change['priceChange'], 2)}}%</span><i class="os-icon os-icon-arrow-up6"></i>
            </div>
            @else
            
            @endif
        @endforeach
    </a>
    </div>
    @endforeach

</div>
