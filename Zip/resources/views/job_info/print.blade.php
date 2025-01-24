<html>

<head></head>

<body>


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

        th,
        td {
            border: 1px solid;
            border-collapse: collapse
        }

        @page {
            size: landscape;
        }
    </style>




    <!--**********************************
            Content body start
        ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <!-- row -->



            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Basic Datatable</h4>
                            <!-- Ibrahim add -->

                        </div>
                        <div class="card-body">


                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered display"
                                    style="min-width: 845px">
                                    <thead>
                                        <tr>

                                            <th>Job No</th>
                                            <th>Client Name</th>
                                            <th>Client Number</th>
                                            <th>Warrenty</th>
                                            <th>Delivery Status</th>
                                            <th>Delivered By</th>
                                            <th>Brand</th>
                                            <th>Category</th>
                                            <th>Model</th>
                                            <th>Equipment</th>
                                            <th>Status</th>
                                            <th>Serial Number</th>
                                            <th>Cost</th>
                                            <th>Complain</th>
                                            <th>Accessories</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>


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



                                        @foreach ($query as $index => $brand)
                                            <tr>
                                                <td>{{ $brand->ji_id }}</td>
                                                <td>{{ $brand->cli_name }}</td>
                                                <td>{{ $brand->cli_number }}</td>
                                                <td>{{ $brand->ji_warranty_status == 1 ? 'Yes' : '' }}</td>
                                                <td>{{ $brand->job_delivery_status == 2 ? 'Delivered' : 'Not delivered' }}
                                                </td>
                                                <td>{{ $brand->user_name }}</td>
                                                <td>{{ $brand->bra_name }}</td>
                                                <td>{{ $brand->cat_name }}</td>
                                                <td>{{ $brand->mod_name }}</td>
                                                <td>{{ $brand->ji_equipment }}</td>

                                                <td>{{ $brand->ji_job_status }}</td>
                                                <td>{{ $brand->ji_serial_no }}</td>
                                                <td>{{ $brand->ji_estimated_cost }}</td>


                                                @foreach ($complain_items as $complain)
                                                    @if ($complain->jii_ji_id == $brand->ji_id)
                                                        <td>{{ $complain->jii_item_name }}</td>
                                                    @endif
                                                @endforeach


                                                @foreach ($accessory_items as $complain)
                                                    @if ($complain->jii_ji_id == $brand->ji_id)
                                                        <td>{{ $complain->jii_item_name }}</td>
                                                    @endif
                                                @endforeach

                                                <td>{{ $brand->ji_recieve_datetime }}</td>
                                                <td>{{ $brand->ji_delivery_datetime }}</td>
                                                <td><a href="{{ route('job_info.edit', $brand->ji_id) }}"><i
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
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->


</body>

</html>
