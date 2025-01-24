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
                        <p class="mb-1">Job Issue To Technician</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Issue To Technician</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Job Issue To Technician</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Job Issue To Technician</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('job_issue_to_technician.store')}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="job_no">Job
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="job_no" name="job_no">
                                                        <option value=0>Select Job</option>
                                                        @foreach($job_num as $job_no)
                                                            <option value="{{$job_no->job_id}}"
                                                                {{$job_no->job_id == $id ? 'selected' : '' }}>
                                                            {{$job_no->job_id}} | {{$job_no->ji_title}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <divl class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="technician">Technician
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="technician" name="technician">
                                                        <option value=0 >Select Job</option>
                                                        @foreach($technicians as $technician)
                                                            <option value="{{$technician->tech_id}}">
                                                            {{$technician->tech_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </divl>



                                            <div class="form-group row" style="display: none">
                                                <label class="col-lg-4 col-form-label" for="remarks">Remarks <span
                                                        class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="5" placeholder="Remarks"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary">Assign</button>
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
                    let job_no = document.getElementById("job_no"),
                    technician = document.getElementById("technician"),
                    validateInputIdArray = [
                        job_no.id,
                        technician.id,
                        ];
                    if (job_no.value == "0") {
                        job_no.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                        return false;
            }
            else{
                job_no.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }
            if (technician.value == "0") {
                technician.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            }
            else{
                technician.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }

                    // return validateInventoryInputs(validateInputIdArray);

                    var ok = validateInventoryInputs(validateInputIdArray);

                    if(ok){
                        if(counter == 0){
                            $("#complain").addClass('bg-danger');
                            return false;
                        }
                        else if(counter2 == 0){
                            $("#accessories").addClass('bg-danger');
                            return false;
                        }else{
                            return true;
                        }
                    }
                    else{
                        return false;
                    }
        }





        $(document).ready(function () {
            $("#job_no").select2();
            $(".select2-selection--single").focus();
            $("#technician").select2();
            $('#form').validate({ // initialize the plugin

                rules: {
                    job_no: {
                        required: true,
                    },
                    technician: {
                        required: true,
                    }
                },
                messages: {
                    job_no: {
                        required: "Required"
                    },
                    technician: {
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
