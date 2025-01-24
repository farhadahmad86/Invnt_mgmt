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
                        <p class="mb-1">Estimate Versions</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Estimate Versions</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Estimate Versions</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->

            <div class="alert alert-danger " style="display: none" id="alert">
                <a href="#" class="close" aria-label="close"
                    onclick="document.getElementById('alert').style.display = 'none';">&times;</a>
                <p style="margin: auto;width: 50%;"><strong>Danger!</strong> New estimate version not be equal to old
                    estimate version.</p>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Estimate Versions</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{ route('job_delivery_save') }}"
                                    method="post">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-6">
                                            <div id="job_no">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="select_job">Selected Job
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-4">
                                                        <select id="select_job" name="select_job" tabindex="1">
                                                            <option disabled selected>Select Job</option>
                                                            @foreach ($job_num as $job_no)
                                                                <option value="{{ $job_no->job_id }}"
                                                                    {{ $job_no->job_id == $id ? 'selected' : '' }}>
                                                                    {{ $job_no->job_id }}| {{ $job_no->ji_title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <label class="col-lg-2 col-form-label" for="delivered">Delivered
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-2">
                                                        <input class="form-check-input" type="checkbox" id="delivered"
                                                            name="delivered">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8">
                                                    <button type="submit" class="btn btn-primary"
                                                        tabindex="5">Save</button>
                                                </div>
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
        // function maincheckForm() {
        //     let select_job = document.getElementById("select_job"),
        //     delivered = document.getElementById("delivered"),
        //         validateInputIdArray = [
        //             select_job.id,
        //             delivered.id,
        //         ];
        //     // return validateInventoryInputs(validateInputIdArray);
        //     if (select_job.value == 0) {
        //         select_job.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
        //         return false;
        //     } else {
        //         select_job.nextSibling.childNodes[0].childNodes[0].style.border = ""
        //     }
        // }
        $(document).ready(function() {

            // $("#job_re_open").select2();
            $("#select_job").select2();
            $(".select2-selection--single").focus();
            $('#form').validate({ // initialize the plugin

                rules: {
                    select_job: {
                        required: true,
                    },
                    delivered: {
                        required: true,
                        // pattern: /^[A-Za-z0-9. ]{3,30}$/
                    }

                },

                messages: {
                    select_job: {
                        required: "Required"
                    },
                    delivered: {
                        required: "Required"
                    }
                },

                ignore: [],
                errorClass: "invalid-feedback animated fadeInUp",
                errorElement: "div",
                errorPlacement: function(e, a) {
                    jQuery(a).parents(".form-group > div").append(e)
                },
                highlight: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
                },
                success: function(e) {
                    jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
                },

            });

        });
    </script>
@stop
