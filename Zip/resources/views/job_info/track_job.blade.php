@extends('layouts.theme_list')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .topFilter .search {
            position: relative;
        }

        .topFilter .search i {
            position: absolute;
            top: 2px;
            right: 3px;
            padding: 8px;
            background-color: white;
            z-index: 1;
            color: #ced4da;
        }

        .bottonButtons a {
            margin-right: 10px;
        }

        .bottonButtons button:last-child {
            margin-right: 0px;
        }

        .card {
            color: black;
        }

        .card {
            height: 100%;
            /* Set a fixed height for all cards */
        }

        .card-body {
            height: 100%;
            /* Ensure card body takes full height */
            display: flex;
            flex-direction: column;
        }

        .card-header {
            text-align: center;
            /* Center-align the card header */
        }

        .align-content-end {
            margin-top: auto;
            /* Align content to the bottom */
        }
    </style>
    <div class="content-body hidden-print">
        <div class="container-fluid">
            <form id="jobTransferForm" method="GET" onsubmit="return maincheckForm()">
                @csrf
                <div class="row mb-3  align-items-center topFilter">
                    <div class="col-4 col-md-4 col-sm-12">
                        <div class="d-flex align-items-center">
                            <div class="col-3 col-md-4 col-sm-12">
                                <label for="job_id">Job Id:</label>
                            </div>
                            <div class="col-9 col-md-8 col-sm-12 search">
                                <input type="text" class="form-control" id="job_id" name="job_id"
                                    placeholder="Job Id" onkeypress="return numbersOnly(value)">
                                <input type="hidden" class="form-control" id="edit" name="edit" placeholder="edit">
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-4 col-md-4 col-sm-12">
                        <div class="d-flex align-items-center">
                            <div class="col-3 col-md-4 col-sm-12">
                                <label for="serial_number">Serial Number:</label>
                            </div>
                            <div class="col-9 col-md-8 col-sm-12 search">
                                <input type="text" class="form-control" id="serial_number" name="serial_number"
                                    placeholder="Serial Number" onkeypress="return numbersOnly(value)">
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-1-5">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
            <div class="row " id="info">
            </div>
            <div id="lab_report">

            </div>
            <div id="part_report">
            </div>
            <div class="d-flex justify-content-center bottonButtons">
                <a class="btn btn-primary" target="_blank" href="{{ route('job_assign_to_technician_edit', 0) }}"
                    data-route="job_assign_to_technician_edit">
                    Job Assign To Technician
                </a>
                <a class="btn btn-primary" target="_blank" href="{{ route('job_transfer_edit', 0) }}"
                    data-route="job_transfer_edit">
                    Job Transfer
                </a>
                <a class="btn btn-primary" target="_blank" href="{{ route('job_hold_edit', 0) }}"
                    data-route="job_hold_edit">
                    Job Hold
                </a>
                <a class="btn btn-primary" target="_blank" href="{{ route('job_reopen_edit', 0) }}"
                    data-route="job_reopen_edit">
                    Job Re-Open
                </a>
                <a class="btn btn-primary" target="_blank" href="{{ route('job_close_edit', 0) }}"
                    data-route="job_close_edit">
                    Job Close
                </a>
                <a class="btn btn-primary" target="_blank" href="{{ route('job_invoice_edit', 0) }}"
                    data-route="job_invoice_edit">
                    Job Invoice
                </a>
                <a class="btn btn-warning" target="_blank" href="{{ route('job_delivery_edits', 0) }}"
                    data-route="job_delivery_edits">
                    Job Delivery
                </a>
                <a class="btn btn-warning" target="_blank" href="{{ route('job_part_issue_edit', 0) }}"
                    data-route="job_part_issue_edit">
                    Parts Issuance
                </a>
                <a class="btn btn-warning" target="_blank" href="{{ route('job_part_return_edit', 0) }}"
                    data-route="job_part_return_edit">
                    Parts Return
                </a>
                <a class="btn btn-success" target="_blank" href="{{ route('job_estimate_versions_edit', 0) }}"
                    data-route="job_estimate_versions_edit">
                    Estimate Versions
                </a>
                <a class="btn btn-secondary" style="background-color: red" target="_blank"
                    href="{{ route('job_info.create') }}">
                    New Job
                </a>
            </div>
        </div>
    </div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-xl mdl_wdth">
            <div class="modal-content base_clr">
                <div class="modal-header">
                    <h4 class="modal-title text-black">Estimate History</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div id="table_body">

                    </div>

                </div>

                <div class="modal-footer">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form_controls">
                            <button type="button" class="btn btn-default form-control cancel_button" data-dismiss="modal">
                                <i class="fa fa-times"></i> Cancel
                            </button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Add this to your HTML layout or view -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Add this to your HTML layout or view -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'error',
                text: '{{ session('error') }}',
            });
        </script>
    @endif
    <script>
        function maincheckForm() {

            let job_id = document.getElementById("job_id")
            validateInputIdArray = [
                job_id.id
            ];
            // return validateInventoryInputs(validateInputIdArray);

            var ok = validateInventoryInputs(validateInputIdArray);

            if (ok) {

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
    </script>
    <script>
        $(document).ready(function() {
            // Use event delegation to handle click on dynamically created element
            $('#info').on('click', '#view', function() {
                jQuery("#table_body").html("");

                var id = $('#edit').val();

                $('.modal-body').load('{{ url('estimate_history') }}' + '/' + id,
                    function() {
                        $('#myModal').modal({
                            show: true
                        });
                    });
                // Your code for handling the click event goes here
            });
            $('#jobTransferForm').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission.
                // Hide the divs
                $('#info').html('');
                $('#part_report').html('');
                $('#lab_report').html('');

                // Display SweetAlert loading spinner
                Swal.fire({
                    title: 'Loading',
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    },
                    timer: 300,
                    timerProgressBar: true,
                    showConfirmButton: false, // Set to false to remove the "OK" button
                    onClose: () => {
                        // Handle any actions when the timer closes (optional)
                    }
                });



                var job_id = $('#jobTransferForm input[name="job_id"]').val();
                $('#edit').val(job_id);
                var serial_number = $('#jobTransferForm input[name="serial_number"]').val();
                console.log(job_id);
                console.log(serial_number);

                var editValue = $('#edit').val();

                $('[data-route]').each(function() {
                    var route = $(this).data('route');
                    var originalHref = $(this).attr('href');
                    var newHref = originalHref.replace(/\/\d+$/, '/' + editValue);
                    $(this).attr('href', newHref);
                });

                $.ajax({
                    // alert(job_id);
                    url: '{{ route('track_job_find') }}',
                    type: "get",
                    dataType: "JSON",
                    data: {
                        'serial_number': serial_number,
                        'job_id': job_id
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.status === 'error') {
                            // alert(data.message);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: data.message,
                            });
                        } else {
                            var warrenty = 'No';
                            var delivery_status = 'Not delivered'
                            var vendor = '';
                            var first_tech = '';
                            if (data.items.ji_warranty_status == 1) {
                                warrenty = 'Yes';
                                vendor = data.items.vendor_name
                            }
                            if (data.datas !== null) {
                                first_tech = data.datas.tech_name;
                            } else if (data.old_tech.length > 0) {
                                first_tech = data.old_tech[0].tech_name;
                            } else {
                                first_tech = '';
                            }
                            if(data.items.job_delivery_status == 2){
                                delivery_status = "Delivered"
                            }
                            let faults = data.complain_items.map(item => item.jii_item_name)
                                .join(
                                    ', ');
                            let accessories = data.accessory_items.map(item => item
                                    .jii_item_name)
                                .join(', ');

                            const delivery_date = moment(data.items.ji_delivery_datetime)
                                .format(
                                    'DD-MM-YYYY');
                            const booking_date = moment(data.items.ji_recieve_datetime).format(
                                'DD-MM-YYYY');

                            // ${data.company_profile.cp_logo}
                            var info = `<div class="col-3 col-md-3 col-sm-12">
                    <div class="card mb-3">
                        <h5 class="card-header">Client Info</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Name</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">${data.items.cli_name}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Mobile</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">${data.items.cli_number}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Address</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${data.items.cli_address}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Warrenty Vendor </strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${vendor}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-sm-12">
                    <div class="card mb-3">
                        <h5 class="card-header">Job Info <span class="align-content-end" style="background-color:#ffd600;padding: 4px;border-radius: 10px;font-size: 16px;">Status = ${data.items.ji_job_status}</span></h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>JOb Id:</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">#${data.items.job_id}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Booking Date</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">${booking_date}</div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Warranty</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${warrenty}
                                </div>
                            </div>
                            <div class="row" style="background-color:#ff8100;padding: 4px;border-radius: 10px;">
                                <div class="col-6 col-md-6 col-sm-12" style="font-size: 12px;">
                                    <strong>First Technician</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${first_tech}
                                </div>
                            </div>
                            <div class="row" style="background-color:#00FFF2;padding: 4px;border-radius: 10px;margin-top:8px">
                                <div class="col-6 col-md-6 col-sm-12" style="font-size: 12px;">
                                    <strong>Delivery Status</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${delivery_status}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-sm-12">
                    <div class="card mb-3">
                        <h5 class="card-header">Product Info</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Brnad:</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${data.items.bra_name}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Category</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${data.items.cat_name}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Model:</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${data.items.mod_name}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 col-md-3 col-sm-12">
                    <div class="card mb-3">
                        <h5 class="card-header">Complaint Info</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Fault</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">

                                    ${faults}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Accessories</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                   ${accessories}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>EST.Charges</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${data.items.ji_estimated_cost}/-
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>EST. History</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    <a class="" id="view" style="text-decoration:underline;color:blue;cursor:pointer">
                                        History
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <strong>Delievery Date:</strong>
                                </div>
                                <div class="col-6 col-md-6 col-sm-12">
                                    ${delivery_date}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`
                            // var = job_transfer_date = date('d-m-Y', strtotime(data.job_transfers.jt_created_at))
                            var lab_report = `<div class="card mb-3">
                <h5 class="card-header">Lab Report:</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Job No</th>
                                    <th scope="col">Old Technician</th>
                                    <th scope="col">New Technician</th>
                                    <th scope="col">Created Date</th>
                                </tr>
                            </thead>
                            <tbody>`
                            var sr = 1;
                            $.each(data.job_transfer, function(index, items) {
                                var createdDate = moment(items.jt_created_at).format(
                                    'DD-MM-YYYY'); // Format date using moment.js
                                lab_report += `
                                    <tr>
                                        <td>${sr}</td>
                                        <td>${items.jt_job_no}</td>
                                        <td>${items.old_name}</td>
                                        <td>${items.new_name}</td>
                                        <td>${createdDate}</td>
                                    </tr>`;
                                sr++;
                            });

                            lab_report += `</tbody>
                        </table>
                        </div>
                        </div>
                        </div>`
                            var part_report = `<div class="card mb-3">
    <h5 class="card-header">Parts Report:</h5>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Part Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Movement Status</th>
                        <th scope="col">Created Date</th>
                    </tr>
                </thead>
                <tbody>`;

                            var sr = 1;
                            $.each(data.part_report, function(index, items) {
                                if (Array.isArray(items) && items.length > 0) {
                                    // Handle the case where items is an array
                                    $.each(items, function(innerIndex, innerItem) {
                                        var createdDate = moment(innerItem
                                            .iptji_created_at).format(
                                            'DD-MM-YYYY h:m:s');
                                        part_report += `
                <tr>
                    <td>${sr}</td>
                    <td>${innerItem.par_name}</td>
                    <td>${innerItem.iptji_qty}</td>
                    <td>${innerItem.iptj_status}</td>
                    <td>${createdDate}</td>
                </tr>`;
                                        sr++;
                                    });
                                } else {
                                    // Handle the case where items is not an array
                                    var createdDate = moment(items.iptji_created_at)
                                        .format('DD-MM-YYYY h:m:s');
                                    part_report += `
            <tr>
                <td>${sr}</td>
                <td>${items.par_name}</td>
                <td>${items.iptji_qty}</td>
                <td>${items.iptj_status}</td>
                <td>${createdDate}</td>
            </tr>`;
                                    sr++;
                                }
                            });

                            part_report += `</tbody>
            </table>
        </div>
    </div>
</div>`
                            $('#info').html(info);
                            $('#part_report').html(part_report);
                            $('#lab_report').html(lab_report);
                        }
                        // Close SweetAlert after error
                        // Swal.close();
                    },
                    error: function(xhr, status, error) {
                        // Handle errors.
                        // Close SweetAlert after error
                        // Swal.close();
                    }
                });
                // Close SweetAlert after error
                // Swal.close();
            });
        });
    </script>
@endsection
