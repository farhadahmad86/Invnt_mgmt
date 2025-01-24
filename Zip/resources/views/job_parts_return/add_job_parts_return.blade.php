@extends('layouts.theme')

@section('content')


    <style>
        button,
        input {
            overflow: visible;
            border: none;
        }
    </style>


    <!--**********************************
                Content body start
            ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Hi, welcome back!</h4>
                        <p class="mb-1">Job Part Return</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Part Return</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Job Part Return</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->
            <div class="alert alert-danger " style="display: none" id="alert">
                <a href="#" class="close" aria-label="close"
                    onclick="document.getElementById('alert').style.display = 'none';">&times;</a>
                <p style="margin: auto;width: 50%;"><strong>Danger!</strong> Data is empty.</p>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Job Part Return</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{ route('job_parts_return.store') }}"
                                    method="post" onsubmit="return check()">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">

                                            <div class="form-group row">
                                                <input type="hidden" name="inv_id" value="{{$count}}">
                                                <label class="col-lg-2 col-form-label" for="select_job">Select Job
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-3">
                                                    <select id="select_job" name="select_job">
                                                        <option value="0">Select Job</option>
                                                        @foreach ($jobs as $job)
                                                            <option value="{{ $job->job_id }}">
                                                                {{ $job->job_id }}| {{ $job->ji_title }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>



                                                <label class="col-lg-2 col-form-label" for="remarks">Remarks <span
                                                        class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-5">
                                                    <textarea class="form-control" id="remarks" name="remarks" rows="2" placeholder="Remarks"></textarea>
                                                </div>
                                            </div>



                                            <div class="form-group row">
                                                <label class="col-lg-2 col-form-label" for="select_parts">Select Parts
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-3">
                                                    <select id="select_parts" name="select_parts">
                                                        {{-- <option value="0">Select Part</option>
                                                        @foreach ($parts as $part)
                                                            <option value="{{$part->par_id}}">
                                                                {{$part->par_name}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>

                                                <label class="col-lg-2 col-form-label" for="qty">Quantity
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-3">
                                                    <input type="text" class="form-control" id="qty" name="qty"
                                                        placeholder="Enter a Quantity.."
                                                        onkeypress="return numbersOnly(event)">
                                                </div>

                                                <div class="col-lg-2 ml-auto">
                                                    <button type="button" onclick="maincheckForm()"
                                                        class="btn btn-primary">Add</button>
                                                </div>
                                            </div>


                                            <div class="form-group row">

                                                <div class="col-lg-12">

                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table
                                                                class="table table-bordered verticle-middle table-responsive-sm">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">S#</th>
                                                                        <th scope="col">Part Name</th>
                                                                        <th scope="col">Part Quantity</th>
                                                                        <th scope="col">Actions</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody id="table_body">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>


                                                    <button type="submit" class="btn btn-primary">Submit</button>

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
                select_parts = document.getElementById("select_parts"),
                qty = document.getElementById("qty"),
                validateInputIdArray = [
                    select_job.id,
                    select_parts.id,
                    qty.id
                ];
            // remove_opt(select_parts.options[select_parts.selectedIndex].text);
            // return validateInventoryInputs(validateInputIdArray);
            if (select_job.value == 0) {
                select_job.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            } else {
                select_job.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }
            if (select_parts.value == 0) {
                select_parts.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            } else {
                select_parts.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }

            var ok = validateInventoryInputs(validateInputIdArray);

            if (ok) {
                add_sale();
                // alert();
                if (counter == 0) {
                    $("#complain").addClass('bg-danger');
                    return false;
                } else if (counter2 == 0) {
                    $("#accessories").addClass('bg-danger');
                    return false;
                } else {
                    return true;
                }
            } else {
                return false;
            }
        }
        jQuery("#select_job").change(function() {

            var dropDown = document.getElementById('select_job');
            // alert(dropDown)
            var job_id = dropDown.options[dropDown.selectedIndex].value;

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('get_parts') }}",
                data: {
                    job_id: job_id
                },
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(data) {

                    console.log(data);

                    $options = '<option value="0">Select Part</option>';
                    $.each(data.parts_items, function(index, value) {
                        $options += `<option value="${value.par_id}">${value.par_name}</option>`;
                    });
                    // jQuery("#select_parts").val($options);
                    jQuery("#select_parts").html($options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });
        });
        // setInterval(abc,0);
        // $("li:contains(val)").hide()
        // function remove_opt(val) {
        // alert("word");

        // function abc(){}
        // while (true){
        //     remove_opt(val);
        // }
        // }
        $(document).ready(function() {
            $("#select_job").select2();
            $(".select2-selection--single").focus();
            $("#select_parts").select2();


            $('#form').validate({ // initialize the plugin

                // rules: {
                //     select_job: {
                //         required: true,
                //     },
                //     qty: {
                //         required: true,
                //     },
                //     select_parts: {
                //         required: true,
                //     }
                // },
                // messages: {
                //     select_job: {
                //         required: "Required"
                //     },
                //     qty: {
                //         required: "Required"
                //     },
                //     select_parts: {
                //         required: "Required"
                //     }
                //
                // },

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


        var counter = 0;

        function add_sale() {

            counter++;

            // alert("sale");
            var parts = document.getElementById('select_parts');
            var parts_name = parts.options[parts.selectedIndex].text;





            var qty = $("#qty").val();


            add_sale_row(counter, parts, qty, parts_name);

        }

        function add_sale_row(counter, parts, qty, parts_name) {



            jQuery("#select_parts option[value=" + parts.value + "]").attr("disabled", "true");
            jQuery("#select_parts").select2("destroy");
            jQuery("#select_parts").select2();


            jQuery("#table_body").append(

                '<tr id="table_row' + counter + '">' +
                '<td>' + counter + '</td>' +

                '<td hidden>' + '<input type="text" name="parts[]" id="parts' + counter + '" value="' + parts.value +
                '">' + '</td>' +
                '<td>' + '<input readonly type="text" name="parts_name[]" id="parts_name' + counter + '" value="' +
                parts_name + '">' + '</td>' +
                '<td>' + '<input type="text" onkeypress="return numbersOnly(event)" name="qty[]" id="qty' + counter +
                '" value="' + qty + '">' + '</td>' +

                '<td>' +
                '<span>' +
                '<a href="javascript:void()" onclick="delete_sale(' + counter +
                ')" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a>' +
                '</span>' +
                '</td>' +

                '</tr>');



            $("#qty").val('');
            $("#rate").val('');
            $("#amount").val('');
            $("#discount").val('');

        }

        function delete_sale(current_item) {
            jQuery("#table_row" + current_item).remove();
        }

        function check() {
            if (counter == 0) {
                return false;
            }
            $("button[type='submit']").prop('disabled', true);
            return true;
        }
    </script>
@stop
