<div class="row">
    <div class="col-lg-4">
        <div class="element-balances justify-content-between mobile-full-width">
            <div class="balance balance-v2">
            <div class="balance-title">
            Total Active Crypto Fees
            </div>                           

            <div class="balance-value">
                
            {{$cryptofees->count()}}

            </div>
            </div>                           
            
        </div>       
        
        <div class="element-wrapper pb-4 mb-4 border-bottom">
            <div class="element-box-tp"> 
                <button class="btn btn-primary" data-target=".addgetawaysnew" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add New Fees</span></button>                              
            </div>                        
        </div>
        


        <!-- Deposit Model -->
        <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade addgetawaysnew" role="dialog" tabindex="-1">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                    Add New Crypto Fees
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.crypto.fees.add') }}">
                    @csrf
                    <div class="form-group">
                        <label for=""> Coin Symbol</label><input class="form-control" name="symbol" type="text" required>
                    </div>
                    <div class="form-group">
                        <label for=""> Fees (USD)</label><input class="form-control" name="fees_usd" type="text" required>                                        
                    </div>
                                                        
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Add Now</button>
                </div>
                </form>
                </div>
            </div>
        </div>
        <!-- Deposit Model -->

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
        All Crypto Fees
        </h5>
        <div class="form-desc">
            
        </div>
        <div class="table-responsive">
            <table id="dataTable3" width="100%" class="table table-striped table-lightfont">
                <thead>
                    <tr>
                    <th>#</th>
                    <th>Symbol</th>
                    <th>Fees USD</th>
                    <th>Status</th> 
                    <th>Action</th>                                       
                    </tr>
                </thead>

                <tfoot>
                    <tr>
                    <th>#</th>
                    <th>Symbol</th>
                    <th>Fees USD</th>
                    <th>Status</th> 
                    <th>Action</th> 
                    </tr>
                </tfoot>
                
                <tbody>

                        @foreach($cryptofees as $k=>$val)
                        <tr>
                        <td>{{++$k}}.</td>
                        <td><strong> {{$val->symbol}} </strong></td>
                        <td>${{$val->fees_usd}}</td>
                        <td>
                            @if($val->status == 1)
                            <span class="badge badge-success">Active</span>
                            @else
                            <span class="badge badge-danger">Disabled</span>
                            @endif
                        </td>
                        <td>
                            @if($val->status == 1)
                            <a href="/admin/crypto/fees/disabled/{{$val->id}}">Disabled Now</a>
                            @else
                            <a href="/admin/crypto/fees/activated/{{$val->id}}">Active Now</a>
                            @endif
                        </td>                                        
                        </tr>                                        
                        @endforeach

                </tbody>
            
                </table>
            </div>
        </div>
                
    </div>
    

</div>