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
                        <p class="mb-1">Issue Parts To Job</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Job Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Issue Parts To Job</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Issue Parts To Job</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->
            <div class="alert alert-danger " style="display: none" id="alert">
                <a href="#" class="close" aria-label="close"
                    onclick="document.getElementById('alert').style.display = 'none';">&times;</a>
                <p style="margin: auto;width: 50%;"><strong>Danger! </strong> Data is empty.</p>
            </div>



            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Issue Parts To Job</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                {{--                                <form class="form-valide" id="form" action="{{route('issue_parts_to_job.store')}}" method="post" onsubmit="return maincheckForm()"> --}}
                                <form class="form-valide" id="form" action="{{ route('issue_parts_to_job.store') }}"
                                    method="post" onsubmit="return check_stock()">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-12">

                                            <div class="form-group row">
                                                <input type="hidden" name="inv_id" value="{{ $count }}">
                                                <label class="col-lg-2 col-form-label" for="select_job">Select Job
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-3">
                                                    <select id="select_job" name="select_job" tabindex="1">
                                                        <option value="0" selected disabled>Select Job</option>
                                                        @foreach ($jobs as $job)
                                                            <option value="{{ $job->job_id }}"
                                                                {{ $job->job_id == $id ? 'selected' : '' }}>
                                                                {{ $job->job_id }}| {{ $job->ji_title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>



                                                <label class="col-lg-2 col-form-label" for="remarks">Remarks <span
                                                        class="text-danger"></span>
                                                </label>
                                                <div class="col-lg-5">
                                                    <textarea class="form-control" id="remarks" tabindex="2" name="remarks" rows="2" placeholder="Remarks"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">

                                                <label class="col-lg-1 col-form-label" for="select_parts">Select Parts
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-2">
                                                    <select id="select_parts" name="select_parts" tabindex="3">
                                                        <option value="0" selected disabled>Select Part</option>
                                                        @foreach ($parts as $part)
                                                            <option value="{{ $part->par_id }}">
                                                                {{ $part->par_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <label class="col-lg-1 col-form-label" for="qty">Quantity
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-2">
                                                    <input type="text" class="form-control" id="qty" name="qty"
                                                        placeholder="Enter a Quantity.." tabindex="4"
                                                        onkeypress="return numbersOnly(event)">
                                                </div>

                                                <label class="col-lg-1 col-form-label" for="qty">Stock Quantity
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-2">
                                                    <input readonly type="number" class="form-control" id="st_qty"
                                                        name="st_qty" placeholder="Enter a Quantity..">
                                                </div>
                                                <label class="col-lg-1 col-form-label" for="issue_against_damage">Parts
                                                    Issue Against Damage
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-2">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="issue_against_damage" name="issue_against_damage">
                                                </div>
                                                <div class="col-lg-1 ml-auto">
                                                    <button type="button" onclick="maincheckForm()" class="btn btn-primary"
                                                        tabindex="5">Add</button>
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
                                                                        <th scope="col">Stock Quantity</th>
                                                                        <th scope="col">Actions</th>

                                                                    </tr>
                                                                </thead>
                                                                <tbody id="table_body">

                                                                </tbody>

                                                            </table>
                                                        </div>
                                                    </div>


                                                    <button type="submit" class="btn btn-primary"
                                                        tabindex="6">Submit</button>

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
            // return validateInventoryInputs(validateInputIdArray);
            if (select_job.value == 0) {
                // alert("dd");
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
                return true;
            } else {
                return false;
            }
        }

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
            var st_qty = $("#st_qty").val();

            if (parseFloat(qty) > parseFloat(st_qty)) {
                alert("Do not have enough quantity");
            } else {
                add_sale_row(counter, parts, qty, parts_name, st_qty);
            }
        }



        function add_sale_row(counter, parts, qty, parts_name, st_qty) {

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
                '<td>' + '<input type="text" onkeypress="return numbersOnly(event)"  name="qty[]" id="qty' + counter +
                '" value="' + qty + '" >' + '</td>' +
                '<td>' + '<input readonly type="text" name="st_qty[]" id="st_qty' + counter + '" value="' + st_qty +
                '">' + '</td>' +

                '<td>' +
                '<span>' +
                '<a href="javascript:void()" onclick="delete_sale(' + counter +
                ')" data-toggle="tooltip" data-placement="top" title="Close"><i class="fa fa-close color-danger"></i></a>' +
                '</span>' +
                '</td>' +

                '</tr>');



            $("#qty").val('');
            $("#select_parts").val('');
            // $("#amount").val('');
            // $("#discount").val('');


        }

        // function check_stock(count){
        //     var qty = $("#qty"+count).val();
        //     var st_qty = $("#st_qty"+count).val();
        //     console.log(qty,st_qty);
        //     if (parseFloat(qty) < parseFloat(st_qty)){
        //
        //         // $("#qty"+count).val("0");
        //         return true;
        //     }
        //     else{
        //         alert("not");
        //         return false;
        //     }
        // }
        function check_stock() {


            if (counter == 0) {
                document.getElementById("alert").style.display = "block";
                return false;
            }

            var disc_percentage = 0;
            var disc_amount = jQuery("#disc_amount").val();

            var count_total = 0;
            var count2_total = 0;
            var qty;
            var pro_code;
            var pro_field_id_title;
            var pro_field_id;

            $('input[name="parts_name[]"]').each(function(pro_index) {
                pro_code = $(this).val();
                pro_field_id_title = $(this).attr('id');
                pro_field_id = pro_field_id_title.match(/\d+/); // 123456

                qty = jQuery("#qty" + pro_field_id).val();
                st_qty = jQuery("#st_qty" + pro_field_id).val();

                // grand_total = +grand_total + +product_amount;
                // item_total = +item_total + +product_quantity;

                if (parseFloat(qty) < parseFloat(st_qty)) {
                    // alert("work");
                    count_total++;
                    // $("#qty"+count).val("0");
                }
                count2_total++;
            });
            console.log(count_total, count2_total);
            if (count_total == count2_total)
                return true;
            else {
                alert("Do not have enough quantity");
                return false;
            }
        }

        function delete_sale(current_item) {
            jQuery("#table_row" + current_item).remove();
        }

        jQuery("#select_parts").change(function() {

            var dropDown = document.getElementById('select_parts');
            var part_id = dropDown.options[dropDown.selectedIndex].value;

            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });

            jQuery.ajax({
                url: "{{ route('get_stock_qty') }}",
                data: {
                    part_id: part_id
                },
                type: "GET",
                cache: false,
                dataType: 'json',
                success: function(data) {

                    // console.log(data);

                    $.each(data, function(index, value) {
                        $options = value.par_total_qty;
                        console.log(value.par_total_qty);

                    });
                    jQuery("#st_qty").val($options);
                    // jQuery("#old_estimate_versions").append($options);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert(jqXHR.responseText);
                    alert(errorThrown);
                }
            });
        });
    </script>
@stop
