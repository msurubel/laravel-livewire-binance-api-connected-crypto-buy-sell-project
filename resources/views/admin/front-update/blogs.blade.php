@extends('layouts.dashboard')
@section('content')

<div class="content-box">
    <div class="row">

        <div class="col-lg-4">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Catagorie List
                </h6>

                <div style="padding-bottom: 20px;">
                    <button class="btn btn-primary" data-target=".addcetagories" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add More</span></button> 
                </div>

                <!-- Cetagories Model -->
                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade addcetagories" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                    Add Catagorie
                                    </h5>
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{ route('catagories.add') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for=""> Name</label><input class="form-control" name="cat_name" type="text" required>
                                    </div>                                 
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Add Now</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Cetagories Model -->


                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                <thead>
                                    <tr>
                                    <th>
                                        Catagorie Name
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($catagories as $val)
                                    <a href="#">
                                    <tr>
                                    <td class="text-left">
                                        {{$val->name}}
                                    </td>
                                    <td class="nowrap">
                                        <span class="status-pill smaller green"></span><span>Active</span>
                                    </td>
                                    <td>
                                        <a href="/admin/catagories/delete/{{$val->id}}">Delete</a>
                                    </td>
                                    </tr>
                                    </a>
                                    @endforeach
                                    
                                </tbody>
                                </table>
                            </div>
                        </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Blog List
                </h6>


                <div style="padding-bottom: 20px;">
                    <a class="btn btn-primary" href="/admin/page?type=Blog&action=New" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add More</span></a> 
                </div>


                <div class="table-responsive">
                    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>View Frontend</th>
                            <th>Name/Edit</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <th>#</th>
                            <th>View Frontend</th>
                            <th>Name/Edit</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tfoot>
                        
                        <tbody>

                            @foreach($blog as $k=>$val)
                            <tr>
                            <td>{{++$k}}.</td>
                            <td><a href="/blogs/{{$val->blog_link}}" target="_blank"> View</a></td>
                            <td><a href="/admin/page/e/{{$val->blog_link}}/blog?type=Blog&action=Edit">{{$val->blog_tittle}}</a></td>
                            
                            <td>
                                @if($val->status==1)
                                <span class="badge badge-success">Active</span>
                                @elseif($val->status==2)<span class="badge badge-danger">Dective</span>
                                @endif
                            </td>

                            <td>{{$val->created_at->diffForHumans()}}</td>
                            <td>
                                <button class="btn btn-danger" data-target=".blogdelete{{$val->id}}" data-toggle="modal" type="button"><span>Delete</span></button>

                                <!-- Blog Delete Model -->
                                <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade blogdelete{{$val->id}}" role="dialog" tabindex="-1">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                        Delete Blog
                                        </h5>
                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        
                                    <p>Are you sure you want to delete <span style="color: red;"><strong>"{{$val->blog_tittle}}"</strong></span> Blog Permanently?
                                                                
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><a class="btn btn-success" href="/admin/blog/delete/{{$val->id}}"> Yes</a>
                                    </div>
                                    
                                    </div>
                                </div>
                            </div>
                            <!-- Blog Delete Model -->
                            </td>
                            @endforeach
                            
                            
                        
                        </tbody>
                
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection