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

        th,
        td {
            border: 1px solid;
            border-collapse: collapse;
        }
    </style>


    <!--**********************************
                                        Content body start
                                    ***********************************-->
    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Client List</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="" class="table table-striped table-bordered display"
                                       style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>Sr#</th>
                                        <th>Name</th>
                                        <th>Number</th>
                                        <th>Address</th>
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
                                            <td>{{ $brand->cli_name }}</td>
                                            <td>{{ $brand->cli_number }}</td>
                                            <td>{{ $brand->cli_address }}</td>
                                            <td><a href="{{ route('edit_client.edit', $brand->cli_id) }}"><i
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
