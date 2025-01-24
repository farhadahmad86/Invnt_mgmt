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
                        <p class="mb-1">Job Transfer</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Transfer</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Job Transfer</a></li>
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
                                <form class="form-valide" id="form" action="{{route('job_transfer.store')}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
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
                                                            <option value="{{$job_no->job_id}}">
                                                                {{$job_no->job_id}}| {{$job_no->ji_title}}
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
                                                        <option value="0">Old Technician</option>
                                                        @foreach($old_technicians as $oldtechnician)
                                                            <option value="{{$oldtechnician->tech_id}}">
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
                                                        <option value="0">Select New Technician</option>
                                                        @foreach($new_technicians as $newtechnician)
                                                            <option value="{{$newtechnician->tech_id}}">
                                                                {{$newtechnician->tech_name}}
                                                            </option>
                                                        @endforeach
                                                    </select>
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
                    old_tech = document.getElementById("old_tech"),
                    new_tech = document.getElementById("new_tech"),
                    validateInputIdArray = [
                        job_no.id,
                        old_tech.id,
                        new_tech.id
                        ];
                    // return validateInventoryInputs(validateInputIdArray);
                    if (job_no.value == 0) {
                        job_no.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                        return false;
                    }
                    else{
                        job_no.nextSibling.childNodes[0].childNodes[0].style.border = ""
                    }
                    if (old_tech.value == 0) {
                        old_tech.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                        return false;
                    }
                    else{
                        old_tech.nextSibling.childNodes[0].childNodes[0].style.border = ""
                    }
                    if (new_tech.value == 0) {
                        new_tech.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                        return false;
                    }
                    else{
                        new_tech.nextSibling.childNodes[0].childNodes[0].style.border = ""
                    }

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
            $("#job_no").select2();
            $(".select2-selection--single").focus();
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


        jQuery("#job_no").change(function () {

            var dropDown = document.getElementById('job_no');
            var bra_name_id = dropDown.options[dropDown.selectedIndex].value;

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{route('get_old_technision')}}",
                data: {bra_name_id: bra_name_id},
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function (data) {

                    console.log(data);
                    // $options = "<option value='' disabled selected>Select Category</option>";
                    //
                    var val;
                    $.each(data,function (index, value) {
                        $options = "<option value='" + value.tech_id + "'>" + value.tech_name + "</option>";
                        val = value.tech_id;
                    });
                    jQuery("#old_tech").html(" ");
                    jQuery("#old_tech").append($options);
                    jQuery("#new_tech option[value=" + val + "]").attr("disabled", "true");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });
        });


    </script>
@stop
