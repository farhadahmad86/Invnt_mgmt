@extends('layouts.theme')

@section('content')
    <!--===============================================================================================-->
{{--    <link rel="icon" type="image/png" href="{{asset('login_theme/images/icons/favicon.ico')}}"/>--}}
    <!--===============================================================================================-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/vendor/bootstrap/css/bootstrap.min.css')}}">--}}
    <!--===============================================================================================-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">--}}
    <!--===============================================================================================-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/fonts/Linearicons-Free-v1.0.0/icon-font.min.css')}}">--}}
    <!--===============================================================================================-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/vendor/animate/animate.css')}}">--}}
    <!--===============================================================================================-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/vendor/css-hamburgers/hamburgers.min.css')}}">--}}
    <!--===============================================================================================-->
{{--    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/vendor/select2/select2.min.css')}}">--}}
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/css/util.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('login_theme/css/main.css')}}">
    <!--===============================================================================================-->



    <style>

        button, input {
            overflow: visible;
            border: none;
        }
        .red-border {
            color: #495057;
            background-color: #fff;
            border-color: #ff8e9d;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgb(225 0 0 / 100%);
        }
        .fa-eye,.fa-eye-slash{
            position: absolute;
            right: 10px;
            padding: 18px;
            color: #056bcd;
        }
    </style>


    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-1">Setting</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>

                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Change Password</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="limiter">

                <div class="container-login100" style="background-image: url('{{asset('login_theme/images/img-01.jpg')}}');">
                    <div class="wrap-login100 p-t-60 p-b-30">

{{--                        <form class="login100-form validate-form" method="POST" action="{{route('settings.update',$change_password->id)}}">--}}
                        <form class="login100-form validate-form" method="POST" action="{{route('settings.update',$change_password->id)}}">
                            @csrf
                            @method("PUT")

                            <div class="login100-form-avatar">
                                <img src="{{asset('login_theme/images/jadeedworkshop-03.svg')}}" alt="AVATAR">
                            </div>

                            <span class="login100-form-title p-t-20 p-b-45">
						Change Password
                </span>





                            <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                                <i class="fas fa-eye" onclick="showPassword()" id="eye"></i>
                                <input id="old_password" name="old_password" type="password" class="input100 @error('password') is-invalid @enderror" required placeholder="Old Password" >
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

                            <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required">
                                <i class="fas fa-eye" onclick="showPassword2()" id="eye2"></i>
                                <input id="new_password" name="new_password" type="password" class="input100 @error('password') is-invalid @enderror" required placeholder="New Password" >
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

                            <div class="wrap-input100 validate-input m-b-10" data-validate = "Password is required" style="margin-bottom: 0">
                                <i class="fas fa-eye" onclick="showPassword3()" id="eye3"></i>
                                <input id="confirm_password" name="confirm_password" type="password" class="input100 @error('password') is-invalid @enderror" required placeholder="Confirm Password" >
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
                        <span id="massage" style="display: none;color: red;color: white;background-color: red;padding: 4px;border-radius: 7px;margin-left: 17px;">Password not match</span>

                            <div class="container-login100-form-btn p-t-10">
                                <button type="submit" class="login100-form-btn" onclick="return check()">
                                    Update Password
                                </button>
                            </div>


                        </form>
                    </div>

{{--                    <div class="text-center w-full">--}}
{{--                        <a class="txt1" href="https://softagics.com/" target="_blank">--}}
{{--                            Copyright © 2019-2021 Softagics. All rights reserved.--}}
{{--                            --}}{{--                          <i class="fa fa-long-arrow-right"></i>--}}
{{--                        </a>--}}
{{--                    </div>--}}

                </div>



            </div>


        </div>
    </div>
    <script>
        var new_password = document.getElementById("new_password");
        var confirm_password = document.getElementById("confirm_password");
        function check() {
            if (new_password.value == confirm_password.value){
               return true;
            }
            $("#confirm_password").addClass("red-border");
            $("#massage").css("display","block");
            return false;
        }
        function showPassword() {
            var x = document.getElementById("old_password");
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
        function showPassword2() {
            var x = document.getElementById("new_password");
            var y = document.getElementById("eye2");
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
        function showPassword3() {
            var x = document.getElementById("confirm_password");
            var y = document.getElementById("eye3");
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
    <!--**********************************
        Content body end
    ***********************************-->
@endsection
@section('script')


@stop
