@extends('layouts.theme_list')

@section('content')



    <style>
        .col-1-5 {
            flex: 0 0 12.6%;
            max-width: 12.6%;
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .w-5 {
            width: 2% !important;
        }

        .leading-5 {
            margin-bottom: 0 !important;
            margin-top: 8px !important;
        }

        .border {
            border: none !important;
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
                        <p class="mb-1">Category List</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Registration</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Category</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Category List</a></li>
                    </ol>
                </div>
            </div>
            @include('inc._message')
            <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Category List</h4>
                            <!-- Ibrahim add -->
                            {{--                        <button > --}}
                            <div class="srch_box_opn_icon">
                                <i id="search_hide" onclick="hide_the_search();" class="fa fa-search icon-hide"></i>
                            </div>
                            {{--                        </button> --}}
                        </div>
                        <div class="card-body">

                            <form action="{{ route('category_list') }}" method="get">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group mb-0">
                                            <label for="search_category">Search Category</label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group mb-0">
                                            <label class="float-left" for="bra_name">Search Brand</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group mb-0">
                                            <input type="text" tabindex="1" id="search_category" name="search_category" class="form-control form-control-sm" value="{{ $search_category }}">
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <select id="bra_name" name="bra_name">
                                            <option value="">Select Brand</option>
                                            @foreach($brands as $account)
                                                <option value="{{ $account->bra_name }}" {{ $bra_name === $account->bra_name ? 'selected' : '' }}>
                                                    {{ $account->bra_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-0-5">
                                        <div class="form-group">
                                            <a href="{{route('category_list')}}" class="btn btn-primary btn-sm" id="">
                                                Clear
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <button tabindex="8" class="btn btn-primary btn-sm" id="customer_search">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered display"
                                    style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>Sr#</th>
                                            <th>Category</th>
                                            <th>Brand</th>
                                            {{--                                        <th>Created By</th> --}}
                                            <th>Date</th>
                                            {{--                                        <th>Updated At</th> --}}
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $segmentSr = !empty(app('request')->input('segmentSr')) ? app('request')->input('segmentSr') : '';
                                            $segmentPg = !empty(app('request')->input('page')) ? app('request')->input('page') : '';
                                            $sr = !empty($segmentSr) ? $segmentSr * $segmentPg - $segmentSr + 1 : 1;
                                            $countSeg = !empty($segmentSr) ? $segmentSr : 0;
                                            $prchsPrc = $slePrc = $avrgPrc = 0;
                                        @endphp



                                        @foreach ($query as $brand)
                                            <tr>
                                                <td>{{ $sr }}</td>
                                                <td>{{ $brand->cat_name }}</td>
                                                <td>{{ $brand->bra_name }}</td>
                                                {{--                                            <td>{{$brand->name}}</td> --}}
                                                <td>{{ date('d-m-Y', strtotime($brand->cat_created_at)) }}</td>
                                                {{--                                            <td>{{$brand->cat_updated_at}}</td> --}}
                                                <td><a href="{{ route('edit_category', $brand->cat_id) }}"><i
                                                            class="fas fa-edit"></i></a></td>
                                            </tr>

                                            @php
                                                $sr++;
                                                !empty($segmentSr) && $countSeg !== '0' ?: $countSeg++;
                                            @endphp
                                        @endforeach


                                    </tbody>

                                </table>
                            </div>
                            {{ $query->appends(['segmentSr' => $countSeg, 'search_category' => $search_category, 'bra_name' => $bra_name])->links() }}

                            {{-- {{ $query->links() }} --}}
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
        $(document).ready(function() {
            $("#bra_name").select2();
            $('#form').validate({ // initialize the plugin

                rules: {
                    brand: {
                        required: true,
                        pattern: /^[A-Za-z0-9. ]{3,30}$/
                    }
                },
                messages: {
                    brand: {
                        required: "Required"
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
    </script>
@stop
