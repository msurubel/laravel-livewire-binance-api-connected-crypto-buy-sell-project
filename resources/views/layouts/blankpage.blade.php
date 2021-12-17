<!DOCTYPE html>
<html>
  <head>
    <title>{{$tittle}}</title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="Tamerlan Soziev" name="author">
    <meta content="Admin dashboard html template" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="/img/settings/{{$set->site_favicon}}" rel="shortcut icon">
    <link href="/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="/bower_components/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
    <link href="/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="/css/main.css?version=4.4.0" rel="stylesheet">
    <link href="/icons/cryptocoins/css/cryptocoins.css" rel="stylesheet">
    <link href="/icons/cryptocoins/css/cryptocoins-colors.css" rel="stylesheet">
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
    

    
  
      
  </head>
  <body>
    <div class="">
               
                @yield('content')

                </div>        
      
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
      
      setInterval(alltradestime, 5000);
      function alltradestime(){      
      fetch("https://api.binance.com/api/v3/ticker/price").then(
      res=>{
      res.json().then(
      data1=>{
      console.log(data1);
      if(data1.length > 0){
      var temp = "";

      //---- Start for loop
      data1.forEach((tickerall)=>{
      temp += "<tr>";
      temp += "<td><a href='/dashboard/trade/spot/"+tickerall.symbol+"?symbol="+tickerall.symbol+"'>"+tickerall.symbol+"</td>"
      temp += "<td class='text-center'>"+tickerall.price+"</td>"
      temp += "</tr>";
      })
      //---Close for loop           
      document.getElementById("allcryptosdataintable").innerHTML = temp;
      $loading.hide();
      }
      }
      )}
      )}
      

    

      </script>
    {!! Toastr::message() !!}
  </body>
</html>
