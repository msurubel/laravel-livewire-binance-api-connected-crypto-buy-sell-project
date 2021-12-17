<div wire:poll>    
    <div class="element-box-tp">
    <div class="table-responsive">
        <table class="table table-padded">
        <thead>
            <tr>
            <th class="text-left">
                Name
            </th>
            <th>
                Symbol
            </th>
            <th>
                Mining Balance
            </th>
            <th>
                Mining Power
            </th>            
            <th class="text-right">
                Status
            </th>
            </tr>
        </thead>
        <tbody>

            @foreach($miningcryptos as $val)
            <a href="#">
            <tr>
            <td class="text-left">
                <i class="cc {{$val->symbol}}" style="font-size: 22px; padding-right: 10px;"></i><span>{{$val->name}}</span>
            </td>
            <td class="nowrap">
                {{$val->symbol}}
            </td>
            <td>
                <span>{{number_format( $val->minig_balance, 6)}}</span>
            </td>
            <td class="cell-with-media">
                <span>{{$val->mining_power}} kH/s</span>
            </td>            
            <td class="text-right">
                @if($val->status == 1)
                <span class="status-pill smaller green"></span><span>Active</span>
                @elseif($val->status == 2)
                <span class="status-pill smaller red"></span><span>Not Active</span>
                @elseif($val->status == 3)
                <span class="status-pill smaller yellow"></span><span>Processing</span>
                @endif
            </td>
            </tr>
            </a>
            @endforeach
            
        </tbody>
        </table>
            <p style="text-align: center;">More Cryptos Coming Soon</p>
    </div>
    </div>
</div>