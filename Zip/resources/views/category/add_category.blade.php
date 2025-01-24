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
                        <p class="mb-1">Category</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Category</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('store_category')}}" method="post" onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row" style="margin-top: 20px">
                                                <label class="col-lg-4 col-form-label" for="bra_name">Brand Name
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <div class="icons" style="top: -25px">
                                                        <a href="{{asset("add_brand")}}" style="color:black" target="_blank"><l class="fa fa-plus iconsl"></l></a>
                                                        <l id="bra_refresh" class="fa fa-refresh iconsl" style="cursor: pointer;"></l>
                                                    </div>
                                                    <select id="bra_name" name="bra_name" class="form-select" required autofocus>
                                                        <option value=0>Select Brand</option>
                                                        @foreach($brands as $account)
                                                            <option value="{{$account->bra_id}}">
                                                                {{$account->bra_name}}</option>
                                                        @endforeach


                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="cat_name">Category Name (Kv/Kw)
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="cat_name"
                                                           name="cat_name" placeholder="Enter a Category..">
                                                </div>
                                            </div>

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

            let bra_name = document.getElementById("bra_name");
            // if (bra_name.value == 0) {
            //     bra_name.value= '';
            //         };
            let cat_name = document.getElementById("cat_name");

            let    validateInputIdArray = [
                    bra_name.id,
                    cat_name.id
                ];
            // return validateInventoryInputs(validateInputIdArray);
            if (bra_name.value == 0) {
                bra_name.nextSibling.childNodes[0].childNodes[0].style.border = "1px solid red"
                return false;
            }
            else{
                bra_name.nextSibling.childNodes[0].childNodes[0].style.border = ""
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
            $("#bra_name").select2();
            $(".select2-selection--single").focus();
            // $('#form').validate({ // initialize the plugin
            //
            //     rules: {
            //         bra_name:{
            //             // required: true,
            //         },
            //         cat_name: {
            //             // required: true,
            //             pattern: /^[A-Za-z0-9. ]{1,30}$/
            //         }
            //     },
            //     messages: {
            //         bra_name: {
            //             // required: "Required"
            //         },
            //         cat_name: {
            //             // required: "Required"
            //         }
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



        jQuery("#bra_refresh").click(function () {

                    var bra_name_id =$(this).val();

                    jQuery.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    jQuery.ajax({
                        url: "{{route('get_brand')}}",
                        data: {bra_name_id: bra_name_id},
                        type: "GET",
                        cache: false,
                        dataType: 'json',
                        success: function (data) {

                            console.log(data);
                            $options = "<option value='' disabled selected>Select Model</option>";
                            $.each(data,function (index, value) {
                                $options += "<option value='" + value.bra_id + "'>" + value.bra_name + "</option>";
                            });
                            jQuery("#bra_name").html(" ");
                            jQuery("#bra_name").append($options);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            alert(jqXHR.responseText);
                            alert(errorThrown);
                        }
                    });
                });



    </script>


@stop
