                    
                    
                        

                                        @foreach($cryptos as $k=>$val)
                                        <tr>
                                        <td>{{++$k}}.</td>
                                        <td><a href="/dashboard/crypto/{{$val->id}}/?name={{$val->name}}&symbol={{$val->symbol}}{{$set->main_crypto}}"> {{$val->name}} </a></td>
                                        <td> {{$val->symbol}}</td>
                                        <td>{{$val->price}}</td>
                                        <td>{{$val->crypto_change}}</td> 
                                        <td>{{$val->crypto_vlm}}</td>                                        
                                        </tr>                                        
                                        @endforeach
                                        
                                        
                                    
                                    