@extends('layouts.theme')

@section('content')

    <style>

        button, input {
            overflow: visible;
            border: none;
        }

        body {
            color: black;
        }

    </style>



    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
          integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body" style="margin-top: 30px;min-height: 89vh!important;">
        <div class="container-fluid">
            <div class="row page-titles mx-0" style="margin-top: -55px;margin-bottom: -4px">
                <div class="col-lg-12 p-md-0">
                    <div class="welcome-text" style="text-align: center">
                        <h1>Employee Registration</h1>

                    </div>
                </div>

            </div>
            @include('inc._message')
            <!-- row -->

            <div class="alert alert-danger " style="display: none" id="alert">
                <a href="#" class="close" aria-label="close"
                   onclick="document.getElementById('alert').style.display = 'none';">&times;</a>
                <p style="margin: auto;width: 50%;"><strong>Danger!</strong> Password not match.</p>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('employee_registration.store')}}"
                                      method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row ">
                                        <div class="col-xl-12">
                                            <h5 class="mb-3">Personal Information:</h5>

                                            <div class="form-group row justify-content-around"
                                                 style="margin-top: -25px">
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="name">Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="name"
                                                               name="name" placeholder="Enter a Name.."
                                                               onkeypress="return lettersOnly(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="father_name">Father Name
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="father_name"
                                                               name="father_name" placeholder="Enter a Father Name.."
                                                               onkeypress="return lettersOnly(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <label class="col-form-label" for="gender">Gender <span
                                                            class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-3"
                                                     style="margin-top: 30px;display:flex;flex-direction: row">
                                                    <div class="form-check " style="">
                                                        <input type="radio" value="Male" id="male" name="gender">

                                                        <label class="form-check-label" for="male" id="male-l">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" value="Female" id="female" name="gender">

                                                        <label class="form-check-label" for="female" id="female-l">
                                                            Female
                                                        </label>

                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-group row justify-content-around"
                                                 style="margin-top: -14px">
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="cnic">CNIC
                                                    </label> <span class="text-danger">*</span>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="cnic"
                                                               name="cnic" placeholder="12345-1234567-1"
                                                               onkeypress="return cnicFormatter(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="number">Number
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="number"
                                                               name="number" placeholder="Enter Number.."
                                                               onkeypress="return numberFormatter(event)">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="address">Address
                                                    </label>
                                                    <div class="">
                                                        <input type="text" class="form-control" id="address"
                                                               name="address" placeholder="Enter Address..">
                                                    </div>
                                                </div>
                                            </div>
                                            <h5 class="mb-3">Login Information:</h5>


                                            <div class="form-group row justify-content-around"
                                                 style="margin-top: -14px">

                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="email">User Email
                                                        {{--                                                        <span class="text-danger">*</span>--}}
                                                    </label>
                                                    <div class="">
                                                        <input type="email" class="form-control" id="email"
                                                               name="email" placeholder="Enter Email..">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="password">Password
                                                        {{--                                                        <span class="text-danger">*</span>--}}
                                                    </label>
                                                    <div class="">
                                                        <i class="fas fa-eye" onclick="showPassword()" id="eye"></i>
                                                        <input type="password" class="form-control" id="password"
                                                               name="password" placeholder="Password...">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="confirm_password">Confirm
                                                        Password
                                                        {{--                                                        <span class="text-danger">*</span>--}}
                                                    </label>
                                                    <div class="">
                                                        <i class="fas fa-eye" onclick="showPassword2()" id="eye2"></i>
                                                        <input type="password" class="form-control"
                                                               id="confirm_password"
                                                               name="confirm_password" placeholder="Confirm Password..">
                                                    </div>
                                                </div>

                                            </div>

                                            <h5 class="mb-3">Status:</h5>


                                            <div class="form-group row">


                                                <div hidden class="col-md-4" style="margin-top: -10px">
                                                    <label class="col-form-label" for="role">Role
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <select id="role" name="role">

                                                            <option value="Admin" selected>Admin</option>
                                                            <option value="Manager" selected>Manager</option>
                                                            <option value="Stock Manager" selected>Stock Manager
                                                            </option>
                                                            <option value="Cashier" selected>Cashier</option>
                                                            <option value="Technician" selected>Technician</option>
                                                            <option value="Job Scheduler" selected>Job Scheduler
                                                            </option>
                                                            <option value="Select" selected disabled>Select</option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <label>Employee Status: <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-2 p-0" style="border: 0.1px solid gray;">
                                                    <div class="form-check ">
                                                        <input type="radio" value="1" id="enable" name="emp_status">

                                                        <label class="form-check-label" for="enable" id="enable-l">
                                                            Enable
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" value="0" id="disable" name="emp_status">

                                                        <label class="form-check-label" for="disable" id="disable-l">
                                                            Disable
                                                        </label>

                                                    </div>

                                                </div>

                                                <div class="col-md-2">
                                                    <label>Login Status: <span class="text-danger">*</span>
                                                    </label>
                                                </div>
                                                <div class="col-md-2 p-0" style="border: 0.1px solid gray;">
                                                    <div class="form-check ">
                                                        <input type="radio" value="1" id="enable2" name="log_status">

                                                        <label class="form-check-label" for="enable2" id="enable2-l">
                                                            Enable
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input type="radio" value="0" id="disable2" name="log_status">

                                                        <label class="form-check-label" for="disable2" id="disable2-l">
                                                            Disable
                                                        </label>

                                                    </div>

                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="1"
                                                               id="work_status" name="work_status">
                                                        <label class="form-check-label" for="work_status">
                                                            Work as Technician
                                                        </label>
                                                    </div>


                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="col-form-label" for="roles">Select Role
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="">
                                                        <select id="roles" name="roles" required>
                                                            <option value="0">Select Role</option>
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->id}}">
                                                                    {{$role->name}}</option>
                                                            @endforeach

                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            {{--                                            <div class="form-group row" style="margin-top: 33px">--}}
                                            {{--                                                <label class="col-lg-2 col-form-label" for="roles">Role Name--}}
                                            {{--                                                    <span class="text-danger">*</span>--}}
                                            {{--                                                </label>--}}
                                            {{--                                                <div class="col-lg-3">--}}
                                            {{--                                                    <div class="icons" style="top: -25px">--}}
                                            {{--                                                        <a href="{{asset("add_category")}}" style="color:black" target="_blank">--}}
                                            {{--                                                            <l class="fa fa-plus iconsl"></l></a>--}}
                                            {{--                                                        <l id="cat_refresh" class="fa fa-refresh iconsl" style="cursor: pointer;"></l>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}


                                            <div class="col-md-12"
                                                 style="text-align: center;margin-top: -14px;margin-bottom: -10px">
                                                <button type="submit" class="btn btn-primary">Register</button>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@endsection
@section('script')

    <script>
        function maincheckForm() {
            // alert("www");
            let name = document.getElementById("name"),
                father_name = document.getElementById("father_name"),
                male = document.getElementById("male"),
                female = document.getElementById("female"),
                cnic = document.getElementById("cnic"),
                number = document.getElementById("number"),
                address = document.getElementById("address"),
                // email = document.getElementById("email"),
                // password = document.getElementById("password"),
                // confirm_password = document.getElementById("confirm_password"),
                enable = document.getElementById("enable"),
                disable = document.getElementById("disable"),
                enable2 = document.getElementById("enable2"),
                disable2 = document.getElementById("disable2"),
                roles = document.getElementById("roles"),

                validateInputIdArray = [
                    name.id,
                    father_name.id,
                    male.id,
                    female.id,
                    cnic.id,
                    // email.id,
                    // password.id,
                    // confirm_password.id,
                    enable.id,
                    disable.id,
                    enable2.id,
                    disable2.id,
                    roles.id,
                ];
            // alert(male.checked)
            var ok = validateInventoryInputs(validateInputIdArray);

            if (password.value != confirm_password.value) {
                $("#confirm_password").addClass("red-border");
                $("#alert").css("display", "block");
                return false;
            }
            if (male.checked == false && female.checked == false) {
                document.getElementById("male-l").style.color = "red"
                document.getElementById("female-l").style.color = "red"
                return false;
            }

            if (roles.value == 0) {
                roles.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            } else {
                document.getElementById("male-l").style.color = ""
                document.getElementById("female-l").style.color = ""
            }
            if (enable.checked == false && disable.checked == false) {
                document.getElementById("enable-l").style.color = "red"
                document.getElementById("disable-l").style.color = "red"
                // .style.color = "red"
                return false;
            } else {
                document.getElementById("enable-l").style.color = ""
                document.getElementById("disable-l").style.color = ""
            }
            if (enable2.checked == false && disable2.checked == false) {
                document.getElementById("enable2-l").style.color = "red"
                document.getElementById("disable2-l").style.color = "red"
                // .style.color = "red"
                return false;
            } else {
                document.getElementById("enable2-l").style.color = ""
                document.getElementById("disable2-l").style.color = ""
            }
            if (cnic.value.length == 15) {
                cnic.classList.remove('red-border');
            } else {
                cnic.classList.add('red-border');
                return false;
            }
            if (number.value.length == 12 || number.value.length == 0) {
                number.classList.remove('red-border');
            } else {
                number.classList.add('red-border');
                return false;
            }
            // if (female.value == "Female") {
            //     document.getElementById("female-l").style.color = "red"
            //     return false;
            // }
            // else{
            //     document.getElementById("female-l").style.color = ""
            // }

            // return validateInventoryInputs(validateInputIdArray);

            // var ok = validateInventoryInputs(validateInputIdArray);

            if (ok) {
                $("button[type='submit']").prop('disabled', true);
                return true;
            } else {
                return false;
            }
        }

        $(document).ready(function () {
            $("#role").select2();
            $("#model").select2();
            $("#category").select2();
            $("#roles").select2();
            // $('#form').validate({ // initialize the plugin
            //
            //     // rules: {
            //     //     client_name: {
            //     //         required: true,
            //     //         pattern: /^[A-Za-z0-9. ]{3,30}$/
            //     //     },
            //     //     client_no: {
            //     //         required: true,
            //     //         pattern:/^((\+92-?)|(0092-?)|(0))3\d{2}-?\d{7}$/
            //     //     },
            //     //     warranty: {
            //     //         required: true,
            //     //     },
            //     //     delivery_time: {
            //     //         required: true,
            //     //     },
            //     //     job_id: {
            //     //         required: true,
            //     //     },
            //     //     brand: {
            //     //         required: true,
            //     //     },
            //     //     model: {
            //     //         required: true,
            //     //     },
            //     //     category: {
            //     //         required: true,
            //     //     },
            //     //     equipment: {
            //     //         required: true,
            //     //         pattern: /^[A-Za-z0-9. ]{3,30}$/
            //     //     },
            //     //     serial_no: {
            //     //         required: true,
            //     //     },
            //     //     estimated_cost: {
            //     //         required: true,
            //     //         pattern:/^(\d+(,\d{1,2})?)?$/
            //     //     },
            //     //     complain: {
            //     //         pattern: /^[A-Za-z0-9. ]{3,30}$/
            //     //     },
            //     //     accessories: {
            //     //         pattern: /^[A-Za-z0-9. ]{3,30}$/
            //     //     }
            //     // },
            //     // messages: {
            //     //     client_name: {
            //     //         required: "Required",
            //     //     },
            //     //     client_no: {
            //     //         required: "Required",
            //     //     },
            //     //     delivery_time: {
            //     //         required: "Required",
            //     //     },
            //     //     job_id: {
            //     //         required: "Required",
            //     //     },
            //     //     brand: {
            //     //         required: "Required",
            //     //     },
            //     //     model: {
            //     //         required: "Required",
            //     //     },
            //     //     category: {
            //     //         required: "Required",
            //     //     },
            //     //     equipment: {
            //     //         required: "Required",
            //     //     },
            //     //     serial_no: {
            //     //         required: "Required",
            //     //     },
            //     //     estimated_cost: {
            //     //         required: "Required",
            //     //     }
            //     //
            //     // },
            //
            //     ignore: [],
            //     errorClass: "invalid-feedback animated fadeInUp",
            //     errorElement: "div",
            //     errorPlacement: function (e, a) {
            //         jQuery(a).parents(".form-group > div").append(e)
            //     },
            //     highlight: function (e) {
            //         jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
            //     },
            //     success: function (e) {
            //         jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
            //     },
            //
            // });

        });

        var counter = 0;
        var counter2 = 0;


        function add_complain() {

            if (complain_checkForm()) {
                counter++;

                var complain = $("#complain").val();

                add_complain_row(counter, complain);

            } else {

            }


        }

        function add_complain_row(counter, complain) {

            jQuery("#table_body").append(
                '<tr id="table_row' + counter + '">' +
                '<td>' + counter + '</td>' +
                '<td>' + '<input type="text" name="complain_data[]" id="complain_data' + counter + '" value="' + complain + '">' + '</td>' +

                '<td>' +
                '<span>' +
                '<a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a>' +
                '</span>' +
                '</td>' +

                '</tr>');


            $("#complain").val('');


        }


        function add_accessories() {


            if (accessories_checkForm()) {

                counter2++;

                var accessories = $("#accessories").val();

                add_accessories_row(counter2, accessories);

            } else {

            }

        }

        function add_accessories_row(counter2, accessories) {

            jQuery("#table_body2").append(
                '<tr id="table_row' + counter2 + '">' +
                '<td>' + counter2 + '</td>' +
                '<td>' + '<input type="text" name="accessory_data[]" id="accessories_data' + counter2 + '" value="' + accessories + '">' + '</td>' +

                '<td>' +
                '<span>' +
                '<a href="javascript:void()" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a>' +
                '</span>' +
                '</td>' +

                '</tr>');


            $("#accessories").val('');


        }


    </script>

    <script>

        jQuery("#brand").change(function () {
            var bra_name_id = $(this).val();

            // var dropDown = document.getElementById('brand');
            // var bra_name_id = dropDown.options[dropDown.selectedIndex].value;

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{route('get_category')}}",
                data: {bra_name_id: bra_name_id},
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function (data) {

                    console.log(data);
                    $options = "<option value='' disabled selected>Select Category</option>";
                    //
                    $.each(data, function (index, value) {
                        $options += "<option value='" + value.cat_id + "'>" + value.cat_name + "</option>";
                    });
                    jQuery("#category").html(" ");
                    jQuery("#category").append($options);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });
        });

        jQuery("#category").change(function () {
            var cat_name_id = $(this).val();

            // var dropDown = document.getElementById('brand');
            // var bra_name_id = dropDown.options[dropDown.selectedIndex].value;

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{route('get_model')}}",
                data: {cat_name_id: cat_name_id},
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function (data) {

                    console.log(data);
                    $options = "<option value='' disabled selected>Select Model</option>";
                    //
                    $.each(data, function (index, value) {
                        $options += "<option value='" + value.mod_id + "'>" + value.mod_name + "</option>";
                    });
                    jQuery("#model").html(" ");
                    jQuery("#model").append($options);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });
        });

        $('#client_no').blur(function () {
            var number = $('#client_no').val();

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{route('client_exist')}}",
                // url: "client_exist",
                data: {number: number},
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    jQuery("#client_name").val(data['cli_name']);
                    jQuery("#client_address").val(data['cli_address']);

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });


        });

    </script>




    <script type="text/javascript">


        function complain_checkForm() {
            let complain = document.getElementById("complain"),
                validateInputIdArray = [
                    complain.id,
                ];
            return validateInventoryInputs(validateInputIdArray);
        }

        function accessories_checkForm() {
            let accessories = document.getElementById("accessories"),
                validateInputIdArray = [
                    accessories.id,
                ];
            return validateInventoryInputs(validateInputIdArray);
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
                        getInput.classList.add('bg-danger');
                        flag = false;
                        break;
                    } else {
                        getInput.classList.remove('bg-danger');
                        flag = true;
                    }
                }
            }
            return flag;
        }

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

        function showPassword2() {
            var x = document.getElementById("confirm_password");
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

    </script>
@stop
