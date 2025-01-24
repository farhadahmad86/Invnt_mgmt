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
                        <p class="mb-1">Product Loss</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Stock Movement</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Product Loss</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Product Loss</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Product Loss</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{ route('product_loss.store') }}"
                                    method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xl-6">


                                            <div class="form-group row">
                                                <input type="hidden" name="inv_id" value="{{ $count }}">
                                                <label class="col-lg-4 col-form-label" for="part_name">Part Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">


                                                    {{--                                                    <input type="text" class="form-control" id="part_name" --}}
                                                    {{--                                                           name="part_name" placeholder="Enter a Part Name.."> --}}

                                                    <span id="showStock" style="color: red">(Stock)</span>
                                                    <select id="part_name" name="part_name">
                                                        <option value="0">Select Part</option>
                                                        @foreach ($parts as $account)
                                                            <option value="{{ $account->par_id }}"
                                                                data-stock="{{ $account->par_total_qty }}">
                                                                {{ $account->par_name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="parts_qty">Parts Quantity
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="parts_qty"
                                                        name="parts_qty" placeholder="Enter a Parts Quantity.."
                                                        onkeypress="return numbersOnly(event)">
                                                </div>
                                            </div>

                                            <div class="form-group row">

                                                <label class="col-lg-4 col-form-label" for="qty">Stock Quantity
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input readonly type="number" class="form-control" id="st_qty"
                                                        name="st_qty" placeholder="Enter a Quantity..">
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
            let part_name = document.getElementById("part_name"),
                parts_qty = document.getElementById("parts_qty"),
                validateInputIdArray = [
                    part_name.id,
                    parts_qty.id
                ];

            if (part_name.value == 0) {
                part_name.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            } else {
                part_name.nextSibling.childNodes[0].childNodes[0].style.border = ""
            }

            // return validateInventoryInputs(validateInputIdArray);

            var ok = validateInventoryInputs(validateInputIdArray);

            if (ok) {

                var qty = $("#parts_qty").val();
                var st_qty = $("#st_qty").val();

                if (parseFloat(qty) > parseFloat(st_qty)) {
                    alert("Do not have enough quantity");
                    return false;
                } else {
                    $("button[type='submit']").prop('disabled', true);
                    return true;
                }
            } else {
                return false;
            }
        }
        $(document).ready(function() {
            $("#part_name").select2();
            $(".select2-selection--single").focus();
            $("#category").select2();
            $('#form').validate({ // initialize the plugin

                // rules: {
                //     part_name:{
                //         required: true,
                //         pattern: /^[A-Za-z0-9. ]{3,30}$/
                //     },
                //     parts_qty: {
                //         required: true,
                //
                //     }
                // },
                // messages: {
                //     part_name: {
                //         required: "Required"
                //     },
                //     parts_qty: {
                //         required: "Required",
                //         pattern:"Only Digits"
                //     }
                //
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





        jQuery("#part_name").change(function() {

            var dropDown = document.getElementById('part_name');
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
    <script>
        jQuery("#part_name").change(function() {
            var stock = jQuery('option:selected', this).attr('data-stock');
            $('#showStock').text(`(${stock})`);
        });
    </script>
@stop
