<div class="row">
    <div class="element-box">
        @foreach($coins as $coin)
        <div class="col-lg-4">
            <p>{{$coin['symbol']}}</p>
            <p>{{$coin['price']}}</p>
        </div>
        @endforeach
    </div>
</div>