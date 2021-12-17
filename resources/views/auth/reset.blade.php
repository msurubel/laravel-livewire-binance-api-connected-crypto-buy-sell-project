<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from demo.themefisher.com/tradix/reset.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Jun 2021 11:39:42 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tradix </title>
    <!-- Favicon icon -->
    <link rel="icon" type="/image/png" sizes="16x16" href="images/favicon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/vendor/waves/waves.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div id="main-wrapper">

        <div class="authincation section-padding">
            <div class="container h-100">
                <div class="row justify-content-center h-100 align-items-center">
                    <div class="col-xl-5 col-md-6">
                        <div class="mini-logo text-center my-5">
                            <img src="/img/settings/{{$set->image_logo}}" alt="" width="200">
                        </div>
                        <div class="auth-form card">
                            <div class="card-header justify-content-center">
                                <h4 class="card-title">Reset password</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route ('user.password.reset.send') }}">
                                @csrf
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" value="hello@example.com">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" onclick="actionresetbutton(this)" class="btn btn-success btn-block">Reset</button>
                                        <div id="resetbuttonpro"  style="display:none;" ><img alt="" width="40px" src="/img/loading-2.gif"><span style="padding-left: 10px;">Processing...</span></div>
                                        <script>
                                        const actionresetbutton = (element) => {
                                            element.hidden = true;                                                    
                                            document.getElementById('resetbuttonpro').style.display = "block";
                                            
                                        }
                                        </script>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p class="mb-1">Already Received Ontime Password?
                                    <a class="text-primary" href="/login">Login Now </a>
                                    or Don't Received? Please submit again after 5 min.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>





    <script src="/js/global.js"></script>
    
    <script src="/vendor/waves/waves.min.js"></script>
    <script src="/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {!! Toastr::message() !!}
</body>


<!-- Mirrored from demo.themefisher.com/tradix/reset.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 28 Jun 2021 11:39:42 GMT -->
</html>