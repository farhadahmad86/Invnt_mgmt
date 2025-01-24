<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Job Server') }}</title> --}}
    {{-- <title>Job Server</title> --}}
    <title>{{ isset($pageTitle) ? $pageTitle : 'Job Server' }}</title>
    <!-- start theme links  -->

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('theme/images/fav.png') }}">
    <link href="{{ asset('theme/vendor/pg-calendar/css/pignose.calendar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/vendor/chartist/css/chartist.min.css') }}" rel="stylesheet">
    {{-- <link href="{{asset('theme/css/style.css')}}" rel="stylesheet"> --}}

    <link rel="stylesheet" href="{{ asset('theme/vendor/select2/css/select2.min.css') }}">
    <link href="{{ asset('theme/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/css/style2.css') }}" rel="stylesheet">
    <!-- end theme links  -->
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/duotone.css"
        integrity="sha384-R3QzTxyukP03CMqKFe0ssp5wUvBPEyy9ZspCB+Y01fEjhMwcXixTyeot+S40+AjZ" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/fontawesome.css"
        integrity="sha384-eHoocPgXsiuZh+Yy6+7DsKAerLXyJmu2Hadh4QYyt+8v86geixVYwFqUvMU8X90l" crossorigin="anonymous" />
    <!-- Datatable -->
    <link href="{{ asset('theme/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet') }}">
    <!-- Custom Stylesheet -->
    <link href="{{ asset('theme/css/style.css" rel="stylesheet') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        body {
            font-size: 0.8rem !important;
            color: black;
        }

        .red-border {
            border: 1px solid red;
        }

        .red-border:focus {
            color: #495057;
            background-color: #fff;
            border-color: #ff8e9d;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgb(220 52 52 / 25%);
        }

        .select2-selection--single:focus {
            color: #495057;
            background-color: #fff;
            border-color: #a1cbef;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgb(52 144 220 / 25%) !important;
        }

        .iconsl {
            color: black;
            padding: 6px;
            background-color: #d1d1d1;
        }

        .icons {
            position: absolute;
            right: 15px;
            top: 15px;
        }

        .fa-eye,
        .fa-eye-slash {
            position: absolute;
            right: 15px;
            padding: 13px;
            color: #056bcd;
        }

        /* farhad add  */
        @media print {

            .hidden-print,
            .hidden-print * {
                display: none !important;
            }
        }

        .card {
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
            {{-- <div class="main-content"> --}}
            {{-- <main class="py-4"> --}}
            <main>
                @yield('content')
            </main>
            @include('inc._footer')
            {{-- </div> --}}
        </div>
    </div>


    <!-- Required vendors -->
    <script src="{{ asset('theme/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('theme/js/quixnav-init.js') }}"></script>
    <script src="{{ asset('theme/js/custom.min.js') }}"></script>

    <script src="{{ asset('theme/vendor/chartist/js/chartist.min.js') }}"></script>

    <script src="{{ asset('theme/vendor/moment/moment.min.js') }}"></script>
    <script src="{{ asset('theme/vendor/pg-calendar/js/pignose.calendar.min.js') }}"></script>


    <script src="{{ asset('theme/js/dashboard/dashboard-2.js') }}"></script>
    <!-- Circle progress -->

    <!-- Required vendors -->
    {{-- <script src="{{asset('theme/vendor/global/global.min.js')}}"></script> --}}
    <script src="{{ asset('theme/js/quixnav-init.js') }}"></script>


    @yield('script')

    <script src="{{ asset('theme/js/custom.min.js') }}"></script>


    <!-- Jquery Validation -->
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/additional-methods.min.js"></script>

    <script src="{{ asset('theme/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins-init/select2-init.js') }}"></script>

    <!-- Datatable -->
    <script src="{{ asset('theme/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('theme/js/plugins-init/datatables.init.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>
    <!-- Ibrahim add -->
    <script>
        function lettersOnly(e) {
            var keyCode = e.keyCode || e.which;
            var regex = /^[A-Za-z ]+$/;
            var isValid = regex.test(String.fromCharCode(keyCode));
            return isValid;
        }

        function numbersOnly(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            else {
                // event.classList.add('was-validated')
                return true;
            }
        }

        function validateInventoryInputs(InputIdArray) {
            let i = 0,
                flag = false,
                getInput = '';

            for (i; i < InputIdArray.length; i++) {
                if (InputIdArray) {
                    getInput = document.getElementById(InputIdArray[i]);
                    if (getInput.value === '' || getInput.value === 0) {
                        getInput.focus();
                        getInput.classList.add('red-border');
                        flag = false;
                        break;
                    } else {
                        getInput.classList.remove('red-border');
                        flag = true;
                    }
                }
            }
            return flag;
        }

        function numberFormatter(event) {
            var Number = $("#number").val();
            var Number_length = Number.length;
            if (Number_length == 4) {
                $("#number").val(Number + "-");
            }

            if (Number_length > 11) {
                event.preventDefault();
            }
            // numbersOnly(event);
            var charCode = (event.which) ? event.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            else {
                // event.classList.add('was-validated')
                numbersOnly(event);
                return true;
            }


        }
        // function numberFormatter(event) {
        //     var $numberInput = $("#job_id");
        //     var number = $numberInput.val().replace(/[^0-9]/g, ''); // Remove non-numeric characters
        //     var formattedNumber = '';

        //     if (number.length > 4) {
        //         formattedNumber = number.slice(0, 4) + '-' + number.slice(4);
        //     } else {
        //         formattedNumber = number;
        //     }

        //     if (formattedNumber.length >= 11) {
        //         event.preventDefault();
        //     }
        //     $numberInput.val(formattedNumber);
        // }
        // function numberFormatter(event) {
        //     var Number = $("#job_id").val();
        //     var Number_length = Number.length;
        //     if (Number_length == 4) {
        //         $("#job_id").val(Number + "-");
        //     }

        //     if (Number_length > 11) {
        //         event.preventDefault();
        //     }
        //     // numbersOnly(event);
        //     var charCode = (event.which) ? event.which : event.keyCode
        //     if (charCode > 31 && (charCode < 48 || charCode > 57))
        //         return false;
        //     else {
        //         // event.classList.add('was-validated')
        //         numbersOnly(event);
        //         return true;
        //     }


        // }
        function cnicFormatter(event) {
            var cnic = $("#cnic").val();
            var cnic_length = cnic.length;

            // alert(cnic);
            // alert(cnic_length);

            if (cnic_length == 5) {
                $("#cnic").val(cnic + "-");
            }

            if (cnic_length == 13) {
                $("#cnic").val(cnic + "-");
            }

            if (cnic_length > 14) {
                event.preventDefault();
            }
            var charCode = (event.which) ? event.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            else {
                // event.classList.add('was-validated')
                numbersOnly(event);
                return true;
            }
        }
    </script>
</body>

</html>
