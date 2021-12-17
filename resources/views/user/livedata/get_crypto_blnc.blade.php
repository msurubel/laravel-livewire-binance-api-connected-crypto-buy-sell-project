<div id="getcryptobalance">

<table class="table table-clean">


                        @foreach($balances as $val)
                        <tr>
                          <td>
                            <div class="value">
                              {{$val->symbol}}
                            </div>
                            <span class="sub-value">{{$val->name}}</span>
                          </td>
                          <td class="text-right">
                            <div class="value">
                            {{number_format($val->balance, 6)}}
                            </div>
                            <span class="sub-value">${{number_format($val->balance_usd, 2)}}</span>
                          </td>
                        </tr>
                        @endforeach                      
                        
                        
</table>
</div>