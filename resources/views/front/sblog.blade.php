@extends('layouts.front')

@section('content')


<style>
    img{
        max-width: 100%;
        max-height: 100%;
        display: block; /* remove extra space below image */
    }
    .add-box{
        width: 200px;
    }    
    .add-box.large{
        height: 300px;
    }
    .add-box.small{
        height: 100px;
    }
</style>


<div class="blog section-padding border-0">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="blog-single-post single">
                            <ul class="post-nfo">
                                <li><i class="la la-calendar"></i>{{ $blogs->created_at->format('d/m/Y') }}</li>
                                <li><i class="la la-comment-o"></i><a href="#" title="">{{$totalcomments}} Comments</a></li>
                                <li><i class="la la-user-o"></i><a href="#" title="">{{App\Models\User::findOrFail($blogs->user_id)->first()->name}}</a></li>
                            </ul>
                            <h3>Real Estate near ocean</h3>
                            <div class="blog-img">
                                <img src="/images/blog/{{$blogs->image}}" alt="{{$blogs->blog_tittle}}" class="img-fluid">
                            </div>
                            <!--blog-img end-->
                            {!! $blogs->blog_body !!}
                            <div class="post-share">
                                <ul class="social-links">
                                    <li><a href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u={{ url ('/') }}/blogs/{{$blogs->blog_link}}&display=popup&ref=plugin&src=share_button" target="_blank" title=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#" title=""><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#" title=""><i class="fa fa-instagram"></i></a></li>
                                    <li><a href="#" title=""><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                                <a href="#comment-sec" title="">Write A Comment <i class="la la-arrow-right"></i></a>
                            </div>
                            <!--post-share end-->
                            
                            <!--cm-info-sec end-->
                        </div>
                        <!--blog-single-post end-->
                        <div class="comment-section">
                            <h3 class="p-title">Comments</h3>
                            <ul>

                            @foreach($comments as $val)
                                <li>
                                    <div class="cm-info-sec">                                        
                                        <!--author-img end-->
                                        <div class="cm-info">
                                            <h3>{{$val->name}}</h3>
                                            <h4>{{ $val->date }}</h4>
                                        </div>
                                    </div>
                                    <!--cm-info-sec end-->
                                    <p>{{$val->comment}} </p>
                                    <!--<a href="#" title="" class="cm-reply">Reply</a>-->
                                </li>
                            @endforeach
                                
                            </ul>
                        </div>
                        <!--comment-section end-->
                        <div class="post-comment-sec" id="comment-sec">
                            <h3 class="p-title">Leave a reply</h3>
                            <form method="POST" action="{{ route('blog.comments.add') }}" class="js-ajax-form" novalidate="novalidate">
                            @csrf
                                <div class="form-fieldss">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 pl-0">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="name"
                                                    placeholder="Your Name" id="name">
                                                    <input class="form-control" type="hidden" value="{{$blogs->blog_link}}" name="blog_link">
                                            </div>
                                            <!-- form-field end-->
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="form-group">
                                                <input class="form-control" type="email" name="email"
                                                    placeholder="Your Email" id="email">
                                            </div>
                                            <!-- form-field end-->
                                        </div>
                                        <div class="col-lg-4 col-md-4 pr-0">
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="phone"
                                                    placeholder="Your Phone">
                                            </div>
                                            <!-- form-field end-->
                                        </div>
                                        <div class="col-lg-12 col-md-12 pl-0 pr-0">
                                            <div class="form-group">
                                                <textarea class="form-control" name="message"
                                                    placeholder="Your Message"></textarea>
                                            </div>
                                            <!-- form-field end-->
                                        </div>
                                        <p><span style="color: green;"><strong>{{ app('request')->input('success') }}</strong></span></p>
                                        <div class="col-lg-12 col-md-12 pl-0">
                                            <button type="submit" class="btn btn-primary submit">Send Message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--post-comment-sec end-->
                    </div>
                    <div class="col-xl-3">
                        <div class="blog-sidebar">
                            <!--
                            <div class="widget-search">                                
                                <form action="#">
                                    <input type="text" class="form-control" placeholder="Subscribe Now">
                                    <span><i class="la la-search"></i></span>
                                </form>
                            </div>
                            -->
                            <div class="widget-recent-post">
                                <h3 class="post-title">Recent Post</h3>
                                <ul class="list-unstyled">

                                    @foreach($bloglist as $blog)
                                    <li class="media">
                                        <img src="/images/blog/{{$blog->image}}" class="mr-3" alt="...">
                                        <div class="media-body">
                                            <h5 class="mt-0 mb-1">{{$blog->blog_tittle}}</h5>
                                            <div class="meta-info">
                                                <a href="#"><i class="la la-user"></i> Admin</a>
                                                <a href="#"><i class="la la-calendar"></i> {{ $blog->created_at->format('d/m/Y') }}</a>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach

                                    
                                </ul>
                            </div> 
                                                       

                            
                            <div class="widget-category" style="padding: 5px;">

                                <div class="row">

                                    @foreach($ads as $siteads)
                                    <div style="padding: 5px;">
                                        <div class="col-lg-12" style="background-image: url('/images/ads/{{$siteads->background_image}}');">

                                            <div class="card-body">

                                                <div class="row">

                                                    <div class="col-lg-12" style="padding-bottom: 30px">
                                                        <div class="add-box">
                                                            <img alt="" src="/images/ads/{{$siteads->ad_image}}">
                                                        </div>
                                                    </div>

                                                    <br><br>
                                        
                                                    <div class="col-lg-12">
                                                        <div class="badge badge-success">
                                                            {{$siteads->hilight_text}}
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <h3 class="cta-header">
                                                            {!! $siteads->headline !!}
                                                        </h3>
                                                    </div>

                                                    <br><br>

                                                    <div class="col-lg-12" style="line-height: 1.4;">
                                                        <p>
                                                            {!! $siteads->body_text !!}
                                                        </p>
                                                    </div>

                                                    <br><br><br>
                                                    
                                                    <div class="col-lg-12">
                                                        <a class="btn btn-primary" href="{{$siteads->button_link}}">Click Here</a>
                                                    </div>  
                                                    
                                                    <br><br><br>                                                

                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                    @endforeach

                                </div>
                                
                            </div>

                            <!--
                            <div class="widget-tag">
                                <h3 class="widget-title">Tags</h3>
                                <div class="tag-group">
                                    <a href="#">Tradix</a>
                                    <a href="#">Tradix</a>
                                    <a href="#">Tradix</a>
                                    <a href="#">Tradix</a>
                                    <a href="#">Tradix</a>
                                </div>
                            </div>
                                -->

                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        @endsection