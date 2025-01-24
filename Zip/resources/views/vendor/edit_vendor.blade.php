@extends('layouts.theme')

@section('content')
    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-1">Vendor</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Vendor</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Vendor</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Vendor</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('update_vendor', $vendor->vendor_id)}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
{{--                                    @method('PUT')--}}
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="vendor">Vendor
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="vendor"
                                                           name="vendor" placeholder="Vendor.."  value="{{ $vendor->vendor_name }}" onkeypress="return lettersOnly(event)" autofocus>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
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

            let vendor = document.getElementById("vendor")
            validateInputIdArray = [
                vendor.id
            ];
// return validateInventoryInputs(validateInputIdArray);

            var ok = validateInventoryInputs(validateInputIdArray);

            if(ok){

                // if(counter == 0){
                //     $("#complain").addClass('bg-danger');
                //     return false;
                // }
                // else if(counter2 == 0){
                //     $("#accessories").addClass('bg-danger');
                //     return false;
                // }else{
                // }
                $("button[type='submit']").prop('disabled', true);
                return true;
            }else{
                return false;
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
        $(document).ready(function () {
            $('#form').validate({ // initialize the plugin

                rules: {
                    vendor: {
                        // required: true,
                        // pattern: /^[A-Za-z0-9. ]{3,30}$/
                    }
                },
                messages: {
                    vendor: {
                        // required: "Required"
                    }

                },

                ignore: [],
                errorClass: "invalid-feedback animated fadeInUp",
                errorElement: "div",
                errorPlacement: function (e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function (e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function (e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },

            });

        });
    </script>
@stop
