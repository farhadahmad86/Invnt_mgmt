<!--**********************************
            Sidebar start
        ***********************************-->
<style>
    .quixnav, .nav-header{
        background-color: white;
    }
    .nav-label{
        color: #7a7a7a;
    }
    .quixnav .metismenu > li > a  {
        color: #000;
    }
    .quixnav .metismenu li a {
        color: #000;
    }
    .quixnav .metismenu li .mm-active a {
        color: #000;
    }

    .quixnav .metismenu li a:hover {
        background-color: #6b51df;
        color: #fff;
    }
    .quixnav .metismenu ul a:focus a:hover {
        text-decoration: none;
        color: #000;
    }
</style>
<div class="quixnav hidden-print">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Dashboard</li>
            <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
            </li> -->
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                <ul aria-expanded="false">
                    {{--                    <li><a href="{{ route('home') }}">Dashboard</a></li>--}}

                    {{-- @if (auth()->user()->id <= 2) --}}
                    @can('Admin Dashboard')
                        <li><a href="{{ route('admin_dashboard') }}">Admin Dashboard</a></li>
                        {{-- @endif --}}
                    @endcan

                </ul>
            </li>

            <li class="nav-label">Main Menu</li>
            @if (Gate::any(['Roles', 'Employee', 'Cash Account','Part Registration', 'Sale Purchase Party', 'Warrenty Vendor','Client','Brand','Category','Model','Job Hold Reason','Job Close Reason']))
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-app-store"></i><span class="nav-text">Registration</span></a>
                <ul aria-expanded="false">

                    {{-- @if (auth()->user()->id <= 2) --}}

                    @if (Gate::check('role-create') || Gate::check('role-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Roles</a>
                            <ul aria-expanded="false">
                                @can('role-create')
                                    <li><a href="{{ route('roles.create') }}">Roles Creation</a></li>
                                @endcan
                                @can('role-list')
                                    <li><a href="{{ route('roles.index') }}">Roles List</a></li>
                                @endcan
                            </ul>

                        </li>
                    @endif

                    @if (Gate::check('employee-create') || Gate::check('employee-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Employee</a>
                            <ul aria-expanded="false">
                                @can('employee-create')
                                    <li><a href="{{ route('employee_registration.create') }}">Employee Creation</a></li>
                                @endcan
                                @can('employee-list')
                                    <li><a href="{{ route('employee_registration.index') }}">Employee List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif




                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Technician</a> --}}
                    {{-- <ul aria-expanded="false"> --}}
                    {{-- <li><a href="{{route('add_technician')}}">Create Technician</a>
            </li> --}}
                    {{-- <li><a href="{{route('technician_list')}}">Technician List</a></li> --}}
                    {{-- </ul> --}}
                    {{-- </li> --}}

                    {{-- @endif --}}

                    {{-- @if (auth()->user()->id <= 2) --}}
                    @if (Gate::check('cash-account-create') || Gate::check('cash-account-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cash Account</a>
                            <ul aria-expanded="false">
                                @can('cash-account-create')
                                    <li><a href="{{ route('cash_account.create') }}">Create Cash Account</a></li>
                                @endcan
                                @can('cash-account-list')
                                    <li><a href="{{ route('cash_account.index') }}">Cash Account List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    {{-- @endif --}}
                    @if (Gate::check('part-registration-create') ||
                            Gate::check('part-registration-list') ||
                            Gate::check('openinning-stock-create'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Part Registration</a>
                            <ul aria-expanded="false">
                                @can('part-registration-create')
                                    <li><a href="{{ route('part_registration.create') }}">Create Part Registration</a>
                                    </li>
                                @endcan
                                @can('part-registration-list')
                                    <li><a href="{{ route('part_registration.index') }}">Part Registration List</a></li>
                                @endcan
                                @can('openinning-stock-create')
                                    <li><a href="{{ route('add_openning') }}">Openning Stock</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif


                    @if (Gate::check('sale-purchase-party-create') || Gate::check('sale-purchase-party-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Sale Purchase Party</a>
                            <ul aria-expanded="false">
                                @can('sale-purchase-party-create')
                                    <li><a href="{{ route('add_party') }}">Create Sale Purchase Party</a></li>
                                @endcan
                                @can('sale-purchase-party-list')
                                    <li><a href="{{ route('party_list') }}">Sale Purchase Party List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('Warrenty-vendor-create') || Gate::check('Warrenty-vendor-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Warrenty Vendor</a>
                            <ul aria-expanded="false">
                                @can('Warrenty-vendor-create')
                                    <li><a href="{{ route('add_vendor') }}">Warrenty Vendor</a></li>
                                @endcan
                                @can('Warrenty-vendor-list')
                                    <li><a href="{{ route('vendor_list') }}">Warrenty Vendor List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @can('client-list')
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Client</a>
                            <ul aria-expanded="false">
                                {{-- <li><a href="{{route('edit_client.create')}}">Create Edit Client</a>
            </li> --}}
                                <li><a href="{{ route('edit_client.index') }}">Client List</a></li>
                            </ul>
                        </li>
                    @endcan

                    @if (Gate::check('brand-create') || Gate::check('brand-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Brand</a>
                            <ul aria-expanded="false">
                                @can('brand-create')
                                    <li><a href="{{ route('add_brand') }}">Create Brand</a></li>
                                @endcan
                                @can('brand-list')
                                    <li><a href="{{ route('brand_list') }}">Brand List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('category-create') || Gate::check('category-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Category</a>
                            <ul aria-expanded="false">
                                @can('category-create')
                                    <li><a href="{{ route('add_category') }}">Create Category</a></li>
                                @endcan
                                @can('category-list')
                                    <li><a href="{{ route('category_list') }}">Category List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('model-create') || Gate::check('model-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Model</a>
                            <ul aria-expanded="false">
                                @can('model-create')
                                    <li><a href="{{ route('add_model') }}">Create Model</a></li>
                                @endcan
                                @can('model-list')
                                    <li><a href="{{ route('model_list') }}">Model List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif


                    @if (Gate::check('job-lab-hold-reason-create') || Gate::check('job-lab-hold-reason-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Job Hold Reason</a>
                            <ul aria-expanded="false">
                                @can('job-lab-hold-reason-create')
                                    <li><a href="{{ route('add_job_hold_reason') }}">Job Hold Reason</a></li>
                                @endcan
                                @can('job-lab-hold-reason-list')
                                    <li><a href="{{ route('job_hold_reason_list') }}">Job Hold Reason List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif


                    @if (Gate::check('job-lab-close-reason-create') || Gate::check('job-lab-close-reason-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Job Close Reason</a>
                            <ul aria-expanded="false">
                                @can('job-lab-close-reason-list')
                                    <li><a href="{{ route('job_close_reason.create') }}">Job Close Reason</a></li>
                                @endcan
                                @can('job-lab-close-reason-list')
                                    <li><a href="{{ route('job_close_reason.index') }}">Job Close Reason List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif


                </ul>
            </li>
            @endif
            @if (Gate::any(['job information', 'job issue to technician', 'issue parts to job','job parts return', 'job transfer', 'job close','estimate version','job hold','job reopen']))
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-plug"></i><span
                        class="nav-text">Jobs Management</span></a>
                <ul aria-expanded="false">

                    @if (Gate::check('job-information-create') ||
                            Gate::check('job-information-list') ||
                            Gate::check('detail-job-information-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Job Informartion</a>
                            <ul aria-expanded="false">
                                @can('job-information-create')
                                    <li><a href="{{ route('job_info.create') }}">Create Job Info</a></li>
                                @endcan
                                @can('job-information-list')
                                    <li><a href="{{ route('job_info.index') }}">Job Info List</a></li>
                                @endcan
                                @can('detail-job-information-list')
                                    <li><a href="{{ route('add_job_info_list.index') }}">Job Info Detail List</a></li>
                                @endcan
                                @can('job-track')
                                    <li><a href="{{ route('track_job') }}">Job Track</a></li>
                                @endcan
                                @can('job-delivery')
                                    <li><a href="{{ route('job_delivery') }}">Job Delivery</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('job-issue-to-technician-create') || Gate::check('job-issue-to-technician-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Job Assign To
                                Technician</a>
                            <ul aria-expanded="false">
                                @can('job-issue-to-technician-create')
                                    <li><a href="{{ route('job_issue_to_technician.create') }}">Job Assign To
                                            Technician</a></li>
                                @endcan
                                @can('job-issue-to-technician-list')
                                    <li><a href="{{ route('job_issue_to_technician.index') }}">Job Assign To Technician
                                            List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('issue-parts-to-job-create') || Gate::check('issue-parts-to-job-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Issue Parts To
                                Job</a>
                            <ul aria-expanded="false">
                                @can('issue-parts-to-job-create')
                                    <li><a href="{{ route('issue_parts_to_job.create') }}">Create Issue Parts To Job</a>
                                    </li>
                                @endcan
                                @can('issue-parts-to-job-list')
                                    <li><a href="{{ route('issue_parts_to_job.index') }}">Issue Parts List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif
                    @if (Gate::check('add-job-parts-return') || Gate::check('job-parts-return-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Return Parts To
                                Job</a>
                            <ul aria-expanded="false">
                                @can('add-job-parts-return')
                                    <li><a href="{{ route('job_parts_return.create') }}">Create Return Parts To Job</a>
                                    </li>
                                @endcan
                                @can('job-parts-return-list')
                                    <li><a href="{{ route('job_parts_return.index') }}">Return Parts To Job List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif


                    @if (Gate::check('job-transfer-create') || Gate::check('job-transfer-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Job Transfer To Other
                                Tech.</a>
                            <ul aria-expanded="false">
                                @can('job-transfer-create')
                                    <li><a href="{{ route('job_transfer.create') }}">Job Transfer To Other Tech.</a>
                                    </li>
                                @endcan
                                @can('job-transfer-list')
                                    <li><a href="{{ route('job_transfer.index') }}">Job Transfer To Other Tech. List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('job-close-create') || Gate::check('job-close-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Job Close</a>
                            <ul aria-expanded="false">
                                @can('job-close-create')
                                    <li><a href="{{ route('job_close.create') }}">Create Job Close</a></li>
                                @endcan
                                @can('job-close-list')
                                    <li><a href="{{ route('job_close.index') }}">Job Close List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('estimate-version-create') || Gate::check('estimate-version-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Estimate Versions</a>
                            <ul aria-expanded="false">
                                @can('estimate-version-create')
                                    <li><a href="{{ route('estimate_versions.create') }}">Create Estimate Versions</a>
                                    </li>
                                @endcan
                                @can('estimate-version-list')
                                    <li><a href="{{ route('estimate_versions.index') }}">Estimate Versions List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('job-hold-create') || Gate::check('job-hold-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Job Hold</a>
                            <ul aria-expanded="false">
                                @can('job-hold-create')
                                    <li><a href="{{ route('job_hold.create') }}">Create Job Hold</a></li>
                                @endcan
                                @can('job-hold-list')
                                    <li><a href="{{ route('job_hold.index') }}">Job Hold List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('job-reopen-create') || Gate::check('job-reopen-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Job Re-Open
                                Reason</a>
                            <ul aria-expanded="false">
                                @can('job-reopen-create')
                                    <li><a href="{{ route('job_re_open.create') }}">Create Job Re-Open Reason</a></li>
                                @endcan
                                @can('job-reopen-list')
                                    <li><a href="{{ route('job_re_open.index') }}">Job Re-Open Reason List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif


                </ul>
            </li>
            @endif
            @if (Gate::any(['product loss', 'product recover', 'Stock movement list']))
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-globe-2"></i><span class="nav-text">Stock Movement</span></a>
                <ul aria-expanded="false">

                    @if (Gate::check('product-loss-create') || Gate::check('product-loss-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Product Loss</a>
                            <ul aria-expanded="false">
                                @can('product-loss-create')
                                    <li><a href="{{ route('product_loss.create') }}">Create Product Loss</a></li>
                                @endcan
                                @can('product-loss-list')
                                    <li><a href="{{ route('product_loss.index') }}">Product Loss List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('product-recover-create') || Gate::check('product-recover-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Product Recover</a>
                            <ul aria-expanded="false">
                                @can('product-recover-create')
                                    <li><a href="{{ route('product_recover.create') }}">Create Product Recover</a></li>
                                @endcan
                                @can('product-recover-list')
                                    <li><a href="{{ route('product_recover.index') }}">Product Recover List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @can('stock-list')
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Stock Movement List</a>
                            <ul aria-expanded="false">
                                {{-- <li><a href="{{route('opening_stock.create')}}">Create Opening Stock</a>
                </li> --}}
                                <li><a href="{{ route('opening_stock.index') }}">Stock Movement List</a></li>
                            </ul>
                        </li>
                    @endcan

                </ul>
            </li>
            @endif
            @if (Gate::any(['sale invoice for job', 'sale invoice', 'purchase invoice','cash receipt voucher', 'cash payment voucher', 'cash book']))
            <li>
                <a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                        class="icon icon-chart-bar-33"></i><span class="nav-text">Cash Invoices</span></a>
                <ul aria-expanded="false">

                    @if (Gate::check('sale-invoice-for-job-create') || Gate::check('sale-invoice-for-job-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Sale Invoice For
                                Jobs</a>
                            <ul aria-expanded="false">

                                @can('sale-invoice-for-job-create')
                                    <li><a href="{{ route('sale_invoice_for_jobs.create') }}">Create Sale Invoice For
                                            Jobs</a></li>
                                @endcan
                                @can('sale-invoice-for-job-list')
                                    <li><a href="{{ route('sale_invoice_for_jobs.index') }}">Sale Invoice For Jobs
                                            List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif


                    @if (Gate::check('sale-invoice-create') || Gate::check('sale-invoice-list') || Gate::check('detail-sale-invoice-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Sale Invoice</a>
                            <ul aria-expanded="false">
                                @can('sale-invoice-create')
                                    <li><a href="{{ route('sale_invoice.create') }}">Create Sale Invoice</a></li>
                                @endcan
                                @can('sale-invoice-list')
                                    <li><a href="{{ route('sale_invoice.index') }}">Sale Invoice List</a></li>
                                @endcan
                                @can('detail-sale-invoice-list')
                                    <li><a href="{{ route('credit_sale_list') }}">Detail Sale Invoice List</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('purchase-invoice-create') ||
                            Gate::check('purchase-invoice-list') ||
                            Gate::check('detail-purchase-invoice-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Purchase Invoice</a>
                            <ul aria-expanded="false">
                                @can('purchase-invoice-create')
                                    <li><a href="{{ route('purchase_invoice.create') }}">Create Purchase Invoice</a>
                                    </li>
                                @endcan
                                @can('purchase-invoice-list')
                                    <li><a href="{{ route('purchase_invoice.index') }}">Purchase Invoice List</a></li>
                                @endcan
                                @can('detail-purchase-invoice-list')
                                    <li><a href="{{ route('credit_purchase_list') }}">Detail Purchase Invoice List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif


                    @if (Gate::check('cash-receipt-voucher-create') || Gate::check('cash-receipt-voucher-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cash Receipt
                                Voucher</a>
                            <ul aria-expanded="false">
                                @can('cash-receipt-voucher-create')
                                    <li><a href="{{ route('cash_receipt_voucher.create') }}">Create Cash Receipt
                                            Voucher</a></li>
                                @endcan
                                @can('cash-receipt-voucher-list')
                                    <li><a href="{{ route('cash_receipt_voucher.index') }}">Cash Receipt Voucher
                                            List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @if (Gate::check('cash-payment-voucher-create') || Gate::check('cash-payment-voucher-list'))
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cash Payment
                                Voucher</a>
                            <ul aria-expanded="false">
                                @can('cash-payment-voucher-create')
                                    <li><a href="{{ route('cash_payment_voucher.create') }}">Create Cash Payment
                                            Voucher</a></li>
                                @endcan
                                @can('cash-payment-voucher-list')
                                    <li><a href="{{ route('cash_payment_voucher.index') }}">Cash Payment Voucher
                                            List</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif

                    @can('cash-book-list')
                        <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Cash Book</a>
                            <ul aria-expanded="false">
                                <li><a href="{{ route('cash_book_list') }}">Cash Book List</a></li>
                            </ul>
                        </li>
                    @endcan


                </ul>
            </li>
            @endif
            {{-- @if (auth()->user()->id <= 2) --}}

            @if (Gate::any(['time-report','issue-parts-report','profit-report','technisian-lab-report','stock-report','warranty-vendor-report']))
                <li class="{{ Route::is('technician_job_info_report', 'Job_Info_Job_Issue_Parts_Items_Report', 'Profit_Report', 'technician_lab_report', 'warranty_vendor_report', 'stock_report') ? 'mm-active' : '' }}">
                    <a class="has-arrow {{ Route::is('technician_job_info_report', 'Job_Info_Job_Issue_Parts_Items_Report', 'Profit_Report', 'technician_lab_report', 'warranty_vendor_report', 'stock_report') ? 'mm-show' : '' }}" href="javascript:void()" aria-expanded="{{ Route::is('technician_job_info_report', 'Job_Info_Job_Issue_Parts_Items_Report', 'Profit_Report', 'technician_lab_report', 'warranty_vendor_report', 'stock_report') ? 'true' : 'false' }}">
                        <i class="icon icon-globe-2"></i><span class="nav-text">Reports</span>
                    </a>
                    <ul aria-expanded="{{ Route::is('technician_job_info_report', 'Job_Info_Job_Issue_Parts_Items_Report', 'Profit_Report', 'technician_lab_report', 'warranty_vendor_report', 'stock_report') ? 'true' : 'false' }}" class="{{ Route::is('technician_job_info_report', 'Job_Info_Job_Issue_Parts_Items_Report', 'Profit_Report', 'technician_lab_report', 'warranty_vendor_report', 'stock_report') ? 'mm-collapse mm-show' : '' }}">
                        <ul>
                            @can('time-report')
                                <li class="{{ Route::is('technician_job_info_report') ? 'active' : '' }}">
                                    <a href="{{ route('technician_job_info_report') }}">Time Report</a>
                                </li>
                            @endcan
                            @can('issue-parts-report')
                                <li class="{{ Route::is('Job_Info_Job_Issue_Parts_Items_Report') ? 'active' : '' }}">
                                    <a href="{{ route('Job_Info_Job_Issue_Parts_Items_Report') }}">Issue Parts Report</a>
                                </li>
                            @endcan
                            @can('profit-report')
                                <li class="{{ Route::is('Profit_Report') ? 'active' : '' }}">
                                    <a href="{{ route('Profit_Report') }}">Profit Report</a>
                                </li>
                            @endcan
                            @can('technisian-lab-report')
                                <li class="{{ Route::is('technician_lab_report') ? 'active' : '' }}">
                                    <a href="{{ route('technician_lab_report') }}">Technician Lab Report</a>
                                </li>
                            @endcan
                            @can('warranty-vendor-report')
                                <li class="{{ Route::is('warranty_vendor_report') ? 'active' : '' }}">
                                    <a href="{{ route('warranty_vendor_report') }}">Warranty Vendor Report</a>
                                </li>
                            @endcan
                            @can('stock-report')
                                <li class="{{ Route::is('stock_report') ? 'active' : '' }}">
                                    <a href="{{ route('stock_report') }}">Stock Report</a>
                                </li>
                            @endcan
                        </ul>
                    </ul>
                </li>
            @endif

        @if (auth()->check() && auth()->user()->id == 1)
                <li class="{{ Route::is('add_company', 'company_list') ? 'mm-active' : '' }}">
                    <a class="has-arrow {{ Route::is('add_company', 'company_list') ? 'mm-show' : '' }}" href="javascript:void()" aria-expanded="{{ Route::is('add_company', 'company_list') ? 'true' : 'false' }}">
                        <i class="icon icon-globe-2"></i>
                        <span class="nav-text">Softagics</span>
                    </a>
                    <ul aria-expanded="{{ Route::is('add_company', 'company_list') ? 'true' : 'false' }}" class="{{ Route::is('add_company', 'company_list') ? 'mm-collapse mm-show' : '' }}">
                        <ul>
                            <li class="{{ Route::is('add_company') ? 'active' : '' }}">
                                <a href="{{ route('add_company') }}">Add Company</a>
                            </li>
                            <li class="{{ Route::is('company_list') ? 'active' : '' }}">
                                <a href="{{ route('company_list') }}">Company List</a>
                            </li>
                            {{-- Add other menu items --}}
                        </ul>
                    </ul>
                </li>
            @endif


            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i class="icon icon-globe-2"></i><span class="nav-text">Vendor</span></a> --}}
            {{-- <ul aria-expanded="false"> --}}
            {{-- <ul aria-expanded="false"> --}}
            @if (Gate::any(['Profile','company-profile']))
                <li class="{{ Route::is('company_profile') ? 'mm-active' : '' }}">
                    <a class="has-arrow {{ Route::is('company_profile') ? 'mm-show' : '' }}" href="javascript:void()" aria-expanded="{{ Route::is('company_profile') ? 'true' : 'false' }}">
                        <i class="icon icon-globe-2"></i>
                        <span class="nav-text">Profile</span>
                    </a>
                    <ul aria-expanded="{{ Route::is('company_profile') ? 'true' : 'false' }}" class="{{ Route::is('company_profile') ? 'mm-collapse mm-show' : '' }}">
                        <ul>
                            @can('company-profile')
                                <li class="{{ Route::is('company_profile') ? 'active' : '' }}">
                                    <a href="{{ route('company_profile') }}">
                                        <i class="icon icon-single-04"></i>Update Company Profile
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </ul>
                </li>
            @endif
            {{-- <li><a href="{{route('vendor_list')}}">Vendor List</a></li> --}}
            {{-- </ul> --}}
            {{-- </ul> --}}


            {{-- </li> --}}

            {{-- @endif --}}

            {{-- <li class="nav-label">Components</li> --}}
            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i --}}
            {{-- class="icon icon-world-2"></i><span class="nav-text">Bootstrap</span></a> --}}
            {{-- <ul aria-expanded="false"> --}}
            {{-- <li><a href="./ui-accordion.html">Accordion</a></li> --}}
            {{-- <li><a href="./ui-alert.html">Alert</a></li> --}}
            {{-- <li><a href="./ui-badge.html">Badge</a></li> --}}
            {{-- <li><a href="./ui-button.html">Button</a></li> --}}
            {{-- <li><a href="./ui-modal.html">Modal</a></li> --}}
            {{-- <li><a href="./ui-button-group.html">Button Group</a></li> --}}
            {{-- <li><a href="./ui-list-group.html">List Group</a></li> --}}
            {{-- <li><a href="./ui-media-object mr-3.html">Media Object</a></li> --}}
            {{-- <li><a href="./ui-card.html">Cards</a></li> --}}
            {{-- <li><a href="./ui-carousel.html">Carousel</a></li> --}}
            {{-- <li><a href="./ui-dropdown.html">Dropdown</a></li> --}}
            {{-- <li><a href="./ui-popover.html">Popover</a></li> --}}
            {{-- <li><a href="./ui-progressbar.html">Progressbar</a></li> --}}
            {{-- <li><a href="./ui-tab.html">Tab</a></li> --}}
            {{-- <li><a href="./ui-typography.html">Typography</a></li> --}}
            {{-- <li><a href="./ui-pagination.html">Pagination</a></li> --}}
            {{-- <li><a href="./ui-grid.html">Grid</a></li> --}}

            {{-- </ul> --}}
            {{-- </li> --}}

            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i --}}
            {{-- class="icon icon-plug"></i><span class="nav-text">Plugins</span></a> --}}
            {{-- <ul aria-expanded="false"> --}}
            {{-- <li><a href="./uc-select2.html">Select 2</a></li> --}}
            {{-- <li><a href="./uc-nestable.html">Nestedable</a></li> --}}
            {{-- <li><a href="./uc-noui-slider.html">Noui Slider</a></li> --}}
            {{-- <li><a href="./uc-sweetalert.html">Sweet Alert</a></li> --}}
            {{-- <li><a href="./uc-toastr.html">Toastr</a></li> --}}
            {{-- <li><a href="./map-jqvmap.html">Jqv Map</a></li> --}}
            {{-- </ul> --}}
            {{-- </li> --}}
            {{-- <li><a href="widget-basic.html" aria-expanded="false"><i class="icon icon-globe-2"></i><span --}}
            {{-- class="nav-text">Widget</span></a></li> --}}
            {{-- <li class="nav-label">Forms</li> --}}
            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i --}}
            {{-- class="icon icon-form"></i><span class="nav-text">Forms</span></a> --}}
            {{-- <ul aria-expanded="false"> --}}
            {{-- <li><a href="./form-element.html">Form Elements</a></li> --}}
            {{-- <li><a href="./form-wizard.html">Wizard</a></li> --}}
            {{-- <li><a href="./form-editor-summernote.html">Summernote</a></li> --}}
            {{-- <li><a href="form-pickers.html">Pickers</a></li> --}}
            {{-- <li><a href="form-validation-jquery.html">Jquery Validate</a></li> --}}
            {{-- </ul> --}}
            {{-- </li> --}}
            {{-- <li class="nav-label">Table</li> --}}
            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i --}}
            {{-- class="icon icon-layout-25"></i><span class="nav-text">Table</span></a> --}}
            {{-- <ul aria-expanded="false"> --}}
            {{-- <li><a href="table-bootstrap-basic.html">Bootstrap</a></li> --}}
            {{-- <li><a href="table-datatable-basic.html">Datatable</a></li> --}}
            {{-- </ul> --}}
            {{-- </li> --}}

            {{-- <li class="nav-label">Extra</li> --}}
            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i --}}
            {{-- class="icon icon-single-copy-06"></i><span class="nav-text">Pages</span></a> --}}
            {{-- <ul aria-expanded="false"> --}}
            {{-- <li><a href="./page-register.html">Register</a></li> --}}
            {{-- <li><a href="./page-login.html">Login</a></li> --}}
            {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a> --}}
            {{-- <ul aria-expanded="false"> --}}
            {{-- <li><a href="./page-error-400.html">Error 400</a></li> --}}
            {{-- <li><a href="./page-error-403.html">Error 403</a></li> --}}
            {{-- <li><a href="./page-error-404.html">Error 404</a></li> --}}
            {{-- <li><a href="./page-error-500.html">Error 500</a></li> --}}
            {{-- <li><a href="./page-error-503.html">Error 503</a></li> --}}
            {{-- </ul> --}}
            {{-- </li> --}}
            {{-- <li><a href="./page-lock-screen.html">Lock Screen</a></li> --}}
            {{-- </ul> --}}
            {{-- </li> --}}
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->
