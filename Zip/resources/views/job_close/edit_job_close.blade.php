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
                        <p class="mb-1">Edit Job Close</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Close</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Job Close</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Job Close</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('job_close.update', $job_close->jc_id)}}" method="post">
{{--                                <form method="POST" action="{{action('JobCloseController@update', $job_close->jc_id)}}">--}}
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="job_close_reason">Job Close Reason
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="job_close_reason" name="job_close_reason">
                                                        <option value="0">Select Reason</option>
                                                        @foreach($reasons as $account)
                                                            <option value="{{$account->jcr_id}}" {{ $job_close->jc_reason == $account->jcr_id ? 'selected="selected"':'' }}
                                                            >{{$account->jcr_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="select_job">Select Job
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="select_job" name="select_job">
                                                        <option value="0">Select Job</option>
                                                        @foreach($select_job as $account)
                                                            <option value="{{$account->ji_id}}" {{ $job_close->jc_job_no == $account->ji_id ? 'selected="selected"':'' }}>
                                                                {{$account->ji_id}}
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
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="5" placeholder="Remarks">{{$job_close->jc_remarks}}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary">Update</button>
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
        $(document).ready(function () {
            $('#job_close_reason').select2();
            $('#select_job').select2();
            $('#form').validate({ // initialize the plugin

                rules: {
                    job_close_reason: {
                        required: true,

                    },
                    select_job: {
                        required: true,
                    }


                },
                messages: {
                    job_close_reason: {
                        required: "Required"
                    },
                    select_job:{
                        required: "Required"
                    },

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
