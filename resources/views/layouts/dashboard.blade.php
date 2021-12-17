<!DOCTYPE html>
<html>
  <head>
    <title>{{$tittle}}</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="bCrypto Pro Crypto Trading Platform" name="Develop By: MSU Rubel">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="public/img/settings/{{$set->site_favicon}}" rel="shortcut icon">
    <link href="public/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="public/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="public/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="public/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="public/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="public/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="public/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="public/css/main.css?version=4.4.0" rel="stylesheet">
    <link href="public/icons/cryptocoins/css/cryptocoins.css" rel="stylesheet">
    <link href="public/icons/cryptocoins/css/cryptocoins-colors.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.cryptofonts.com/1.3.0/cryptofont.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles

    <style>     
    .spinner-border{
      to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}
      @keyframes spinner-border{to{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}
      
      .spinner-border{
        display:inline-block;
        width:1rem;
        height:1rem;
        vertical-align:text-bottom;
        border:.15em solid currentColor;
        border-right-color:transparent;
        border-radius:50%;
        -webkit-animation:spinner-border .75s linear infinite;
        animation:spinner-border .75s linear infinite}
        
        .spinner-border-sm{
          width:1rem;
          height:1rem;
          border-width:.2em}
          
          @-webkit-keyframes spinner-grow{
            0%{-webkit-transform:scale(0);
              transform:scale(0)}50%{opacity:1}}@keyframes spinner-grow{0%{-webkit-transform:scale(0);transform:scale(0)}50%{opacity:1}}

      .closebtn {
      margin-left: 15px;
      color: white;      
      float: right;
      font-size: 20px;
      line-height: 20px;
      cursor: pointer;
      transition: 0.3s;
    }

    .closebtn:hover {
      color: black;
    }    
  </style>

    @if(auth()->user()->theme_set == 1)
    <style>
      ::-webkit-scrollbar {
      width: 5px; }

        /* Track */
      ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px grey;
        border-radius: 10px; }

      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: #999;
        border-radius: 10px; }

      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
        background: #777; }

        
      .buy-range{
          padding: 3px;
          text-align: center;
          font-size: 10px;        
          background-color: #e8e8e8;
      }
      .buy-range:hover {
          cursor: pointer;
          background-color: #bdbbbb;
      }
      .buy-range.active {        
          background-color: #bdbbbb;
      }
    </style>
    @else
    <style>
      ::-webkit-scrollbar {
      width: 5px; }

        /* Track */
      ::-webkit-scrollbar-track {
        box-shadow: inset 0 0 5px #434f6f;
        border-radius: 10px; }

      /* Handle */
      ::-webkit-scrollbar-thumb {
        background: #1d243a;
        border-radius: 10px; }

      /* Handle on hover */
      ::-webkit-scrollbar-thumb:hover {
        background: #111623; }

        .buy-range{
          padding: 3px;
          text-align: center;
          font-size: 10px;        
          background-color: #30384e;
      }
      .buy-range:hover {
          cursor: pointer;
          background-color: #21283a;
      }
      .buy-range.active {        
          background-color: #21283a;
      }
    </style>
    @endif

    
  
      
  </head>
  <body class="menu-position-side menu-side-left full-screen with-content-panel @if(auth()->user()->theme_set == 2) color-scheme-dark @else @endif">
    <div class="all-wrapper with-side-panel solid-bg-all" id="coinmethods">
    
      

      <div class="layout-w">
        <!--------------------
        START - Mobile Menu
        -------------------->
        <div class="menu-mobile menu-activated-on-click color-scheme-dark">
          <div class="mm-logo-buttons-w">
            <a class="mm-logo" href="/dashboard"><img src="/img/settings/{{$set->image_logo}}"><span>{{$set->name}}</span></a>
            <div class="mm-buttons">
              
              <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"></div>
              </div>
            </div>
          </div>
          <div class="menu-and-user">
            <div class="logged-user-w">
              <div class="avatar-w">
                <img alt="" src="/img/avatars/{{ auth()->user()->image }}">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                {{ auth()->user()->name }}
                </div>
                <div class="logged-user-role">
                  @if( auth()->user()->type == 1)
                  User
                  @else
                  Admin
                  @endif
                </div>
              </div>
            </div>
            <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">
              <li class="has-sub-menu">
                <a href="/dashboard">
                  <div class="icon-w">
                    <div class="os-icon os-icon-user"></div>
                  </div>
                  <span>General</span></a>
                <ul class="sub-menu">

                    <li>
                      <a href="/dashboard">Home</a>
                    </li>

                    <li>
                      <a href="/dashboard/profile">Profile</a>
                    </li>                  
                    
                    
                    <li>
                      <a href="/dashboard/account/main">Main Account</a>
                    </li>
                                    
                </ul>
              </li>


              <li class="has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="fab fa-bitcoin"></div>
                  </div>
                  <span>Crypto</span></a>
                <ul class="sub-menu">
                   
                    <li>
                      <a href="/dashboard/trade/spot/BTCUSDT?symbol=BTCUSDT">Trading Panel</a>
                    </li>
                   
                    <li>
                      <a href="/dashboard/cryptos/all">All Cryptos</a>
                    </li>   
                  
                    <li>
                      <a href="/dashboard/balances/cryptos">Crypto Wallets</a>
                    </li> 
                    
                    <li>
                      <a href="/dashboard/crypto/mining/cloud">Cloud Mining</a>
                    </li> 
                </ul>
              </li>


              <li class="has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="fas fa-search-dollar"></div>
                  </div>
                  <span>Earnings</span></a>
                <ul class="sub-menu">
                   
                    <li>
                      <a href="/dashboard/referral">Referral System</a>
                    </li>
                </ul>
              </li>

       
              

              @if( auth()->user()->type == 2)
              <li class="has-sub-menu">
                <a href="#">
                  <div class="icon-w">
                    <div class="os-icon os-icon-crown"></div>
                  </div>
                  <span>Admin Dashboard</span></a>
                <ul class="sub-menu">
                    <li>
                      <a href="/admin">Home</a>
                    </li>
                    <li>
                      <a href="/admin/users">All Users</a>
                    </li>
                    <li>
                      <a href="/admin/settings">Settings</a>
                    </li>
                    <li>
                      <a href="/admin/crypto/lists">Crypto Coins</a>
                    </li>
                    <li>
                      <a href="/admin/finance?active=depositrequest">Finance Area</a>
                    </li>                    
                    <li>
                      <a href="/admin/crypto/mining/devices?active=devicelists">Mining Devices</a>
                    </li>
                </ul>
              </li>


              <li class="has-sub-menu">
                <a href="layouts_menu_top_image.html">
                  <div class="icon-w">
                    <div class="os-icon os-icon-ui-55"></div>
                  </div>
                  <span>Admin Settings</span></a>
                <ul class="sub-menu">

                    <li>
                      <a href="/admin/ui/home">Home Page</a>
                    </li>
                    <li>
                      <a href="/admin/blogs">Blogs</a>
                    </li>
                    <li>
                      <a href="/admin/pages">Pages</a>
                    </li>
                    <li>
                      <a href="/admin/ui/navigation">Frontend Navigation Menu</a>
                    </li>
                    <li>
                      <a href="/admin/ui/ads">Advertising</a>
                    </li>

              </li>
              
              @elseif(auth()->user()->type == 3)
              <li class="has-sub-menu">
                <a href="layouts_menu_top_image.html">
                  <div class="icon-w">
                    <div class="os-icon os-icon-file-text"></div>
                  </div>
                  <span>Admin UI Update</span></a>
                <ul class="sub-menu">

                    <li>
                      <a href="/admin/ui/home">Home Page</a>
                    </li>
                    <li>
                      <a href="/admin/blogs">Blogs</a>
                    </li>
                    <li>
                      <a href="/admin/pages">Pages</a>
                    </li>
                    <li>
                      <a href="/admin/ui/navigation">Frontend Navigation Menu</a>
                    </li>
                    <li>
                      <a href="/admin/ui/ads">Advertising</a>
                    </li>

              </li>
              @endif
              
            </ul>
            <!--------------------
            END - Mobile Menu List
            -------------------->
            
          </div>
        </div>
        <!--------------------
        END - Mobile Menu
        --------------------><!--------------------
        START - Main Menu
        -------------------->
        @if(auth()->user()->theme_set == 1)
        <div class="menu-w menu-position-side menu-side-left menu-layout-mini sub-menu-style-over sub-menu-color-bright menu-activated-on-hover menu-has-selected-link color-style-transparent color-scheme-light selected-menu-color-light">
        @else
        <div class="menu-w menu-position-side menu-side-left menu-layout-mini sub-menu-style-over sub-menu-color-bright menu-activated-on-hover menu-has-selected-link color-scheme-dark color-style-transparent selected-menu-color-bright">
        @endif
          <div class="logo-w">
            <a class="logo" href="/dashboard">
                <div style="padding: 5.5px;"><img src="/img/settings/{{$set->site_favicon}}"></div>
              <div class="logo-label">
                {{$set->name}}
              </div>
            </a>
          </div>
          <div class="logged-user-w avatar-inline">
            <div class="logged-user-i">
              <div class="avatar-w">
              <img alt="" src="/img/avatars/{{ auth()->user()->image }}">
              </div>
              <div class="logged-user-info-w">
                <div class="logged-user-name">
                {{ auth()->user()->name }}
                </div>
                <div class="logged-user-role">
                  @if( auth()->user()->type == 1)
                  User
                  @else
                  Admin
                  @endif
                </div>
              </div>
              <div class="logged-user-toggler-arrow">
                <div class="os-icon os-icon-chevron-down"></div>
              </div>
              <div class="logged-user-menu color-style-bright">
                <div class="logged-user-avatar-info">
                  <div class="avatar-w">
                    <img alt="" src="/img/avatars/{{ auth()->user()->image }}">
                  </div>
                  <div class="logged-user-info-w">
                    <div class="logged-user-name">
                      {{ auth()->user()->name }}
                    </div>
                    <div class="logged-user-role">
                      @if( auth()->user()->type == 1)
                      User
                      @elseif( auth()->user()->type == 2)
                      Admin
                      @elseif( auth()->user()->type == 3)
                      Editor
                      @endif
                    </div>
                  </div>
                </div>
                <div class="bg-icon">
                  <i class="os-icon os-icon-wallet-loadingsed"></i>
                </div>
                <ul>                  
                  <li>
                    <a href="/dashboard/profile"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                  </li>                  
                  <li>
                  <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>

        

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        
          <ul class="main-menu">   
            
          
          @if(auth()->user()->type==2)
            <li class=" has-sub-menu">
              <a href="/admin">
                <div class="icon-w">
                  <div class="os-icon os-icon-crown"></div>
                </div>
                <span>Admin Dashboard</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Admin Dashboard
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-crown"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                    <li>
                      <a href="/admin">Home</a>
                    </li>
                    <li>
                      <a href="/admin/users">All Users</a>
                    </li>
                    <li>
                      <a href="/admin/settings">settings</a>
                    </li>
                    <li>
                      <a href="/admin/crypto/lists">Crypto Coins</a>
                    </li>
                    <li>
                      <a href="/admin/finance?active=depositrequest">Finance Area</a>
                    </li> 
                    <li>
                      <a href="/admin/crypto/mining/devices?active=devicelists">Mining Devices</a>
                    </li>                   
                  </ul>
                </div>
              </div>
            </li>
            
            <li class=" has-sub-menu">
              <a href="/admin">
                <div class="icon-w">
                  <div class="os-icon os-icon-ui-55"></div>
                </div>
                <span>Admin Settings</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Admin Settings
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-ui-55"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">

                    <li>
                      <a href="/admin/ui/home">Home Page</a>
                    </li>
                    <li>
                      <a href="/admin/blogs">Blogs</a>
                    </li>
                    <li>
                      <a href="/admin/pages">Pages</a>
                    </li>
                    <li>
                      <a href="/admin/ui/navigation">Frontend Navigation Menu</a>
                    </li>
                    <li>
                      <a href="/admin/ui/ads">Advertising</a>
                    </li>
                    
            
                  </ul>
                </div>
              </div>
            </li>  

            @elseif(auth()->user()->type==3)
            <li class=" has-sub-menu">
              <a href="/admin">
                <div class="icon-w">
                  <div class="os-icon os-icon-file-text"></div>
                </div>
                <span>Admin UI Update</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Admin UI Update
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-file-text"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">

                    <li>
                      <a href="/admin/ui/home">Home Page</a>
                    </li>
                    <li>
                      <a href="/admin/blogs">Blogs</a>
                    </li>
                    <li>
                      <a href="/admin/pages">Pages</a>
                    </li>
                    <li>
                      <a href="/admin/ui/navigation">Frontend Navigation Menu</a>
                    </li>
                    <li>
                      <a href="/admin/ui/ads">Advertising</a>
                    </li>
                    
            
                  </ul>
                </div>
              </div>
            </li>          
            @endif

            <li class="has-sub-menu selected">
              <a href="/dashboard">
                <div class="icon-w">
                  <div class="os-icon os-icon-user"></div>
                </div>
                <span>General</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  General
                </div>
                <div class="sub-menu-icon">
                  <i class="os-icon os-icon-user"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
                  <li>
                      <a href="/dashboard">Home</a>
                    </li>
                    <li>
                      <a href="/dashboard/profile">Profile</a>
                    </li>                   
                    
                     
                    <li>
                      <a href="/dashboard/account/main">Main Account</a>
                    </li> 
                                  
                  </ul>
                </div>
              </div>
            </li>

            <li class="selected has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="fab fa-bitcoin"></div>
                </div>
                <span>Crypto</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Crypto
                </div>
                <div class="sub-menu-icon">
                  <i class="fab fa-bitcoin"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
               
                    <li>
                      <a href="/dashboard/trade/spot/BTCUSDT?symbol=BTCUSDT">Trading Panel</a>
                    </li>
                    
                    <li>
                      <a href="/dashboard/cryptos/all">All Cryptos</a>
                    </li>   
                   
                    <li>
                      <a href="/dashboard/balances/cryptos">Crypto Wallets</a>
                    </li>  
                    
                    <li>
                      <a href="/dashboard/crypto/mining/cloud">Cloud Mining</a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>

            <li class="selected has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="fas fa-search-dollar"></div>
                </div>
                <span>Earnings</span></a>
              <div class="sub-menu-w">
                <div class="sub-menu-header">
                  Earnings
                </div>
                <div class="sub-menu-icon">
                  <i class="fas fa-search-dollar"></i>
                </div>
                <div class="sub-menu-i">
                  <ul class="sub-menu">
               
                    <li>
                      <a href="/dashboard/referral">Referral System</a>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            
          </ul>
          
        </div>
        <!--------------------
        END - Main Menu
        -------------------->


        <div class="content-w">
              <!--------------------
                START - Top Bar
                -------------------->
                @if(auth()->user()->theme_set == 1)
                <div class="top-bar color-scheme-transparent">
                  <div class="d-none d-xxl-block"><div style="padding: 20px;"><img width="200px" src="/img/settings/{{$set->image_logo}}"></div></div>
                  @else
                  <div class="top-bar color-scheme-transparent">
                  <div class="d-none d-xxl-block"><div style="padding: 20px;"><img width="200px" src="/img/settings/{{$set->image_logow}}"></div></div>
                  @endif
                

                
                  
                  <!--------------------
                  START - Top Menu Controls
                  -------------------->
                 
                      <div class="top-menu-controls">
                       <livewire:search-cryptos/>
                    
                    
                    <!--------------------
                    START - User avatar and menu in secondary top menu
                    -------------------->
                    <div class="logged-user-w">
                      <div class="logged-user-i">
                        <div class="avatar-w">
                          <img alt="" src="/img/avatars/{{ auth()->user()->image }}">
                        </div>
                        <div class="logged-user-menu color-style-bright">
                          <div class="logged-user-avatar-info">
                            <div class="avatar-w">
                              <img alt="" src="/img/avatars/{{ auth()->user()->image }}">
                            </div>
                            <div class="logged-user-info-w">
                              <div class="logged-user-name">
                              {{ auth()->user()->name }}
                              </div>
                              <div class="logged-user-role">
                                Administrator
                              </div>
                            </div>
                          </div>
                          <div class="bg-icon">
                            <i class="os-icon os-icon-wallet-loadingsed"></i>
                          </div>
                          <ul>
                            
                            <li>
                              <a href="/dashboard/profile"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                            </li>
                            
                            <li>
                              <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>

                              

                                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                              @csrf
                                          </form>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <!--------------------
                    END - User avatar and menu in secondary top menu
                    -------------------->
                  </div>
                  <!--------------------
                  END - Top Menu Controls
                  -------------------->
                </div>
                <!--------------------
                END - Top Bar
                -------------------->

                @if(auth()->user()->email_auth ==1)
                <div class="alert alert-warning" role="alert">
                  <strong>Email not Verified! </strong>Please verify your email <strong>{{auth()->user()->email}}</strong> for more secured your account.
                  <a href="/dashboard/auth/email" onclick="emailverifybutton(this)">Verify Now</a>
                  <span id="verifyemail" style="display:none;"><strong><span style="color: green;">Processing...</span></strong></span>

                  <script>
                    const emailverifybutton = (element) => {
                    element.hidden = true;                                                    
                    document.getElementById('verifyemail').style.display = "block";                  
                    }
                  </script>

                </div>
                @else

                @endif

             
               
                @yield('content')



                @if(auth()->user()->theme_set == 1)
                <!--------------------
              START - Color Scheme Toggler
              -------------------->
              <div onclick="colorthemechangingdark(this)" class="floated-colors-btn second-floated-btn">
                <div class="os-toggler-w">
                  <div onclick="colorthemechangingdark(this)" class="os-toggler-i">
                    <div class="os-toggler-pill"></div>
                  </div>
                </div>
                <span>Dark </span><span>Colors</span>
              </div>
              <!--------------------
              END - Color Scheme Toggler
              -------------------->
              @else
              <!--------------------
              START - Color Scheme Toggler
              -------------------->
              <div onclick="colorthemechanginglight(this)" class="floated-colors-btn second-floated-btn">
                <div class="os-toggler-w on">
                  <div onclick="colorthemechanginglight(this)" class="os-toggler-i">
                    <div class="os-toggler-pill"></div>
                  </div>
                </div>
                <span>Dark </span><span>Colors</span>
              </div>
              <!--------------------
              END - Color Scheme Toggler
              -------------------->
              @endif
              

              

          </div>
        </div>
      <div class="display-type"></div>
    </div>
    <script src="/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="/bower_components/moment/moment.js"></script>
    <script src="/bower_components/chart.js/dist/Chart.min.js"></script>
    <script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="/bower_components/jquery-bar-rating/dist/jquery.barrating.min.js"></script>
    <script src="/bower_components/ckeditor/ckeditor.js"></script>
    <script src="/bower_components/bootstrap-validator/dist/validator.min.js"></script>
    <script src="/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>
    <script src="/bower_components/dropzone/dist/dropzone.js"></script>
    <script src="/bower_components/editable-table/mindmup-editabletable.js"></script>
    <script src="/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
    <script src="/bower_components/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="/bower_components/tether/dist/js/tether.min.js"></script>
    <script src="/bower_components/slick-carousel/slick/slick.min.js"></script>
    <script src="/bower_components/bootstrap/js/dist/util.js"></script>
    <script src="/bower_components/bootstrap/js/dist/alert.js"></script>
    <script src="/bower_components/bootstrap/js/dist/button.js"></script>
    <script src="/bower_components/bootstrap/js/dist/carousel.js"></script>
    <script src="/bower_components/bootstrap/js/dist/collapse.js"></script>
    <script src="/bower_components/bootstrap/js/dist/dropdown.js"></script>
    <script src="/bower_components/bootstrap/js/dist/modal.js"></script>
    <script src="/bower_components/bootstrap/js/dist/tab.js"></script>
    <script src="/bower_components/bootstrap/js/dist/tooltip.js"></script>
    <script src="/bower_components/bootstrap/js/dist/popover.js"></script>
    <script src="/js/demo_customizer.js?version=4.4.0"></script>
    <script src="/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/live_data_update.js"></script>
    <script src="/js/main.js?version=4.4.0"></script>
    <script src="https://kit.fontawesome.com/efc9024db4.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @livewireScripts

    @if(auth()->user()->theme_set == 1)
    <script src="/js/toastr_alert.js">
  </script>
    @else
    <script src="/js/toastr_alert_dark.js">
  </script>
    @endif
    
    <x-livewire-alert::scripts />

    {!! $set->chat_script !!}
    
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
      
      ga('create', 'UA-XXXXXXX-9', 'auto');
      ga('send', 'pageview');
    </script>

    <script>
      var $loading = $('#loadingDiv').show();

      setInterval(tradestime, 5000);
      function tradestime(){

      fetch("https://api.binance.com/api/v3/ticker/price").then(
      res=>{
      res.json().then(
      data=>{
      console.log(data);
      if(data.length > 0){
      var temp = ""; 

      //---- Start for loop
      data.forEach((ticker)=>{
        
      temp += "<div class='col-6 col-sm-3 col-xxl-2'>";
      temp += "<a class='element-box el-tablo centered trend-in-corner smaller' href='/dashboard/trade/spot/"+ticker.symbol+"?symbol="+ticker.symbol+"'>";
      temp += "<div class='label'>"+ticker.symbol+" Price</div>";
      temp += "<div class='value' style='font-size: 16px;'>"+ticker.price+"</div>";
      temp += "<div id='cryptochangeinoneday'></div>";     
      temp += "</a>";
      temp += "</div>";
      })
      //---Close for loop
      $loading.hide();
      document.getElementById("allcryptosdata").innerHTML = temp;
      }
      }
      )}
      )}      
      
          

      const colorthemechangingdark = (element) => {
        window.location = "{{ url ('/') }}/dashboard/user/{{ auth()->user()->id }}/themechange/2";          
      }

      const colorthemechanginglight = (element) => {
        window.location = "{{ url ('/') }}/dashboard/user/{{ auth()->user()->id }}/themechange/1";          
      }      

      </script>
    {!! Toastr::message() !!}
  </body>
</html>
