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
                        <p class="mb-1">Edit Job Transfer</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Transfer</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Job Transfer</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Job Transfer</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('job_transfer.update', $job_transfer->jt_id)}}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">

                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="job_no">Job Number
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="job_no" name="job_no">
                                                        <option value="0">Select Job</option>
                                                        @foreach($job_num as $job_no)
                                                            <option value="{{$job_no->ji_id}}" {{ $job_transfer->jt_job_no == $job_no->ji_id ? 'selected="selected"':'' }}>
                                                                {{$job_no->ji_id}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="old_tech">Old Technician
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="old_tech" name="old_tech">
                                                        <option value="0">Select Job</option>
                                                        @foreach($old_technicians as $oldtechnician)
                                                            <option value="{{$oldtechnician->tech_id}}" {{ $job_transfer->jt_technician == $oldtechnician->tech_id ? 'selected="selected"':'' }}>
                                                                {{$oldtechnician->tech_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="new_tech">New Technician
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <select id="new_tech" name="new_tech">
                                                        <option value="0">Select Job</option>
                                                        @foreach($new_technicians as $newtechnician)
                                                            <option value="{{$newtechnician->tech_id}}" {{ $job_transfer->jt_new_technician == $newtechnician->tech_id ? 'selected="selected"':'' }}>
                                                                {{$newtechnician->tech_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
            $("#job_no").select2();
            $("#old_tech").select2();
            $("#new_tech").select2();
            $('#form').validate({ // initialize the plugin

                rules: {
                    job_no: {
                        required: true,
                    },
                    old_tech: {
                        required: true,
                    },
                    new_tech: {
                        required: true,
                    }
                },
                messages: {
                    job_no: {
                        required: "Required"
                    },
                    old_tech: {
                        required: "Required"
                    },
                    new_tech: {
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
