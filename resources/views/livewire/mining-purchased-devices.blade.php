<div id="sample" class="element-box">
    <div class="table-responsive">
        <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Ref. ID</th>
                    <th>Name</th>  
                    <th>Buy For</th>                                  
                    <th>Daily Mining Range</th> 
                    <th>kh/s Power</th>
                    <th>Quantity</th>  
                    <th>Buy Price</th> 
                    <th>Status</th>                     
                </tr>
            </thead>

            <tfoot>
                <tr>
                    <th>#</th>
                    <th>Ref. ID</th>
                    <th>Name</th> 
                    <th>Buy For</th>                                   
                    <th>Daily Mining Range</th> 
                    <th>kh/s Power</th> 
                    <th>Quantity</th> 
                    <th>Buy Price</th> 
                    <th>Status</th>                     
                </tr>
            </tfoot>       
            <tbody>
                @foreach($buydevice as $k=>$val)
                        <tr>
                            <td>{{++$k}}.</td>
                            <td>{{$val->order_ref}}</td>
                            <td><strong> {{$val->name}} </strong></td>  
                            <td><strong> {{$val->symbol_for}} </strong></td>                                         
                            <td>${{$val->day_income}}</td>
                            <td>{{$val->power_khs}} kh/s</td>
                            <td>{{$val->quantity}}</td>
                            <td>${{$val->buy_cost}}</td>
                            <td>
                                @if($val->status == 1)
                                <span class="badge badge-success">Active</span>
                                @elseif($val->status == 2)
                                <span class="badge badge-warning">Processing</span>
                                @else
                                <span class="badge badge-danger">Destroyed</span>
                                @endif
                            </td>                                                               
                        </tr>                                        
                    @endforeach
            </tbody>
        </table>
    </div>
</div>


<script>

</script>
    
        

