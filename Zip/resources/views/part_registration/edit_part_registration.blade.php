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
                        <p class="mb-1">Edit Part Registration</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Part Registration</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Part Registration</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Part Registration</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('part_registration.update',$part->par_id)}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    @method("PUT")
                                    <div class="row">

                                        <div class="col-xl-6">


                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="part_name">Part Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="part_name"
                                                           name="part_name" placeholder="Enter a Part Name.." value="{{$part->par_name}}" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="purchase_price">Purchase Price
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="purchase_price"
                                                           name="purchase_price" placeholder="Enter a Purchase Price.." value="{{$part->par_purchase_price}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="bottom_price">Bottom Price
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="bottom_price"
                                                           name="bottom_price" placeholder="Enter a Bottom Price.." value="{{$part->par_bottom_price}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="retail_price">Retail Price
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="retail_price"
                                                           name="retail_price" placeholder="Enter a Retail Price.." value="{{$part->par_sale_price}}">
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
        function maincheckForm() {
            let part_name = document.getElementById("part_name"),
                purchase_price = document.getElementById("purchase_price"),
                bottom_price = document.getElementById("bottom_price"),
                retail_price = document.getElementById("retail_price"),
                validateInputIdArray = [
                    part_name.id,
                    purchase_price.id,
                    bottom_price.id,
                    retail_price.id,
                ];

            if (parseFloat(purchase_price.value) > parseFloat(bottom_price.value)) {
                document.getElementById("alert").style.display = "block";
                return false;
            }
            if (parseFloat(bottom_price.value) > parseFloat(retail_price.value)) {
                document.getElementById("alert2").style.display = "block";
                return false;
            }


            // return validateInventoryInputs(validateInputIdArray);

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
        $(document).ready(function () {

            // $('#form').validate({ // initialize the plugin
            //
            //     rules: {
            //
            //         part_name:{
            //             required: true,
            //             pattern: /^[A-Za-z0-9. ]{3,30}$/
            //         },
            //         purchase_price: {
            //             required: true,
            //             pattern:/^(\d+(,\d{1,2})?)?$/
            //         },
            //         bottom_price:{
            //             required: true,
            //             pattern:/^(\d+(,\d{1,2})?)?$/
            //         },
            //         retail_price:{
            //             required: true,
            //             pattern:/^(\d+(,\d{1,2})?)?$/
            //         }
            //     },
            //     messages: {
            //
            //         part_name: {
            //             required: "Required"
            //         },
            //         purchase_price: {
            //             required: "Required",
            //             pattern:"Only Digits"
            //         },
            //         bottom_price: {
            //             required: "Required",
            //             pattern:"Only Digits"
            //
            //         },
            //         retail_price: {
            //             required: "Required",
            //             pattern:"Only Digits"
            //         }
            //
            //
            //     },
            //
            //     ignore: [],
            //     errorClass: "invalid-feedback animated fadeInUp",
            //     errorElement: "div",
            //     errorPlacement: function (e, a) {
            //         jQuery(a).parents(".form-group > div").append(e)
            //     },
            //     highlight: function (e) {
            //         jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
            //     },
            //     success: function (e) {
            //         jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
            //     },
            //
            // });

        });
    </script>
@stop
