@extends('layouts.dashboard')
@section('content')



        <div class="content-i">
            <div class="content-box">
              <div class="os-tabs-w">
                <div class="os-tabs-controls os-tabs-complex">
                  <ul class="nav nav-tabs">
                    <li class="nav-item">
                      <a aria-expanded="false" class="nav-link active" data-toggle="tab" href="#tab_overview"><span class="tab-label">All Coins</span></a>
                    </li>
                    
                  </ul>
                </div>
              </div>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="element-balances justify-content-between mobile-full-width">
                            <div class="balance balance-v2">
                                                       

                            <div class="balance-value">
                                
                              <span>{{App\Models\cryptos::wherestatus(1)->count()}} Coin Avilable for Trade</span><br>
                              <span style="font-size: 15px; color: gray;">We closely work with the crypto market to add more currency.</span>

                            </div>
                            </div>                           
                            
                        </div>                       
                        

                    </div>

                    <div class="col-lg-8">

                        <!-- Balance Side Panel -->

                    </div>
                    

                </div>

                <br>

                <div class="row">
                
                    
                  <div class="col-sm-12">
                    
                  <div class="element-box">
                                <h5 class="form-header">
                                All Cryptocurrency
                                </h5>
                                <div class="form-desc">
                                    Here you can find all cryptos that avilable for trade.
                                </div>
                                <div class="table-responsive">
                                    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                                        <thead>
                                            <tr>
                                            <th>#</th>
                                            <th>Coin Name</th>
                                            <th>Coin Symbol</th>
                                            <th>You Have</th>
                                            <th>Trade With</th>                                                                                        
                                            </tr>
                                        </thead>

                                        <tfoot>
                                            <tr>
                                            <th>#</th>
                                            <th>Coin Name</th>
                                            <th>Coin Symbol</th>
                                            <th>You Have</th>
                                            <th>Trade With</th>
                                            </tr>
                                        </tfoot>
                                        
                                        <tbody>
                                            @foreach($cryptos as $k=>$coins)
                                            <tr class="@if(App\Models\balances::wheresymbol($coins->symbol)->whereuser_id(auth()->user()->id)->first()) tablebox @else @endif">
                                            <td>{{++$k}}</td>
                                            <td><i class="cf cf-{{strtolower($coins->symbol)}}" style="font-size: 20px; color: #5abb66; padding-right: 10px;"></i> {{$coins->name}}</td>
                                            <td>{{$coins->symbol}}</td>
                                            <td>
                                              
                                                @if(App\Models\balances::wheresymbol($coins->symbol)->whereuser_id(auth()->user()->id)->first())
                                                  @if(App\Models\balances::wheresymbol($coins->symbol)->whereuser_id(auth()->user()->id)->first()->balance > 1)
                                                    <span style="font-weight: 900; font-size: 18px;">{{number_format (App\Models\balances::wheresymbol($coins->symbol)->whereuser_id(auth()->user()->id)->first()->balance, 2)}} {{$coins->symbol}}<span>
                                                  @else
                                                    <span style="font-weight: 900; font-size: 18px;">{{number_format (App\Models\balances::wheresymbol($coins->symbol)->whereuser_id(auth()->user()->id)->first()->balance, 7)}} {{$coins->symbol}}<span>
                                                  @endif
                                                @else
                                                <span style="color: red;">0 {{$coins->symbol}}<span>
                                                @endif
                                              
                                            </td>
                                            <td><a href="/dashboard/trade/spot/{{$coins->symbol}}USDT?symbol={{$coins->symbol}}USDT">USDT</a>  |  @if($coins->symbol == "BTC") @else<a href="/dashboard/trade/spot/{{$coins->symbol}}BTC?symbol={{$coins->symbol}}BTC">BTC</a>  |@endif  @if($coins->symbol == "ETH") @else<a href="/dashboard/trade/spot/{{$coins->symbol}}ETH?symbol={{$coins->symbol}}ETH">ETH</a>@endif</td>
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
@endsection