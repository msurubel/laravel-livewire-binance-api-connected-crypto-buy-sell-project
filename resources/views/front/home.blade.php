@extends('layouts.front')

@section('content')



<div class="intro">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xl-6 col-lg-6 col-12">
                        <div class="intro-content">
                            {!! $set->set1_h !!}
                            <p>{{$set->set1_p}}</p>
                        </div>

                        <div class="intro-btn">
                            <a href="{{$set->set1_b1_link}}" class="btn btn-primary">{{$set->set1_b1_text}}</a>
                            <a href="{{$set->set1_b2_link}}" class="btn btn-outline-primary">{{$set->set1_b2_text}}</a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-12">
                    {!! $set->set1_widget !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="price-grid section-padding">
            <div class="container">

                <div style="width: auto; height: 500px; overflow: hidden;">
                    <div class="row" id="frontendcryptoall">                  
                    
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="getstart section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="section-title">
                            {!! $set->set2_h !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="getstart-content">
                            <span>{!! $set->set2_cat1_icon !!}</span>
                            <h3>{{ $set->set2_cat1_text }}</h3>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="getstart-content">
                            <span>{!! $set->set2_cat2_icon !!}</span>
                            <h3>{{ $set->set2_cat2_text }}</h3>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                        <div class="getstart-content">
                            <span>{!! $set->set2_cat3_icon !!}</span>
                            <h3>{{ $set->set2_cat3_text }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="portfolio section-padding" data-scroll-index="2">
            <div class="container">
                <div class="row py-lg-5 justify-content-center">
                    <div class="col-xl-7">
                        <div class="section-title text-center">
                            {!! $set->set3_h !!}
                            {!! $set->set3_p !!}
                        </div>
                    </div>
                </div>
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-7 col-lg-6">
                        <div class="portfolio_list">
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="media">
                                        <span class="port-icon"> {!! $set->set3_cat1_icon !!}</span>
                                        <div class="media-body">                                            
                                            {!! $set->set3_cat1_h !!}
                                            {!! $set->set3_cat1_p !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="media">
                                        <span class="port-icon"> {!! $set->set3_cat2_icon !!}</span>
                                        <div class="media-body">
                                            {!! $set->set3_cat2_h !!}
                                            {!! $set->set3_cat2_p !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="media">
                                        <span class="port-icon"> {!! $set->set3_cat3_icon !!}</span>
                                        <div class="media-body">                                            
                                            {!! $set->set3_cat3_h !!}
                                            {!! $set->set3_cat3_p !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="media">
                                        <span class="port-icon"> {!! $set->set3_cat4_icon !!}</span>
                                        <div class="media-body">
                                            {!! $set->set3_cat4_h !!}
                                            {!! $set->set3_cat4_p !!}                                           
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6">
                        <div class="portfolio_img">
                            <img src="/img/frontend/{{ $set->set3_image }}" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="trade-app section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="section-title text-center">
                            {!! $set->set4_h !!}
                            {!! $set->set4_p !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="card trade-app-content">
                            <div class="card-body">
                                <span>{!! $set->set4_cat1_icon !!}</i></span>
                                {!! $set->set4_cat1_h !!}
                                {!! $set->set4_cat1_p !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="card trade-app-content">
                            <div class="card-body">
                                <span>{!! $set->set4_cat2_icon !!}</i></span>
                                {!! $set->set4_cat2_h !!}
                                {!! $set->set4_cat2_p !!}                           

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="card trade-app-content">
                            <div class="card-body">

                                <span>{!! $set->set4_cat3_icon !!}</i></span>
                                {!! $set->set4_cat3_h !!}
                                {!! $set->set4_cat3_p !!}
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row pt-5">
                    <div class="col-xl-12">
                        <div class="trusted-business py-5 text-center">
                            <h3>Trusted by Our <strong>Partners</strong></h3>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <div class="trusted-logo">
                                    <a href="#"><img class="img-fluid" width="500px" src="/images/Binance-Logo.wine.png" alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!--
        <div class="testimonial section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="section-title">
                            <h2>What our customer says</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="testimonial-content">
                            <div class="testimonial1 owl-carousel owl-theme">
                                <div class="row align-items-center">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="customer-img">
                                            <img class="img-fluid" src="images/testimonial/1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="customer-review">
                                            <img class="img-fluid" src="images/brand/2.webp" alt="">
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi voluptas
                                                dignissimos similique quas molestiae doloribus recusandae voluptatem et
                                                repudiandae veritatis.</p>
                                            <div class="customer-info">
                                                <h6>Mr John Doe</h6>
                                                <p>CEO, Example Company</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="customer-img">
                                            <img class="img-fluid" src="images/testimonial/2.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6">
                                        <div class="customer-review">
                                            <img class="img-fluid" src="images/brand/3.webp" alt="">
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nisi voluptas
                                                dignissimos similique quas molestiae doloribus recusandae voluptatem et
                                                repudiandae veritatis.</p>
                                            <div class="customer-info">
                                                <h6>Mr Abraham</h6>
                                                <p>CEO, Example Company</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        -->

        <div class="promo section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="section-title text-center">
                            <h2>The most trusted cryptocurrency platform</h2>
                            <p> Here are a few reasons why you should choose {{$set->name}}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center py-5">
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="promo-content">
                            <div class="promo-content-img">
                                <img class="img-fluid" src="images/svg/protect.svg" alt="">
                            </div>
                            <h3>Secure storage </h3>
                            <p>We store the vast majority of the digital assets in secure offline storage.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="promo-content">
                            <div class="promo-content-img">
                                <img class="img-fluid" src="images/svg/cyber.svg" alt="">
                            </div>
                            <h3>Protected by insurance</h3>
                            <p>Cryptocurrency stored on our servers is covered by our insurance policy.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4">
                        <div class="promo-content">
                            <div class="promo-content-img">
                                <img class="img-fluid" src="images/svg/finance.svg" alt="">
                            </div>
                            <h3>Industry best practices</h3>
                            <p>{{$set->name}} supports a variety of the most popular digital currencies.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="appss section-padding">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-7 col-lg-6 col-md-6">
                        <div class="appss-content">
                            <h2>The secure app to store crypto yourself</h2>
                            <ul>
                                <li><i class="la la-check"></i> All your digital assets in one place</li>
                                <li><i class="la la-check"></i> Use Decentralized Apps</li>
                                <li><i class="la la-check"></i> Pay friends, not addresses</li>
                            </ul>
                            <div class="mt-4">
                                <a href="#" class="btn btn-primary my-1 waves-effect">
                                    <img src="images/android.svg" alt="">
                                </a>
                                <a href="#" class="btn btn-primary my-1 waves-effect">
                                    <img src="images/apple.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-6 col-md-6">
                        <div class="appss-img">
                            <img class="img-fluid" src="images/app.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="blog section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="section-title text-center">
                            <h2>Blog</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach($blogs as $val)
                    <div class="col-xl-4 col-lg-4 col-md-12">
                        <div class="blog-grid">
                            <div class="card">
                                <img class="img-fluid" src="/images/blog/{{$val->image}}" alt="">
                                <div class="card-body">
                                    <a href="/blogs/{{$val->blog_link}}">
                                        <h4 class="card-title">{{$val->blog_tittle}}</h4>
                                    </a>
                                    <div style="">
                                    <p class="card-text">{!! $val->blog_short !!}</p>
                                    </div>                                    
                                </div>
                                <div class="card-footer">
                                    <div class="meta-info">
                                        <a href="#" class="author"> {{App\Models\User::findOrFail($val->user_id)->first()->name}}</a>
                                        <a href="#" class="post-date"><i class="la la-calendar"></i> {{ $val->created_at->format('d/m/Y') }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>


        <div class="get-touch section-padding">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6">
                        <div class="section-title">
                            <h2>Get in touch. Stay in touch.</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="get-touch-content">
                            <div class="media">
                                <span><i class="fa fa-shield"></i></span>
                                <div class="media-body">
                                    <h4>24 / 7 Support</h4>
                                    <p>Got a problem? Just get in touch. Our support team is available 24/7.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="get-touch-content">
                            <div class="media">
                                <span><i class="fa fa-cubes"></i></span>
                                <div class="media-body">
                                    <h4>{{$set->name}} Blog</h4>
                                    <p>News and updates from the world’s leading cryptocurrency exchange.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="get-touch-content">
                            <div class="media">
                                <span><i class="fa fa-certificate"></i></span>
                                <div class="media-body">
                                    <h4>Careers</h4>
                                    <p>Help build the future of technology. Start your new career at {{$set->name}}.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="get-touch-content">
                            <div class="media">
                                <span><i class="fa fa-life-ring"></i></span>
                                <div class="media-body">
                                    <h4>Community</h4>
                                    <p>{{$set->name}} is global. Join the discussion in our worldwide communities.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        


@endsection