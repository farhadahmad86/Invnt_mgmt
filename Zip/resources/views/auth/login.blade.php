<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('login_theme/images/icons/fav.png')}}"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/vendor/animate/animate.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/vendor/css-hamburgers/hamburgers.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/vendor/select2/select2.min.css')}}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/css/main.css')}}">
    <!--===============================================================================================-->
    <style>
        .fa-eye,.fa-eye-slash{
            position: absolute;
            right: 10px;
            padding: 18px;
            color: #056bcd;
        }
    </style>
</head>

<body>

<div class="limiter">

    <div class="container-login100" style="background-image: url('{{asset('login_theme/images/img-01.jpg')}}');">
        <div class="wrap-login100 p-t-60 p-b-30">
            @include('inc._message')
            <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf

                <div class="login100-form-avatar mb-3">
                    <img src="{{asset('login_theme/images/jadeedworkshop-03.svg')}}" alt="AVATAR">
                </div>

{{--                <span class="login100-form-title p-t-20 p-b-45">--}}
{{--						RF Electronics--}}
{{--                </span>--}}



                <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">
                    <input id="email" type="email" name="email" class="input100 @error('email') is-invalid @enderror" value="{{ old('email') }}" required  placeholder="Email">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-user"></i>
						</span>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>




                {{--                <div class="wrap-input100 validate-input m-b-10" data-validate = "Username is required">--}}
                {{--                    <input id="email" type="email" class="input100 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

                {{--                    @error('email')--}}
                {{--                    <span class="invalid-feedback" role="alert">--}}
                {{--<strong>{{ $message }}</strong>--}}
                {{--                        </span>--}}
                {{--                    @enderror--}}
                {{--                </div>--}}





                <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                    <i class="fa fa-eye" onclick="showPassword()" id="eye"></i>
                    <input id="password" name="password" type="password" class="input100 @error('password') is-invalid @enderror" required placeholder="Password">
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>

                    @error('password')
                    <span class="focus-input100"></span>
                    <span class="invalid-feedback symbol-input100" role="alert">
                        <strong>{{ $message }}</strong>
                            <i class="fa fa-user"></i>
                        </span>
                    @enderror
                </div>

                {{--                remember me--}}
                {{--                <div class="form-group row">--}}
                {{--                    <div class="col-md-6 offset-md-4">--}}
                {{--                        <div class="form-check">--}}
                {{--                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

                {{--                            <label class="form-check-label" for="remember">--}}
                {{--                                {{ __('Remember Me') }}--}}
                {{--                            </label>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}




                <div class="container-login100-form-btn p-t-10">
                    <button class="login100-form-btn">
                        Login
                    </button>

                    <div class="text-center w-full p-t-25">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request')}}" class="txt1">
                                {{--                        Forgot Username / Password?--}}
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>



                {{--                <div class="text-center w-full">--}}
                {{--                    <a class="txt1" href="#">--}}
                {{--                        Copyright © 2019-2021 Shangrila. All rights reserved.--}}
                {{--                          <i class="fa fa-long-arrow-right"></i>--}}
                {{--                     </a>--}}
                {{--                </div>--}}
            </form>
        </div>

        <div class="text-center w-full">
            <a class="txt1" href="https://softagics.com/" target="_blank">
                Copyright © 2019-<span id="current-year"></span> Softagics. All rights reserved.
                {{--                          <i class="fa fa-long-arrow-right"></i>--}}
            </a>
        </div>

    </div>



</div>




<!--===============================================================================================-->
<script src="{{asset('login_theme/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('login_theme/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{asset('login_theme/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('login_theme/vendor/select2/select2.min.js')}}"></script>
<!--===============================================================================================-->
<script src="{{asset('login_theme/js/main.js')}}"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    function showPassword() {
        var x = document.getElementById("password");
        var y = document.getElementById("eye");
        if (x.type == "password") {
            y.classList.add("fa-eye-slash");
            y.classList.remove("fa-eye");
            x.type = "text";
        } else {
            y.classList.add("fa-eye");
            y.classList.remove("fa-eye-slash");
            x.type = "password";
        }
    }
</script>
<script>
    document.getElementById('current-year').textContent = new Date().getFullYear();
</script>

</body>
</html>
