@extends('layouts.theme')

@section('content')


<style>
    button,
    input {
        overflow: visible;
        border: none;
    }

    body {
        color: black;
    }

</style>



<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

<!--**********************************
            Content body start
        ***********************************-->
<div class="content-body" style="margin-top: 30px;min-height: 89vh!important;">
    <div class="container-fluid">
        <div class="row page-titles mx-0" style="margin-top: -55px;margin-bottom: -4px">
            <div class="col-lg-12 p-md-0">
                <div class="welcome-text" style="text-align: center">
                    <h1>Company Profile</h1>

                </div>
            </div>

        </div>
        @include('inc._message')
        <!-- row -->

        <div class="alert alert-danger " style="display: none" id="alert">
            <a href="#" class="close" aria-label="close" onclick="document.getElementById('alert').style.display = 'none';">&times;</a>
            <p style="margin: auto;width: 50%;"><strong>Danger!</strong> Password not match.</p>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">

                    <div class="card-body">
                        <div class="form-validation">
                            <form class="form-valide" id="form" action="{{route('update_company_profile')}}" method="post"  enctype="multipart/form-data" onsubmit="return maincheckForm()">
                                @csrf
                                 <input type="hidden" name="id" value="{{ $company_profile->cp_id }}">
                                <div class="row ">
                                    <div class="col-xl-12">
                                        <h5 class="mb-3">Company Information:</h5>

                                        <div class="form-group row justify-content-around" style="margin-top: -25px">
                                            <div class="col-md-4">
                                                <label class="col-form-label" for="name">Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="">
                                                    <input type="text" class="form-control" id="name" name="name" value="{{ $company_profile->cp_name }}" placeholder="Enter a Name.." onkeypress="return lettersOnly(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-form-label" for="salogan">Salogan
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="">
                                                    <input type="text" class="form-control" id="salogan" name="salogan" value="{{ $company_profile->cp_salogan }}" placeholder="Enter a Salogan.." onkeypress="return lettersOnly(event)">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-form-label" for="contact">Contact
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="">
                                                    <input type="text" class="form-control" id="contact" name="contact" value="{{ $company_profile->cp_contact }}" placeholder="Enter a Contact..">
                                                </div>
                                            </div>

                                        </div>


                                        <div class="form-group row justify-content-around" style="margin-top: -14px">
                                            <div class="col-md-4">
                                                <label class="col-form-label" for="address">Address
                                                </label> <span class="text-danger">*</span>
                                                <div class="">
                                                    <textarea type="text" class="form-control" id="address" name="address"  placeholder="Enter a Address..">{{ $company_profile->cp_address }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-form-label" for="deal_in">We Deal In
                                                </label>
                                                <div class="">
                                                    <textarea type="text" class="form-control" id="deal_in" name="deal_in" placeholder="Enter deal In..">{{ $company_profile->cp_deal }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-form-label" for="terms">Terms
                                                </label>
                                                <div class="">
                                                    <textarea type="text" class="form-control" id="terms" name="terms" placeholder="Enter Terms..">{{ $company_profile->cp_terms }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="col-form-label" for="logo">Logo
                                                </label>
                                                <div class="">
                                                    <input type="file" class="form-control" name="logo" id="logo">
                                                    <img src="{{ $company_profile->cp_logo }}" alt="Logo" width="100" height="100">

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="text-align: center;margin-top: -14px;margin-bottom: -10px">
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
        let name = document.getElementById("name")
            , salogan = document.getElementById("salogan")
            , male = document.getElementById("male")
            , female = document.getElementById("female")
            , address = document.getElementById("address")
            , deal_in = document.getElementById("deal_in")
            , address = document.getElementById("address"),
            // email = document.getElementById("email"),
            // password = document.getElementById("password"),
            // confirm_password = document.getElementById("confirm_password"),
            enable = document.getElementById("enable")
            , disable = document.getElementById("disable")
            , enable2 = document.getElementById("enable2")
            , disable2 = document.getElementById("disable2")
            , roles = document.getElementById("roles"),

            validateInputIdArray = [
                name.id
                , salogan.id
                , male.id
                , female.id
                , address.id,
                // email.id,
                // password.id,
                // confirm_password.id,
                enable.id
                , disable.id
                , enable2.id
                , disable2.id
                , roles.id
            , ];
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
        if (address.value.length == 15) {
            address.classList.remove('red-border');
        } else {
            address.classList.add('red-border');
            return false;
        }
        if (deal_in.value.length == 12 || deal_in.value.length == 0) {
            deal_in.classList.remove('red-border');
        } else {
            deal_in.classList.add('red-border');
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
            return true;
        } else {
            return false;
        }
    }

    $(document).ready(function() {
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
    jQuery("#brand").change(function() {
        var bra_name_id = $(this).val();

        // var dropDown = document.getElementById('brand');
        // var bra_name_id = dropDown.options[dropDown.selectedIndex].value;

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "{{route('get_category')}}"
            , data: {
                bra_name_id: bra_name_id
            }
            , type: "GET"
            , cache: false
            , dataType: 'json'
            , success: function(data) {

                console.log(data);
                $options = "<option value='' disabled selected>Select Category</option>";
                //
                $.each(data, function(index, value) {
                    $options += "<option value='" + value.cat_id + "'>" + value.cat_name + "</option>";
                });
                jQuery("#category").html(" ");
                jQuery("#category").append($options);
            }
            , error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
                alert(errorThrown);
            }
        });
    });

    jQuery("#category").change(function() {
        var cat_name_id = $(this).val();

        // var dropDown = document.getElementById('brand');
        // var bra_name_id = dropDown.options[dropDown.selectedIndex].value;

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "{{route('get_model')}}"
            , data: {
                cat_name_id: cat_name_id
            }
            , type: "GET"
            , cache: false
            , dataType: 'json'
            , success: function(data) {

                console.log(data);
                $options = "<option value='' disabled selected>Select Model</option>";
                //
                $.each(data, function(index, value) {
                    $options += "<option value='" + value.mod_id + "'>" + value.mod_name + "</option>";
                });
                jQuery("#model").html(" ");
                jQuery("#model").append($options);
            }
            , error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
                alert(errorThrown);
            }
        });
    });

    $('#client_no').blur(function() {
        var deal_in = $('#client_no').val();

        jQuery.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });

        jQuery.ajax({
            url: "{{route('client_exist')}}",
            // url: "client_exist",
            data: {
                deal_in: deal_in
            }
            , type: "GET"
            , cache: false
            , dataType: 'json'
            , success: function(data) {
                console.log(data);
                jQuery("#client_name").val(data['cli_name']);
                jQuery("#client_address").val(data['cli_address']);

            }
            , error: function(jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
                alert(errorThrown);
            }
        });


    });

</script>




<script type="text/javascript">
    function complain_checkForm() {
        let complain = document.getElementById("complain")
            , validateInputIdArray = [
                complain.id
            , ];
        return validateInventoryInputs(validateInputIdArray);
    }

    function accessories_checkForm() {
        let accessories = document.getElementById("accessories")
            , validateInputIdArray = [
                accessories.id
            , ];
        return validateInventoryInputs(validateInputIdArray);
    }

    function validateInventoryInputs(InputIdArray) {
        let i = 0
            , flag = false
            , getInput = '';

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
