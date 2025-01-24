@extends('layouts.theme')

@section('content')

    <style>

        .row ul {
            list-style: none;
            margin: 5px 40px;
        }

        /*.row li {*/
        /*    margin: 10px 0;*/
        /*}*/


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
                        <p class="mb-1">Roles</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Roles</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Create Roles</a></li>
                    </ol>
                </div>
            </div>
        @include('inc._message')
        <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Form Roles</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-validation">
                                <form class="form-valide" id="form" action="{{route('roles.store')}}" method="post"
                                      onsubmit="return maincheckForm()">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-6">
                                            <div class="form-group row">
                                                <label class="col-lg-4 col-form-label" for="roles">Roles
                                                    <span class="text-danger">*</span>
                                                </label>
                                                <div class="col-lg-8">
                                                    <input type="text" class="form-control" id="roles"
                                                           name="roles" placeholder="Role Name.."
                                                           onkeypress="return lettersOnly(event)" autofocus>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-lg-8 ml-auto">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group row">


                                                {{--                                                <ul>--}}

                                                {{--                                                    <li><input type="checkbox"> Item 1--}}

                                                {{--                                                    <ul>--}}
                                                {{--                                                        <li><input type="checkbox"> Sub Item 1.1--}}
                                                {{--                                                            <ul>--}}
                                                {{--                                                                <li><input type="checkbox"> Sub Item 1.1.1</li>--}}
                                                {{--                                                                <li><input type="checkbox"> Sub Item 1.1.1</li>--}}
                                                {{--                                                                <li><input type="checkbox"> Sub Item 1.1.1</li>--}}

                                                {{--                                                            </ul>--}}

                                                {{--                                                        </li>--}}
                                                {{--                                                        <li><input type="checkbox"> Sub Item 1.1</li>--}}
                                                {{--                                                        <li><input type="checkbox"> Sub Item 1.1</li>--}}

                                                {{--                                                    </ul>--}}

                                                {{--                                                    </li>--}}


                                                {{--                                                    <li><input type="checkbox"> Item 2--}}

                                                {{--                                                        <ul>--}}
                                                {{--                                                            <li><input type="checkbox"> Sub Item 2.1</li>--}}
                                                {{--                                                            <li><input type="checkbox"> Sub Item 2.1</li>--}}
                                                {{--                                                            <li><input type="checkbox"> Sub Item 2.1</li>--}}

                                                {{--                                                        </ul>--}}

                                                {{--                                                    </li>--}}


                                                {{--                                                </ul>--}}



{{--                                                prvious--}}
{{--                                                @php--}}
{{--                                                    $counter = 1;--}}
{{--                                                @endphp--}}


{{--                                                <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                                                    <div class="form-group">--}}
{{--                                                        <strong>Permission:</strong>--}}
{{--                                                        <br/>--}}

{{--                                                        <ul>--}}



{{--                                                            @foreach($permission as $value)--}}

{{--                                                                @if($value->parent != 0)--}}

{{--                                                        </ul>--}}
{{--                                                        </li>--}}


{{--                                                        @endif--}}


{{--                                                                @if($value->parent == $counter)--}}
{{--                                                                    <li><input type="checkbox"> Registration--}}
{{--                                                                        <ul>--}}
{{--                                                                            @php--}}
{{--                                                                                $counter++;--}}
{{--                                                                            @endphp--}}
{{--                                                                @endif--}}

{{--                                                                            <li>--}}
{{--                                                                            <div class="col-md-4">--}}
{{--                                                                                <div class="form-check">--}}
{{--                                                                                    <input class="form-check-input"--}}
{{--                                                                                           type="checkbox"--}}
{{--                                                                                           value="{{$value->id}}"--}}
{{--                                                                                           id="permission"--}}
{{--                                                                                           name="permission[]">--}}
{{--                                                                                    <label class="form-check-label"--}}
{{--                                                                                           for="work_status">--}}
{{--                                                                                        {{ $value->name }}--}}
{{--                                                                                    </label>--}}
{{--                                                                                </div>--}}
{{--                                                                            </div>--}}
{{--                                                                            </li>--}}




{{--                                                                                        @endforeach--}}

{{--                                                                        </ul>--}}

{{--                                                    </div>--}}
{{--                                                </div>--}}



