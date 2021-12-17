@extends('layouts.dashboard')
@section('content')

<div class="content-box">

    <div class="row">

        <div class="col-lg-12">
            <div class="element-wrapper">
                <h6 class="element-header">
                All Ads - Add or Edit
                </h6>
                <div style="padding-bottom: 20px;">
                    <button class="btn btn-primary" data-target=".adnewads" data-toggle="modal" type="button"><i class="os-icon os-icon-plus-circle"></i><span>Add New</span></button> 
                </div>

                <!-- Add New Ads Model -->
                <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade adnewads" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            Add New Ads
                            </h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('admin.ui.ads.new') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for=""> Hilight Text</label><input class="form-control" name="hilight_text" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for=""> Headline</label><input class="form-control" name="headline" type="text" required>
                            </div>
                            <div class="form-group">
                                <label for=""> Body Text</label><textarea class="form-control" name="body_text" type="text" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for=""> Button Link</label><input class="form-control" name="button_link" type="text" required>
                            </div> 
                            <div class="form-group">
                                <label for=""> Add Image</label><input class="form-control" name="addimage" type="file" required>
                            </div>  
                            <div class="form-group">
                                <label for=""> Background Image</label><input class="form-control" name="backgroundimage" type="file" required>
                            </div>
                            <div class="form-group">
                                <label class="col-form-label col-sm-4" for=""> Background Colors</label>
                                <select class="form-control" name="addtheme">

                                    <option selected="true" value="dark">
                                    Dark
                                    </option>
                                    <option value="light">
                                    Light
                                    </option>

                                </select>
                            </div>                                
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Add Now</button>
                        </div>
                        </form>
                        </div>
                    </div>
                </div>
                <!-- Add New Ads Model -->

                    <div class="row">

                        @foreach($ads as $siteads)
                        <div class="col-lg-4">
                            <div class="">                            
                                
                                <div class="col-sm-12 d-lg-block">
                                <div class="cta-w cta-with-media" style="background-image: url('/images/ads/{{$siteads->background_image}}');">
                                    <div class="cta-content">
                                    <div class="highlight-header">
                                        {{$siteads->hilight_text}}
                                    </div>
                                    <h3 class="cta-header">
                                        {!! $siteads->headline !!}
                                    </h3>
                                    <p style="line-height: 1.4;">
                                        {!! $siteads->body_text !!}
                                    </p><br>
                                        <a class="btn btn-primary" href="{{$siteads->button_link}}">Click Here</a>
                                    </div>
                                    <div class="cta-media">
                                    <img alt="" src="/images/ads/{{$siteads->ad_image}}">
                                    </div>
                                </div>
                                </div>                                

                            </div>

                            <div style="padding: 40px; text-align: center;">
                                <button class="btn btn-primary" data-target=".adnewads{{$siteads->id}}" data-toggle="modal" type="button"><span>Edit</span></button> 
                                <a class="btn btn-danger" href="/admin/ui/ads/delete/{{$siteads->id}}"><span>Delete</span></a>
                            </div>

                            <!-- Edit Ads Model -->
                            <div aria-hidden="true" aria-labelledby="myLargeModalLabel" class="modal fade adnewads{{$siteads->id}}" role="dialog" tabindex="-1">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                        Edit Ads ({{$siteads->hilight_text}})
                                        </h5>
                                        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('admin.ui.ads.edit') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for=""> Hilight Text</label><input class="form-control" value="{{$siteads->hilight_text}}" name="hilight_text" type="text" required>
                                            <input class="form-control" value="{{$siteads->id}}" name="adsid" type="hidden">
                                        </div>
                                        <div class="form-group">
                                            <label for=""> Headline</label><input class="form-control" value="{{htmlspecialchars(trim(strip_tags($siteads->headline)))}}" name="headline" type="text" required>
                                        </div>
                                        <div class="form-group">
                                            <label for=""> Body Text</label><textarea class="form-control" name="body_text" type="text" required>{{htmlspecialchars(trim(strip_tags($siteads->body_text)))}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for=""> Button Link</label><input class="form-control" value="{{$siteads->button_link}}" name="button_link" type="text" required>
                                        </div> 
                                        <div class="form-group">
                                            <label for=""> Add Image</label><input class="form-control" name="addimage" type="file" required>
                                        </div>  
                                        <div class="form-group">
                                            <label for=""> Background Image</label><input class="form-control" name="backgroundimage" type="file" required>
                                        </div> 
                                        <div class="form-group">
                                            <label class="col-form-label col-sm-4" for=""> Background Colors</label>
                                            <select class="form-control" name="addtheme">

                                                <option selected="true" value="dark">
                                                Dark
                                                </option>
                                                <option value="light">
                                                Light
                                                </option>

                                            </select>
                                        </div>                               
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-dismiss="modal" type="button"> Close</button><button class="btn btn-primary" type="submit"> Save</button>
                                    </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Ads Model -->

                        </div>                        
                        @endforeach

                    </div>
            </div>
        </div>        

    </div>



</div>

@endsection