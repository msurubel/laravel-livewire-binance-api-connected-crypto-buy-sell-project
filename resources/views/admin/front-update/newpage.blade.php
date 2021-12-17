@extends('layouts.dashboard')
@section('content')

<div class="content-box">

    <div class="row">

        <div class="col-lg-8">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Main Section of New {{ app('request')->input('type') }}
                </h6>
                <div class="element-box">
                    <form method="POST" action="{{ route('page.page.add') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for=""> Heading</label><input class="form-control" name="page_h" value="@if(app('request')->input('type') == 'Blog') @if(app('request')->input('action') == 'Edit') {{$blog->blog_tittle}} @else @endif @else @if(app('request')->input('action') == 'Edit') {{$page->page_tittle}} @else @endif @endif" type="text" requred>
                        <input class="form-control" value="{{ app('request')->input('type') }}" name="pagetype" type="hidden">
                        <input class="form-control" value="{{ app('request')->input('action') }}" name="pageaction" type="hidden">
                        @if(app('request')->input('action') == 'Edit')
                            <input class="form-control" value="
                            @if(app('request')->input('type') == 'Blog')
                            @if(app('request')->input('action') == 'Edit')
                            {{$blog->blog_link}}
                            @else
                            @endif
                            @else
                            @if(app('request')->input('action') == 'Edit')
                            {{$page->page_link}}
                            @else
                            @endif
                            @endif" name="bloglink" type="hidden">
                        @else
                        @endif
                    </div>

                    
                    <div class="form-group">
                        <label for=""> Short Description <span style="color: red; font-size: 10px;">(Maximum: 117 Cher.)</span></label><input class="form-control" name="page_short" value="@if(app('request')->input('type') == 'Blog') @if(app('request')->input('action') == 'Edit') {{$blog->blog_short}} @else @endif @else @if(app('request')->input('action') == 'Edit') {{$page->page_short}} @else @endif @endif" maxlength="117" type="text" requred>
                    </div>

                    @if(app('request')->input('type') == 'Page')
                    <div class="form-group">
                        <label for=""> Link Words <span style="color: red; font-size: 10px;">(Maximum: 117 Cher. And don't use white space, you can use "-")</span></label><input class="form-control" name="pagelink" value="@if(app('request')->input('type') == 'Blog')@if(app('request')->input('action') == 'Edit'){{$blog->blog_link}}@else @endif @else @if(app('request')->input('action') == 'Edit'){{$page->page_link}}@else @endif @endif" maxlength="117" type="text" requred>
                    </div>
                    @else
                    @endif

                    @if(app('request')->input('action') == 'Edit')
                    <div class="form-group">
                    <label for=""> Link: <a href="@if(app('request')->input('type') == 'Blog') @if(app('request')->input('action') == 'Edit') {{ url ('/')}}/blogs/{{$blog->blog_link}} @else @endif @else @if(app('request')->input('action') == 'Edit') {{ url ('/')}}/page/{{$page->page_link}} @else @endif @endif" target="_blank">@if(app('request')->input('type') == 'Blog') @if(app('request')->input('action') == 'Edit') {{ url ('/')}}/blogs/{{$blog->blog_link}} @else @endif @else @if(app('request')->input('action') == 'Edit') {{ url ('/')}}/page/{{$page->page_link}} @else @endif @endif</a></label>
                    </div>
                    @else
                    @endif

                    <hr>

                    <div class="form-group">
                        <label for=""> Body Text</label>
                        <textarea cols="80" id="ckeditor1" name="page_p" rows="10">
                        @if(app('request')->input('type') == 'Blog') @if(app('request')->input('action') == 'Edit') {!!$blog->blog_body!!} @else @endif @else @if(app('request')->input('action') == 'Edit') {!!$page->page_body!!} @else @endif @endif
                        </textarea>
                    </div>                   
                    
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="row">

                <div class="col-12">
                    <div class="element-wrapper">
                            <h6 class="element-header">
                                Others Section of New {{ app('request')->input('type') }}
                            </h6>
                        <div class="element-box">
                            
                            <button type="submit" onclick="NewPage(this)" class="btn btn-success">Save {{ app('request')->input('action') }} {{ app('request')->input('type') }}</button>
                            <div id="NewPagePro"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                            <script>
                            const NewPage = (element) => {
                                element.hidden = true;                                                    
                                document.getElementById('NewPagePro').style.display = "block";
                                document.getElementById('BacktoListbut').style.display = "none";                                
                            }
                            </script>
                            
                            <div id="BacktoListbut" style="display:inline-block;">
                                @if(app('request')->input('type') == 'Blog')
                                <a type="Button" href="/admin/blogs" class="@if(app('request')->input('action') == 'Edit')btn btn-primary @else btn btn-danger @endif">@if(app('request')->input('action') == 'Edit') Back To List @else Leave Now @endif</a>
                                @else
                                <a type="Button" href="/admin/pages" class="@if(app('request')->input('action') == 'Edit')btn btn-primary @else btn btn-danger @endif">@if(app('request')->input('action') == 'Edit') Back To List @else Leave Now @endif</a>
                                @endif
                            </div>
                            
                        </div>        
                    </div>
                </div>

                <div class="col-12">
                    <div class="element-wrapper">
                        <div class="element-box">

                            @if(app('request')->input('type') == 'Blog')
                                @if(app('request')->input('action') == 'Edit')
                                <div class="form-group">
                                <label for=""> Categorie</label>
                                <input class="form-control" value="@if(app('request')->input('action') == 'Edit') {{$categories->name}} @else @endif" name="catagoriesname" type="text" readonly>
                                <input class="form-control" value="{{$categories->id}}" name="catagories" type="hidden">
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label col-sm-4" for=""> Publish or Not</label>
                                    <select class="form-control" name="blog_status">
                                        
                                    @if($blog->status == 1)
                                        <option selected="true" value="1">
                                        Publish
                                        </option>
                                        <option value="2">
                                        Unpublish
                                        </option>
                                    @else
                                        <option value="1">
                                        Publish
                                        </option>
                                        <option selected="true" value="2">
                                        Unpublish
                                        </option>
                                    @endif
                                    
                                    </select>
                                </div>
                                @else
                                <div class="form-group">
                                    <label class="col-form-label col-sm-4" for=""> Publish or Not</label>
                                    <select class="form-control" name="blog_status">
                                        
                                        <option value="1">
                                        Publish
                                        </option>
                                        <option value="2">
                                        Unpublish
                                        </option>
                                    
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label col-sm-4" for=""> Catagories</label>
                                    <select class="form-control" name="catagories">
                                        @foreach($catagories as $val)
                                        <option value="{{$val->id}}">
                                        {{$val->name}}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>                            
                                @endif

                            @else
                                @if(app('request')->input('action') == 'Edit')
                                    <div class="form-group">
                                    <label for=""> Categorie</label>
                                    <input class="form-control" value="@if(app('request')->input('action') == 'Edit') {{$categories->name}} @else @endif" name="catagoriesname" type="text" readonly>
                                    <input class="form-control" value="{{$categories->id}}" name="catagories" type="hidden">
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label col-sm-4" for=""> Publish or Not</label>
                                        <select class="form-control" name="blog_status">
                                            
                                        @if($page->status == 1)
                                            <option selected="true" value="1">
                                            Publish
                                            </option>
                                            <option value="2">
                                            Unpublish
                                            </option>
                                        @else
                                            <option value="1">
                                            Publish
                                            </option>
                                            <option selected="true" value="2">
                                            Unpublish
                                            </option>
                                        @endif
                                        
                                        </select>
                                    </div>
                                    @else
                                    <div class="form-group">
                                        <label class="col-form-label col-sm-4" for=""> Publish or Not</label>
                                        <select class="form-control" name="blog_status">
                                            
                                            <option value="1">
                                            Publish
                                            </option>
                                            <option value="2">
                                            Unpublish
                                            </option>
                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label col-sm-4" for=""> Catagories</label>
                                        <select class="form-control" name="catagories">
                                            @foreach($catagories as $val)
                                            <option value="{{$val->id}}">
                                            {{$val->name}}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>                            
                                    @endif

                                @endif

                            <div class="form-group">
                                <label for=""> Blog Image</label><input class="form-control" value="" name="image" type="file">
                            </div>                           
                            @if(app('request')->input('action') == 'Edit')                     
                            <br><br>
                                @if(app('request')->input('type') == 'Blog')
                                <img class="img-fluid" src="/images/blog/{{$blog->image}}" alt="">
                                @else
                                <img class="img-fluid" src="/images/page/{{$page->image}}" alt="">
                                @endif
                            <br><br>
                            @else
                            @endif


                        </div>        
                    </div>
                </div>

            </div>
        </div>


        </form>
        
    </div>



</div>

@endsection