<!DOCTYPE html>
<html lang="en">


<!-- bCrypto Pro Crypto Trading Platform | Develop By: MSU Rubel -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$tittle}}</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/img/settings/{{$set->site_favicon}}">
    <link rel="stylesheet" href="public/vendor/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="public/vendor/owl-carousel/css/owl.theme.default.css">
    <link rel="stylesheet" href="public/vendor/owl-carousel/css/owl.carousel.min.css">  
    

    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/css/style.css">
</head>

<body class="">

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="header">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="navigation">
                            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                <a class="navbar-brand" href="/"><img src="/img/settings/{{$set->image_logo}}" alt=""></a>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                                    <ul class="navbar-nav">
                                                  
                                        @foreach($headermain as $nevmain)
                                        <li class="nav-item dropdown">
                                            <a class="nav-link @if (count(App\Models\hdnevsub::wheremain_menu_id($nevmain->id)->get()) == 0) @else dropdown-toggle @endif" href="{{$nevmain->link}}" data-toggle="dropdown">{{$nevmain->name}}
                                            </a>

                                            @foreach($headersub as $nevsub)
                                            @if($nevmain->id == $nevsub->main_menu_id)
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{$nevsub->link}}">{{$nevsub->name}}</a>
                                            </div>
                                            @else
                                            @endif
                                            @endforeach

                                        </li>  
                                        @endforeach                                      

                                    </ul>
                                </div>
                                
                                <div class="signin-btn">
                                    @auth
                                    <a class="btn btn-success" href="/dashboard">Dashboard</a>
                                    @else
                                    <a class="btn btn-primary" href="/login">Sign in</a>
                                    @endauth
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')


        <div class="bottom section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="bottom-logo">
                            <img class="pb-3" src="/img/settings/{{$set->image_logow}}" width="200px" alt="">

                            <p style="line-height: 1.4;">{{ $set->site_short_d }}</p>
                        </div>
                    </div>

                    @foreach($footermain as $ftrmain)
                    <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                        <div class="bottom-widget">
                            <h4 class="widget-title">{{$ftrmain->name}}</h4>
                            <ul>
                                @foreach($footersub as $ftrsub)
                                @if($ftrmain->id == $ftrsub->main_menu_id)
                                <li><a href="{{$ftrsub->link}}">{{$ftrsub->name}}</a></li>
                                @else
                                @endif                                
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="copyright">
                            <p>© Copyright 2021 <a href="#">{{$set->name}}</a> I All Rights Reserved</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="footer-social">
                            <ul>
                                <li><a href="{{ $set->facebook_link }}"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="{{ $set->twitter_link }}"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="{{ $set->linkedin_link }}"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="{{ $set->youtube_link }}"><i class="fa fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="public/js/global.js"></script>
    <script src="public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="public/vendor/owl-carousel/js/owl.carousel.min.js"></script>
    <script src="public/js/plugins/owl-carousel-init.js"></script>

    <script src="public/vendor/apexchart/apexcharts.min.js"></script>
    <script src="public/vendor/apexchart/apexchart-init.js"></script>
    <script src="https://kit.fontawesome.com/efc9024db4.js" crossorigin="anonymous"></script>
    <script src="public/js/scripts.js"></script>

    {!! $set->chat_script !!}

    <script>
            setInterval(tradestimefront, 5000);
            function tradestimefront(){
            fetch("https://api.binance.com/api/v3/ticker/price").then(
            res=>{
            res.json().then(
            data=>{
            console.log(data);
            if(data.length > 0){
            var temp = "";

            //---- Start for loop
            data.forEach((ticker)=>{
            temp += "<div class='col-xl-3 col-lg-4 col-md-6 col-sm-6'>";
            temp += "<div class='card bg-success'>";
            temp += "<div class='card-header'>";
            temp += "<div class='media'>";
            temp += "<span><i class='cc substr('"+ticker.symbol+"', 0, -3)'></i></span>";
            temp += "<a href='/dashboard/trade/spot/"+ticker.symbol+"?symbol="+ticker.symbol+"'><div class='media-body' style='color: white;'><strong>"+ticker.symbol+"</strong></div></a>";
            temp += "</div>";
            temp += "<p class='mb-0' style='color: gray;'> Live</p>";
            temp += "</div>";
            temp += "<div class='card-body'>";
            temp += "<h3>"+ticker.price+"</h3><br>";
            temp += "</div>";
            temp += "</div>";
            temp += "</div>";
            
            })
            //---Close for loop
            document.getElementById("frontendcryptoall").innerHTML = temp;
            }
            }
            )}
            )}
        </script>
</body>


<!-- bCrypto Pro Crypto Trading Platform | Develop By: MSU Rubel -->
</html>