{{--                                                latest--}}
                                                <ul>
{{--                                                    <strong style="color: #0b5ed7"> <input type="checkbox" name="checkedAll" id="checkedAll"/>--}}
{{--                                                        Check All </strong>--}}
{{--                                                    <br/>--}}

                                                    @php $counter = 0; @endphp
                                                    @foreach($permission as $value)

                                                        <li><input type="checkbox" id="main_li[{{$counter}}]"
                                                                   class="name checkSingle" name="permission[]" value="{{ $value->id }}"
                                                                   > <span onclick="display_li({{$counter}})">{{ $value->name }}</span>

                                                            <div id="li-div[{{$counter}}]" style="display: none">
                                                                <ul>
                                                                    @foreach($permissions as $values)
                                                                        @if($value->code==$values->parent)

                                                                            <li><input type="checkbox" value="{{ $values->id }}"
                                                                                       class="name checkSingle" name="permission[]"> {{ $values->name }}
                                                                                <ul>
                                                                                    @foreach($permissionss as $valuess)
                                                                                        @if($values->code==$valuess->parent)

                                                                                            <li><input type="checkbox" value="{{ $valuess->id }}"
                                                                                                       class="name checkSingle" name="permission[]"> {{ $valuess->name }}</li>
                                                                                        @endif
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </div>

                                                        </li>
                                                        @php $counter++; @endphp
                                                    @endforeach
                                                </ul>



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

        $('input[type="checkbox"]').change(function (e) {

            var checked = $(this).prop("checked"),
                container = $(this).parent(),
                siblings = container.siblings();

            container.find('input[type="checkbox"]').prop({
                interminate: false,
                checked: checked
            });


            function checkSiblings(el) {

                var parent = el.parent().parent(),
                    all = true;

                el.siblings().each(function () {
                    return all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
                });

                if (all && checked) {

                    parent.childern('input[type="checkbox"]').prop("checked", checked);
                    parent.childern('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
                    checkSiblings(parent);

                } else {

                    el.parents("li").children('input[type="checkbox"]').prop({
                        indeterminate: true,
                        checked: false
                    });

                }


            }

            checkSiblings(container);
        });


        function display_li(id) {
            let display = document.getElementById("li-div[" + id + "]").style.display;
            console.log(display);
            if (display == "none") {
                document.getElementById("li-div[" + id + "]").style.display = "block";
            } else {
                document.getElementById("li-div[" + id + "]").style.display = "none";
            }

        }

    </script>



    <script>
        function maincheckForm() {

            let roles = document.getElementById("roles")
            validateInputIdArray = [
                roles.id
            ];
            // return validateInventoryInputs(validateInputIdArray);

            var ok = validateInventoryInputs(validateInputIdArray);
            if (ok) {

                // if (counter == 0) {
                //     $("#complain").addClass('bg-danger');
                //     return false;
                // } else if (counter2 == 0) {
                //     $("#accessories").addClass('bg-danger');
                //     return false;
                // }
                // else {
                //     alert(3);
                //     return true;
                // }
                    $("button[type='submit']").prop('disabled', true);
                // alert(3);
            } else {
            // alert(3);
                return false;
            }
        }

        function validateInventoryInputs(InputIdArray) {
            let i = 0,
                flag = false,
                getInput = '';

            for (i; i < InputIdArray.length; i++) {
                if (InputIdArray) {
                    getInput = document.getElementById(InputIdArray[i]);
                    if (getInput.value === '' || getInput.value === 0) {
                        getInput.focus();
                        getInput.classList.add('bg-danger');
                        flag = false;
                        break;
                    } else {
                        getInput.classList.remove('bg-danger');
                        flag = true;
                    }
                }
            }
            return flag;
        }

        // $(document).ready(function () {
        //     $('#form').validate({ // initialize the plugin
        //
        //         rules: {
        //             roles: {
        //                 // required: true,
        //                 // pattern: /^[A-Za-z0-9. ]{3,30}$/
        //             }
        //         },
        //         messages: {
        //             roles: {
        //                 // required: "Required"
        //             }
        //
        //         },
        //
        //         ignore: [],
        //         errorClass: "invalid-feedback animated fadeInUp",
        //         errorElement: "div",
        //         errorPlacement: function (e, a) {
        //             jQuery(a).parents(".form-group > div").append(e)
        //         },
        //         highlight: function (e) {
        //             jQuery(e).closest(".form-group").removeClass("is-invalid").addClass("is-invalid")
        //         },
        //         success: function (e) {
        //             jQuery(e).closest(".form-group").removeClass("is-invalid"), jQuery(e).remove()
        //         },
        //
        //     });
        //
        // });
    </script>
@stop
