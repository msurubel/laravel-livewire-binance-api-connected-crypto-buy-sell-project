@extends('layouts.dashboard')
@section('content')

<div class="content-box">
    <div class="row">

        <div class="col-6">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Header Navigation
                </h6>

                <div style="padding-bottom: 20px;">
                    <button class="btn btn-success" data-target=".headermainmenu" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add Main Menu</span></button>
                    <button class="btn btn-primary" data-target=".headersubmenu" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add Sub Menu</span></button> 
                </div>

                        <!-- Header Main Menu Model -->
                        <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade headermainmenu" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                    Add Main Manu
                                    </h5>                                    
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                </div>                                
                                <div class="modal-body">
                                <p>The Menu added on Header Section as a Main Menu</p>
                                    <form method="POST" action="{{ route('admin.main.nev.add') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for=""> Name</label><input class="form-control" name="name" type="text" required>
                                    </div>  
                                    <div class="form-group">
                                        <label for=""> Link</label><input class="form-control" name="link" type="text" required>
                                    </div>  
                                    <div class="form-group">
                                        <label for=""> Place Line</label><input class="form-control" name="place_id" type="number" required>
                                    </div>                              
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Add Now</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Header Main Menu Model -->


                        <!-- Header sub Menu Model -->
                        <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade headersubmenu" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                    Add Sub Manu
                                    </h5>                                    
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                </div>                                
                                <div class="modal-body">
                                <p>The Menu added on Header Section as a sub Menu under the your prefered main Menu</p>
                                    <form method="POST" action="{{ route('admin.sub.nev.add') }}">
                                    @csrf
                                    <div class="form-group">
                                        <select class="form-control" name="main_menu_id">
                                
                                            @foreach($headermain as $val)
                                            <option value="{{$val->id}}">
                                            {{$val->name}}
                                            </option>                                            
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Name</label><input class="form-control" name="name" type="text" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for=""> Link</label><input class="form-control" name="link" type="text" required>
                                    </div>                                                                     
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Add Now</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Header sub Menu Model -->


                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                <thead>
                                    <tr>
                                    <th class="text-left">
                                        Name
                                    </th>
                                    <th class="text-right">
                                        Action
                                    </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($headermain as $mainnev)
                                    <a href="#">
                                    <tr>
                                    <td class="text-left">
                                        {{$mainnev->name}}
                                    </td>                                    
                                    <td class="text-right">                                        
                                        <a class="btn btn-danger" href="/admin/ui/navigation/main/delete/{{$mainnev->id}}">Delete</a>
                                        <button type="button" id="mainmenueditshowbtn{{$mainnev->ref_id}}" style="display:inline-block;" class="btn btn-success" onclick="mainmenuedit{{$mainnev->ref_id}}(this)">Edit</button>
                                        <button type="button" id="mainmenueditclosebtn{{$mainnev->ref_id}}" style="display:none;" class="btn btn-primary" onclick="mainmenuclose{{$mainnev->ref_id}}(this)">Close</button>
                                    </td>
                                   
                                    </tr>  
                                    
                                    <tr id="mainmenueditshow{{$mainnev->ref_id}}"  style="display:none;">
                                        <form method="POST" action="{{ route('admin.main.nev.edit') }}">
                                        @csrf
                                            <td>
                                                <div class="form-group">
                                                    <label for=""> Edit Name</label><input class="form-control" value="{{$mainnev->name}}" name="name" type="text" required>
                                                    <input class="form-control" value="{{$mainnev->ref_id}}" name="mainnevid" type="hidden" required>
                                                </div>                                            
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for=""> Edit Link</label><input class="form-control" value="{{$mainnev->link}}" name="link" type="text" required>
                                                </div> 
                                                <div class="form-group">
                                                    <label for=""> Edit Place</label><input class="form-control" value="{{$mainnev->place_id}}" name="place_id" type="number" required>
                                                </div>                                           
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="submit"> Save</button>                                            
                                            </td>
                                        </form>
                                    </tr>

                                    <script>
                                    const mainmenuedit{{$mainnev->ref_id}} = (element) => {  
                                        document.getElementById('mainmenueditshowbtn{{$mainnev->ref_id}}').style.display = "none";                                                                                        
                                        document.getElementById('mainmenueditshow{{$mainnev->ref_id}}').style.display = "inline-block";
                                        document.getElementById('mainmenueditclosebtn{{$mainnev->ref_id}}').style.display = "inline-block";
                                        
                                    }

                                    const mainmenuclose{{$mainnev->ref_id}} = (element) => {                                                                                                                                    
                                        document.getElementById('mainmenueditshow{{$mainnev->ref_id}}').style.display = "none";
                                        document.getElementById('mainmenueditclosebtn{{$mainnev->ref_id}}').style.display = "none";
                                        document.getElementById('mainmenueditshowbtn{{$mainnev->ref_id}}').style.display = "inline-block";
                                        
                                    }
                                    </script>
                                    </a>                                    

                                    
                                    @foreach($headersub as $subnev)

                                    @if($mainnev->id == $subnev->main_menu_id)
                                    <a href="#">
                                    <tr>
                                    <td class="text-left">
                                        <div style="padding-left: 30px;"><i class="os-icon os-icon-arrow-right3" style="color: #047bf8;"></i> {{$subnev->name}} </div>
                                    </td>                                    
                                    
                                    <td class="text-right">                                        
                                        <a class="btn btn-danger" href="/admin/ui/navigation/sub/delete/{{$subnev->id}}">Delete</a>
                                        <button type="button" id="mainmenueditshowbtn{{$subnev->ref_id}}" style="display:inline-block;" class="btn btn-success" onclick="mainmenuedit{{$subnev->ref_id}}(this)">Edit</button>
                                        <button type="button" id="mainmenueditclosebtn{{$subnev->ref_id}}" style="display:none;" class="btn btn-primary" onclick="mainmenuclose{{$subnev->ref_id}}(this)">Close</button>
                                    </td>
                                   
                                    </tr>  
                                    
                                    <tr id="mainmenueditshow{{$subnev->ref_id}}"  style="display:none;">
                                        <form method="POST" action="{{ route('admin.sub.nev.edit') }}">
                                        @csrf
                                            <td>
                                                <div class="form-group">
                                                    <label for=""> Edit Name</label><input class="form-control" value="{{$subnev->name}}" name="name" type="text" required>
                                                    <input class="form-control" value="{{$subnev->ref_id}}" name="subnevid" type="hidden" required>
                                                </div>                                            
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for=""> Edit Link</label><input class="form-control" value="{{$subnev->link}}" name="link" type="text" required>
                                                </div>                                                                                            
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="submit"> Save</button>                                            
                                            </td>
                                        </form>
                                    </tr>

                                    <script>
                                    const mainmenuedit{{$subnev->ref_id}} = (element) => {  
                                        document.getElementById('mainmenueditshowbtn{{$subnev->ref_id}}').style.display = "none";                                                                                        
                                        document.getElementById('mainmenueditshow{{$subnev->ref_id}}').style.display = "inline-block";
                                        document.getElementById('mainmenueditclosebtn{{$subnev->ref_id}}').style.display = "inline-block";
                                        
                                    }

                                    const mainmenuclose{{$subnev->ref_id}} = (element) => {                                                                                                                                    
                                        document.getElementById('mainmenueditshow{{$subnev->ref_id}}').style.display = "none";
                                        document.getElementById('mainmenueditclosebtn{{$subnev->ref_id}}').style.display = "none";
                                        document.getElementById('mainmenueditshowbtn{{$subnev->ref_id}}').style.display = "inline-block";
                                        
                                    }
                                    </script>
                                    </tr>
                                    </a>
                                    @else
                                    @endif
                                    @endforeach

                                    @endforeach
                                                    
                                    
                                </tbody>
                                </table>
                            </div>
                        </div>
            </div>
        </div>


        <div class="col-6">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Footer Navigation
                </h6>

                <div style="padding-bottom: 20px;">
                    <button class="btn btn-success" data-target=".footermainmenu" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add Main Menu</span></button>
                    <button class="btn btn-primary" data-target=".footersubmenu" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add Sub Menu</span></button> 
                </div>

                        <!-- Footer Main Menu Model -->
                        <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade footermainmenu" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                    Add Main Manu
                                    </h5>                                    
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                </div>                                
                                <div class="modal-body">
                                <p>The Menu added on Footer Section as a Main Menu</p>
                                    <form method="POST" action="{{ route('admin.footer.main.nev.add') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for=""> Name</label><input class="form-control" name="name" type="text" required>
                                    </div>  
                                    <div class="form-group">
                                        <label for=""> Link</label><input class="form-control" name="link" type="text" required>
                                    </div>  
                                    <div class="form-group">
                                        <label for=""> Place Line</label><input class="form-control" name="place_id" type="number" required>
                                    </div>                              
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Add Now</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Footer Main Menu Model -->


                        <!-- Footer sub Menu Model -->
                        <div aria-hidden="true" aria-labelledby="mySmallModalLabel" class="modal fade footersubmenu" role="dialog" tabindex="-1">
                            <div class="modal-dialog modal-sm">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">
                                    Add Sub Manu
                                    </h5>                                    
                                    <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                </div>                                
                                <div class="modal-body">
                                <p>The Menu added on Footer Section as a sub Menu under the your prefered main Menu</p>
                                    <form method="POST" action="{{ route('admin.footer.sub.nev.add') }}">
                                    @csrf
                                    <div class="form-group">
                                        <select class="form-control" name="main_menu_id">
                                
                                            @foreach($footermain as $val)
                                            <option value="{{$val->id}}">
                                            {{$val->name}}
                                            </option>                                            
                                            @endforeach
                                        
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Name</label><input class="form-control" name="name" type="text" required>
                                    </div> 
                                    <div class="form-group">
                                        <label for=""> Link</label><input class="form-control" name="link" type="text" required>
                                    </div>                                                                     
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Add Now</button>
                                </div>
                                </form>
                                </div>
                            </div>
                        </div>
                        <!-- Footer sub Menu Model -->


                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                <thead>
                                    <tr>
                                    <th class="text-left">
                                        Name
                                    </th>
                                    <th class="text-right">
                                        Action
                                    </th>
                                    
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($footermain as $mainnev)
                                    <a href="#">
                                    <tr>
                                    <td class="text-left">
                                        {{$mainnev->name}}
                                    </td>
                                    
                                    <td class="text-right">                                        
                                        <a class="btn btn-danger" href="/admin/ui/navigation/footer/main/delete/{{$mainnev->id}}">Delete</a>
                                        <button type="button" id="mainmenueditshowbtn{{$mainnev->ref_id}}" style="display:inline-block;" class="btn btn-success" onclick="mainmenuedit{{$mainnev->ref_id}}(this)">Edit</button>
                                        <button type="button" id="mainmenueditclosebtn{{$mainnev->ref_id}}" style="display:none;" class="btn btn-primary" onclick="mainmenuclose{{$mainnev->ref_id}}(this)">Close</button>
                                    </td>
                                   
                                    </tr>  
                                    
                                    <tr id="mainmenueditshow{{$mainnev->ref_id}}"  style="display:none;">
                                        <form method="POST" action="{{ route('admin.ftr.main.nev.edit') }}">
                                        @csrf
                                            <td>
                                                <div class="form-group">
                                                    <label for=""> Edit Name</label><input class="form-control" value="{{$mainnev->name}}" name="name" type="text" required>
                                                    <input class="form-control" value="{{$mainnev->ref_id}}" name="mainnevid" type="hidden" required>
                                                </div>                                            
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for=""> Edit Link</label><input class="form-control" value="{{$mainnev->link}}" name="link" type="text" required>
                                                </div> 
                                                <div class="form-group">
                                                    <label for=""> Edit Place</label><input class="form-control" value="{{$mainnev->place_id}}" name="place_id" type="number" required>
                                                </div>                                           
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="submit"> Save</button>                                            
                                            </td>
                                        </form>
                                    </tr>

                                    <script>
                                    const mainmenuedit{{$mainnev->ref_id}} = (element) => {  
                                        document.getElementById('mainmenueditshowbtn{{$mainnev->ref_id}}').style.display = "none";                                                                                        
                                        document.getElementById('mainmenueditshow{{$mainnev->ref_id}}').style.display = "inline-block";
                                        document.getElementById('mainmenueditclosebtn{{$mainnev->ref_id}}').style.display = "inline-block";
                                        
                                    }

                                    const mainmenuclose{{$mainnev->ref_id}} = (element) => {                                                                                                                                    
                                        document.getElementById('mainmenueditshow{{$mainnev->ref_id}}').style.display = "none";
                                        document.getElementById('mainmenueditclosebtn{{$mainnev->ref_id}}').style.display = "none";
                                        document.getElementById('mainmenueditshowbtn{{$mainnev->ref_id}}').style.display = "inline-block";
                                        
                                    }
                                    </script>
                                    </a>                                    

                                    
                                    @foreach($footersub as $subnev)

                                    @if($mainnev->id == $subnev->main_menu_id)
                                    <a href="#">
                                    <tr>
                                    <td class="text-left">
                                        <div style="padding-left: 30px;"><i class="os-icon os-icon-arrow-right3" style="color: #047bf8;"></i> {{$subnev->name}} </div>
                                    </td>
                                    
                                    
                                    <td class="text-right">                                        
                                        <a class="btn btn-danger" href="/admin/ui/navigation/footer/sub/delete/{{$subnev->id}}">Delete</a>
                                        <button type="button" id="mainmenueditshowbtn{{$subnev->ref_id}}" style="display:inline-block;" class="btn btn-success" onclick="mainmenuedit{{$subnev->ref_id}}(this)">Edit</button>
                                        <button type="button" id="mainmenueditclosebtn{{$subnev->ref_id}}" style="display:none;" class="btn btn-primary" onclick="mainmenuclose{{$subnev->ref_id}}(this)">Close</button>
                                    </td>
                                   
                                    </tr>  
                                    
                                    <tr id="mainmenueditshow{{$subnev->ref_id}}"  style="display:none;">
                                        <form method="POST" action="{{ route('admin.ftr.sub.nev.edit') }}">
                                        @csrf
                                            <td>
                                                <div class="form-group">
                                                    <label for=""> Edit Name</label><input class="form-control" value="{{$subnev->name}}" name="name" type="text" required>
                                                    <input class="form-control" value="{{$subnev->ref_id}}" name="subnevid" type="hidden" required>
                                                </div>                                            
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <label for=""> Edit Link</label><input class="form-control" value="{{$subnev->link}}" name="link" type="text" required>
                                                </div>                                                                                            
                                            </td>
                                            <td>
                                                <button class="btn btn-primary" type="submit"> Save</button>                                            
                                            </td>
                                        </form>                                       
                                    </tr>                                    

                                    <script>
                                    const mainmenuedit{{$subnev->ref_id}} = (element) => {  
                                        document.getElementById('mainmenueditshowbtn{{$subnev->ref_id}}').style.display = "none";                                                                                        
                                        document.getElementById('mainmenueditshow{{$subnev->ref_id}}').style.display = "block";
                                        document.getElementById('mainmenueditclosebtn{{$subnev->ref_id}}').style.display = "inline-block";
                                        
                                    }

                                    const mainmenuclose{{$subnev->ref_id}} = (element) => {                                                                                                                                    
                                        document.getElementById('mainmenueditshow{{$subnev->ref_id}}').style.display = "none";
                                        document.getElementById('mainmenueditclosebtn{{$subnev->ref_id}}').style.display = "none";
                                        document.getElementById('mainmenueditshowbtn{{$subnev->ref_id}}').style.display = "inline-block";
                                        
                                    }
                                    </script>
                                    </tr>
                                    </a>
                                    @else
                                    @endif
                                    @endforeach

                                    @endforeach
                                                    
                                    
                                </tbody>
                                </table>
                            </div>
                        </div>
            </div>
        </div>

        <div class="col-8">
            
        </div>

    </div>
</div>

@endsection