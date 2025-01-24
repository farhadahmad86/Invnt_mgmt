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
                                <form class="form-valide" id="form" action="{{ route('estimate_versions.store') }}"
                                    method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label">Operation<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-8">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="operation"
                                                            id="increaseRadio" value="increase"
                                                            onclick="showField('add_estimate_versions')">
                                                        <label class="form-check-label" for="increaseRadio">Increase</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="operation"
                                                            id="decreaseRadio" value="decrease"
                                                            onclick="showField('subtract_estimate_versions')">
                                                        <label class="form-check-label" for="decreaseRadio">Decrease</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="job_no" style="display:none;">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="select_job">Selected Job
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <select id="select_job" name="select_job" tabindex="1">
                                                            <option value="0">Select Job</option>
                                                            @foreach ($job_num as $job_no)
                                                                <option value="{{ $job_no->job_id }}">
                                                                    {{ $job_no->job_id }}| {{ $job_no->ji_title }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="old_estimate" style="display:none;">
                                                <div class="form-group row">
                                                    <label class="col-lg-4 col-form-label" for="old_estimate_versions">Old
                                                        Estimate Versions
                                                        <span class="text-danger">*</span>
                                                    </label>
                                                    <div class="col-lg-8">
                                                        <input readonly type="text" class="form-control"
                                                            id="old_estimate_versions" name="old_estimate_versions"
                                                            placeholder="Enter a Old Estimate Versions..">
                                                    </div>
                                                </div>
                                            </div>
                                                <div id="addEstimateVersionsField" style="display:none;">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label"
                                                            for="add_estimate_versions">Add
                                                            Estimate
                                                            Versions<span class="text-danger">*</span></label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control"
                                                                id="add_estimate_versions" name="add_estimate_versions"
                                                                placeholder="Enter a Add Estimate Versions.." tabindex="2"
                                                                onkeypress="return numbersOnly(event)">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div id="subtractEstimateVersionsField" style="display:none;">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label"
                                                            for="subtract_estimate_versions">Subtract
                                                            Estimate Versions<span class="text-danger">*</span></label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control"
                                                                id="subtract_estimate_versions"
                                                                name="subtract_estimate_versions"
                                                                placeholder="Enter a Subtract Estimate Versions.."
                                                                tabindex="2" onkeypress="return numbersOnly(event)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="new_estimate" style="display:none;">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label"
                                                            for="new_estimate_versions">New
                                                            Estimate Versions
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control"
                                                                id="new_estimate_versions" readonly
                                                                name="new_estimate_versions"
                                                                placeholder="Enter a New Estimate Versions.."
                                                                tabindex="2" onkeypress="return numbersOnly(event)">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="reasons" style="display:none;">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="reason">Reason
                                                            <span class="text-danger">*</span>
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <input type="text" class="form-control" id="reason"
                                                                name="reason" placeholder="Enter a Reason.."
                                                                tabindex="3">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="remark" style="display:none;">
                                                    <div class="form-group row">
                                                        <label class="col-lg-4 col-form-label" for="remarks">Remarks
                                                            <span class="text-danger"></span>
                                                        </label>
                                                        <div class="col-lg-8">
                                                            <textarea class="form-control" id="remarks" name="remarks" rows="5" placeholder="Remarks" tabindex="4"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-8 ml-auto">
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
        function showField(fieldName) {
            if (fieldName === 'add_estimate_versions') {
                document.getElementById('addEstimateVersionsField').style.display = 'block';
                document.getElementById('job_no').style.display = 'block';
                document.getElementById('old_estimate').style.display = 'block';
                document.getElementById('new_estimate').style.display = 'block';
                document.getElementById('reasons').style.display = 'block';
                document.getElementById('remark').style.display = 'block';
                document.getElementById('subtractEstimateVersionsField').style.display = 'none';
            } else if (fieldName === 'subtract_estimate_versions') {
                document.getElementById('addEstimateVersionsField').style.display = 'none';
                document.getElementById('subtractEstimateVersionsField').style.display = 'block';
            }
        }
    </script>

    <script>
        function maincheckForm() {
            let select_job = document.getElementById("select_job"),
                old_estimate_versions = document.getElementById("old_estimate_versions"),
                new_estimate_versions = document.getElementById("new_estimate_versions"),
                reason = document.getElementById("reason"),
                validateInputIdArray = [
                    select_job.id,
                    old_estimate_versions.id,
                    new_estimate_versions.id,
                    reason.id,
                ];
            // return validateInventoryInputs(validateInputIdArray);
            if (select_job.value == 0) {
                select_job.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            } else {
                select_job.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }
            if (old_estimate_versions.value == new_estimate_versions.value) {
                document.getElementById("alert").style.display = "block";
                return false
            }


            var ok = validateInventoryInputs(validateInputIdArray);

            if (ok) {
                // if (counter == 0) {
                //     $("#complain").addClass('bg-danger');
                //     return false;
                // } else if (counter2 == 0) {
                //     $("#accessories").addClass('bg-danger');
                //     return false;
                // } else {
                // }
                $("button[type='submit']").prop('disabled', true);
                    return true;
            } else {
                return false;
            }
        }
        $(document).ready(function() {

            // $("#job_re_open").select2();
            $("#select_job").select2();
            $(".select2-selection--single").focus();
            $('#form').validate({ // initialize the plugin

                rules: {
                    select_job: {
                        // required: true,
                    },
                    old_estimate_versions: {
                        // required: true,
                        // pattern: /^[A-Za-z0-9. ]{3,30}$/
                    },
                    new_estimate_versions: {
                        // required: true,
                        // pattern: /^[A-Za-z0-9. ]{3,30}$/
                    },
                    reason: {
                        // required: true,
                        // pattern: /^[A-Za-z0-9. ]{3,30}$/
                    }

                },

                messages: {
                    select_job: {
                        // required: "Required"
                    },
                    old_estimate_versions: {
                        // required: "Required"
                    },
                    new_estimate_versions: {
                        // required: "Required"
                    },
                    reason: {
                        // required: "Required"
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


        jQuery("#select_job").change(function() {

            var dropDown = document.getElementById('select_job');
            var bra_name_id = dropDown.options[dropDown.selectedIndex].value;

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('get_estimate') }}",
                data: {
                    bra_name_id: bra_name_id
                },
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(data) {

                    console.log(data);

                    $.each(data, function(index, value) {
                        $options = value.ji_estimated_cost;
                    });
                    jQuery("#old_estimate_versions").val($options);
                    // jQuery("#old_estimate_versions").append($options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });
        });
        $("#add_estimate_versions").keyup(function() {
            // alert("work")
            var old = parseFloat(document.getElementById("old_estimate_versions").value);
            var add = parseFloat(document.getElementById("add_estimate_versions").value);
            var news = old + add;
            $("#new_estimate_versions").val(news);

        });
        // farhad add
        $("#subtract_estimate_versions").keyup(function() {
            // alert("work")
            var old = parseFloat(document.getElementById("old_estimate_versions").value);
            var add = parseFloat(document.getElementById("subtract_estimate_versions").value);
            var news = old - add;
            $("#new_estimate_versions").val(news);

        });
    </script>
@stop
