<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    {{-- <title>Job Server</title> --}}
    <title>{{ isset($pageTitle) ? $pageTitle : 'Job Server' }}</title>
    <!-- start theme links  -->

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('theme/images/fav.png') }}">
    <link rel="stylesheet" href="{{asset('theme/vendor/owl-carousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/vendor/owl-carousel/css/owl.theme.default.min.css')}}">
    <link href="{{asset('theme/vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('theme/css/style2.css')}}" rel="stylesheet">
    <style>
        body{
            font-size: 0.8rem !important;
            color: black;
        }
    </style>

</head>
<body>
<div id="app">
    <!--*******************
       Preloader start
   ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
            <div class="sk-child sk-bounce4"></div>
            <div class="sk-child sk-bounce5"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
    <div id="main-wrapper">
        @include('inc.theme._navbar')
        @include('inc.theme._sidebar')
        {{--        <div class="main-content">--}}
        <main class="py-4">
            @yield('content')
        </main>
        @include('inc._footer')
        {{--    </div>--}}
    </div>
</div>
<!--**********************************
    Scripts
***********************************-->
<!-- Required vendors -->
<script src="{{asset('theme/vendor/global/global.min.js')}}"></script>
<script src="{{asset('theme/js/quixnav-init.js')}}"></script>
<script src="{{asset('theme/js/custom.min.js')}}"></script>


<!-- Vectormap -->
<script src="{{asset('theme/vendor/raphael/raphael.min.js')}}"></script>
<script src="{{asset('theme/vendor/morris/morris.min.js')}}"></script>


<script src="{{asset('theme/vendor/circle-progress/circle-progress.min.js')}}"></script>
<script src="{{asset('theme/vendor/chart.js/Chart.bundle.min.js')}}"></script>

<script src="{{asset('theme/vendor/gaugeJS/dist/gauge.min.js')}}"></script>

<!--  flot-chart js -->
<script src="{{asset('theme/vendor/flot/jquery.flot.js')}}"></script>
<script src="{{asset('theme/vendor/flot/jquery.flot.resize.js')}}"></script>

<!-- Owl Carousel -->
<script src="{{asset('theme/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>

<!-- Counter Up -->
<script src="{{asset('theme/vendor/jqvmap/js/jquery.vmap.min.js')}}"></script>
<script src="{{asset('theme/vendor/jqvmap/js/jquery.vmap.usa.js')}}"></script>
<script src="{{asset('theme/vendor/jquery.counterup/jquery.counterup.min.js')}}"></script>


<script src="{{asset('theme/js/dashboard/dashboard-1.js')}}"></script>


@yield('script')

<script src="{{asset('theme/js/custom.min.js')}}"></script>


<!-- Jquery Validation -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>

<script src="{{asset('theme/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('theme/js/plugins-init/select2-init.js')}}"></script>

<!-- Datatable -->
<script src="{{asset('theme/vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('theme/js/plugins-init/datatables.init.js')}}"></script>

</body>
</html>
