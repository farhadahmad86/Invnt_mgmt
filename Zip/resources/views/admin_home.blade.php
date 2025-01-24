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
                        <p class="mb-0">Your business dashboard</p>
                    </div>
                </div>
                <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">Admin Dashboard</a></li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-money text-success border-success"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Estimated Cost</div>

                                @foreach($profit as $pro)
                                    <div class="stat-digit">{{$pro->total_profit}}</div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-user text-primary border-primary"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Jobs</div>

                                @foreach($jobs as $pro)
                                    <div class="stat-digit">{{$pro->total_jobs}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-layout-grid2 text-pink border-pink"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Cash In</div>
                                @foreach($in as $pro)
                                    <div class="stat-digit">{{$pro->total_in}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <div class="stat-widget-one card-body">
                            <div class="stat-icon d-inline-block">
                                <i class="ti-link text-danger border-danger"></i>
                            </div>
                            <div class="stat-content d-inline-block">
                                <div class="stat-text">Cash Out</div>
                                @foreach($out as $pro)
                                    <div class="stat-digit">{{$pro->total_out}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Monthly Sales</h4>
                        </div>
                        <div class="card-body">
                            {{--                            <div class="ct-bar-chart mt-5"></div>--}}
                            {!! $monthlyIncomeCharte->container() !!}

                        </div>
                    </div>
                </div>
                <div class="col-lg-5">

                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Jobs Completed</h4>
                            </div>
                            <div class="card-body">
                                {{--                            <div class="ct-pie-chart"></div>--}}
                                {!! $chart->container() !!}

                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Parts Available</h4>
                            </div>
                            <div class="card-body">
                                {{--                            <div class="ct-pie-chart"></div>--}}
                                {!! $stockBarChart->container() !!}

                            </div>
                        </div>

                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="year-calendar"></div>
                        </div>
                    </div>
                    <!-- /# card -->
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Accounts</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table student-data-table m-t-20">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Updated At</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $segmentSr  = (!empty(app('request')->input('segmentSr'))) ? app('request')->input('segmentSr') : '';
                                        $segmentPg  = (!empty(app('request')->input('page'))) ? app('request')->input('page') : '';
                                        $sr = (!empty($segmentSr)) ? $segmentSr * $segmentPg - $segmentSr + 1 : 1;
                                        $countSeg = (!empty($segmentSr)) ? $segmentSr : 0;
                                        $prchsPrc = $slePrc = $avrgPrc = 0;
                                    @endphp
                                    @foreach($datas as $brand)
                                        <tr>
                                            <td>{{$sr}}</td>
                                            <td>{{$brand->ca_name}}</td>
                                            <td>{{$brand->ca_balance}}</td>
                                            <td>{{$brand->ca_updated_at}}</td>
                                        </tr>

                                        @php
                                            $sr++; (!empty($segmentSr) && $countSeg !== '0') ?  : $countSeg++;
                                        @endphp
                                    @endforeach


                                    </tbody>
                                </table>
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
    {{--<div class="container">--}}
    {{--    <div class="row justify-content-center">--}}
    {{--        <div class="col-md-8">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

    {{--                <div class="card-body">--}}
    {{--                    @if (session('status'))--}}
    {{--                        <div class="alert alert-success" role="alert">--}}
    {{--                            {{ session('status') }}--}}
    {{--                        </div>--}}
    {{--                    @endif--}}

    {{--                    {{ __('You are logged in!') }}--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--</div>--}}
@endsection


@section('script')
    <script src="{{ $chart->cdn() }}"></script>

    {{ $chart->script() }}

    <script src="{{ $monthlyIncomeCharte->cdn() }}"></script>

    {{ $monthlyIncomeCharte->script() }}

    {{--    <script src="{{ $stockChart->cdn() }}"></script>--}}

    {{--    {{ $stockChart->script() }}--}}

    <script src="{{ $stockBarChart->cdn() }}"></script>

    {{ $stockBarChart->script() }}

@stop
