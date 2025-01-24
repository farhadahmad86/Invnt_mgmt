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
                        <p class="mb-1">Job Hold</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Hold</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Job Hold</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Job Hold</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('job_hold.store')}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="select_job">Select Job
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="select_job" name="select_job">
                                                        <option value="0">Select Job</option>
                                                        @foreach($job_num as $job_no)
                                                            <option value="{{$job_no->job_id}}">
                                                                {{$job_no->job_id}}| {{$job_no->ji_title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        <div class="form-group row">
                                            <label class="col-lg-4 col-form-label" for="select_reason">Select Reason
                                                <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-8">
                                                <select id="select_reason" name="select_reason">
                                                    <option value="0">Select Reason</option>
                                                    @foreach($reasons as $account)
                                                        <option value="{{$account->jhr_id}}"
                                                        >{{$account->jhr_name}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="remarks">Remarks <span
                                                        class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="5" placeholder="Remarks"></textarea>
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
                    let select_job = document.getElementById("select_job"),
                    select_reason = document.getElementById("select_reason"),
                    validateInputIdArray = [
                        select_job.id,
                            select_reason.id
                        ];

                    if (select_job.value == 0) {
                        select_job.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            }
            else{
                select_job.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }
            if (select_reason.value == 0) {
                select_reason.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            }
            else{
                select_reason.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }

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
                    }
                    else{
                        return false;
                    }
        }
        $(document).ready(function () {
            $("#select_job").select2();
            $(".select2-selection--single").focus();
            $("#select_reason").select2();
            $('#form').validate({ // initialize the plugin

                rules: {
                    select_job: {
                        required: true,
                    },
                    select_reason: {
                        required: true,
                    }

                },
                messages: {
                    select_job: {
                        required: "Required"
                    },
                    select_reason: {
                        required: "Required"
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
