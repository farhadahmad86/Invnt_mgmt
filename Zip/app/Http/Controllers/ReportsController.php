<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Technician;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Exports\WarrantyVendorReportExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Excel as ExcelExcel;

class ReportsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:time-report', ['only' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $ar = json_decode($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;
        $auth = Auth::user();
        $datas = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'job_information.ji_user_id')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('job_close', 'job_close.jc_job_no', '=', 'job_information.job_id')
            ->where('job_close.company_id', $auth->company_id)
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where('technician.company_id', $auth->company_id)
            ->leftJoin('brands', 'brands.bra_id', '=', 'job_information.ji_bra_id')
            ->where('brands.company_id', $auth->company_id)
            ->leftJoin('categories', 'categories.cat_id', '=', 'job_information.ji_cat_id')
            ->where('categories.company_id', $auth->company_id)
            ->leftJoin('model_table', 'model_table.mod_id', '=', 'job_information.ji_mod_id')
            ->where('model_table.company_id', $auth->company_id)
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            ->where('client.company_id', $auth->company_id)
            ->where('ji_job_status', '!=', 'Pending');
        // ->orderBy('ji_id', 'Desc');

        $complain_items = DB::table('job_information_items')
            ->where('company_id', $auth->company_id)
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Complain')
            ->groupBy('jii_ji_id')
            ->orderBy('jii_id', 'Desc')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->where('company_id', $auth->company_id)
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Accessory')
            ->groupBy('jii_ji_id')
            ->orderBy('jii_id', 'Desc')
            ->get();

        $job_no = $request->job_no;
        $status = $request->status;
        $tech_name = $request->tech_name;
        $client_number = $request->client_number;
        $warranty = $request->warranty;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $start = date('Y-m-d', strtotime($from_date));
        $end = date('Y-m-d', strtotime($to_date));

        $query = $datas;

        if (isset($request->warranty)) {
            $query->orWhere('job_information.ji_warranty_status', 'like', '%' . $request->warranty . '%');
        }

        if (isset($request->status)) {
            $query->where('job_information.ji_job_status', 'like', '%' . $request->status . '%');
        }
        if (isset($request->job_no)) {
            $query->where('job_information.job_id', '=', $request->job_no);
        }
        if (isset($request->tech_name)) {
            $query->where('technician.tech_name', 'like', '%' . $request->tech_name . '%');
        }

        if (!empty($request->from_date) && !empty($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=', $start)->whereDate('job_information.ji_recieve_datetime', '<=', $end);
        } elseif (isset($request->from_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $end);
        }
        $tech_title = Technician::where('tech_status', 1)
            ->where('company_id', $auth->company_id)
            ->get();

        // $query = $query->get();
        $query = $query->orderBy('ji_id', 'DESC')->paginate($pagination_number);

        return view('reports/technician_job_info_report', compact('tech_title', 'job_no', 'status', 'tech_name', 'client_number', 'from_date', 'to_date', 'query', 'complain_items', 'accessory_items', 'warranty'))->with('pageTitle', 'Time Report');
    }

    public function warranty_vendor_report(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $job_no = !isset($request->job_no) && empty($request->job_no) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->job_no;
        $client_name = !isset($request->client_name) && empty($request->client_name) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->client_name;
        $job_title = !isset($request->job_title) && empty($request->job_title) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->job_title;
        $vendor_name = !isset($request->vendor_name) && empty($request->vendor_name) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->vendor_name;
        $brand = !isset($request->brand) && empty($request->brand) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->brand;
        $category = !isset($request->category) && empty($request->category) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->category;
        $model = !isset($request->model) && empty($request->model) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->model;
        $equipment = !isset($request->equipment) && empty($request->equipment) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->equipment;
        $serial_no = !isset($request->serial_no) && empty($request->serial_no) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->serial_no;
        $fault = !isset($request->fault) && empty($request->fault) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->fault;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[6]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[7]->{'value'} : '') : $request->to_date;
        $prnt_page_dir = 'modal_views.warranty_vendor_report';
        $pge_title = 'Job Information Report';
        $srch_fltr = [];
        array_push($srch_fltr, $job_no, $job_title, $vendor_name, $client_name, $brand, $equipment, $serial_no, $fault, $category, $model, $from_date, $to_date);
        $pagination_number = empty($ar) ? 30 : 100000000;

        $datas = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('vendor', 'vendor.vendor_id', '=', 'job_information.ji_vendor')
            ->leftJoin('brands', 'brands.bra_id', '=', 'job_information.ji_bra_id')
            ->where('brands.company_id', $auth->company_id)
            ->leftJoin('categories', 'categories.cat_id', '=', 'job_information.ji_cat_id')
            ->where('categories.company_id', $auth->company_id)
            ->leftJoin('model_table', 'model_table.mod_id', '=', 'job_information.ji_mod_id')
            ->where('model_table.company_id', $auth->company_id)
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            ->where('client.company_id', $auth->company_id)
            ->leftJoin('sale_invoice_for_jobs', 'sale_invoice_for_jobs.sifj_job_no', '=', 'job_information.job_id')
            ->whereIn('ji_job_status', ['Close', 'Credit', 'Paid'])
            ->where('job_information.ji_warranty_status', 1)
//            ->where('job_information.job_delivery_status', 2)
            ->select('job_information.*', 'vendor.*', 'brands.*', 'categories.*', 'model_table.*', 'client.*', 'sale_invoice_for_jobs.sifj_amount_paid');
        // farhad add
        // Pluck sto_job_id values
        $stoJobIds = $datas->pluck('job_id')->toArray();

        // Filter non-null values
        $nonNullJobIds = array_filter($stoJobIds, function ($value) {
            return $value !== null;
        });
        $query = $datas;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $start = date('Y-m-d', strtotime($from_date));
        $end = date('Y-m-d', strtotime($to_date));
        if (isset($request->job_no)) {
            $query->where('job_information.job_id', '=', $request->job_no);
        }
        if (isset($request->client_name)) {
            $query->where('client.cli_name', '=', $request->client_name);
        }
        if (isset($request->job_title)) {
            $query->where('job_information.ji_title', '=', $job_title);
        }
        if (isset($request->vendor_name)) {
            $query->where('vendor.vendor_name', '=', $request->vendor_name);
        }
        if (isset($request->brand)) {
            $query->where('brands.bra_name', '=', $request->brand);
        }
        if (isset($request->category)) {
            $query->where('categories.cat_name', '=', $request->category);
        }
        if (isset($request->model)) {
            $query->where('model_table.mod_name', '=', $request->model);
        }
        if (isset($request->equipment)) {
            $query->where('job_information.ji_equipment', '=', $request->equipment);
        }
        if (isset($request->serial_no)) {
            $query->where('job_information.ji_serial_no', 'like', '%' . $request->serial_no . '%');
        }
        if (isset($request->fault)) {
            $fa = DB::table('job_information_items')
                ->where('job_information_items.company_id', $auth->company_id)
                ->where('jii_item_name',$request->fault)
                ->where('jii_status', '=', 'Complain')
                ->pluck('jii_ji_job_id');
            $query->whereIn('job_information.job_id', $fa);
        }
        if (!empty($request->from_date) && !empty($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=', $start)->whereDate('job_information.ji_recieve_datetime', '<=', $end);
            //            dd($query->get());
        } elseif (isset($request->from_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $end);
        }
        $job_no_title = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->pluck('ji_title');
        $client_title = DB::table('client')
            ->leftJoin('users', 'users.id', '=', 'client.cli_user_id')
            ->where('client.company_id', $auth->company_id)
            ->get();
        $warrenty_vendor = DB::table('vendor')
            ->where('vendor.company_id', $auth->company_id)
            ->get();
        $brand_title = DB::table('brands')
            ->where('brands.company_id', $auth->company_id)
            ->get();
        $category_title = DB::table('categories')
            ->where('categories.company_id', $auth->company_id)
            ->get();
        $model_title = DB::table('model_table')
            ->where('model_table.company_id', $auth->company_id)
            ->get();
        $equipment_title = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->groupBy('ji_equipment')
            ->pluck('ji_equipment');
        $serial_no_title = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->groupBy('ji_serial_no')
            ->pluck('ji_serial_no');
        $fault_title = DB::table('job_information_items')
            ->where('job_information_items.company_id', $auth->company_id)
            ->where('jii_status', '=', 'Complain')
            ->select('jii_item_name', DB::raw('count(*) as total'))
            ->groupBy('jii_item_name')
            ->get();
        if ($request->pdf_download == '1') {

            $query = $query->orderBy('ji_id', 'DESC')->get();
            $pdf = PDF::loadView($prnt_page_dir, compact('query', 'pge_title', 'fault', 'company_profile'));
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream($pge_title . '_x.pdf');
        } else if ($request->export == 'excel') {
            $query = $query->orderBy('ji_id', 'DESC')->get();
            return Excel::download(new WarrantyVendorReportExport($query, $srch_fltr, $prnt_page_dir, $pge_title), $pge_title . '.xlsx');
        } else {
            //$query = $query->get();
            // $query = $query->toSql();
            //dd($query);
            $query = $query->orderBy('ji_id', 'DESC')->paginate($pagination_number);
            return view('reports.warrenty_vendor_report', compact('warrenty_vendor', 'vendor_name', 'equipment', 'equipment_title', 'client_title', 'job_no', 'client_name', 'from_date', 'to_date', 'query', 'fault_title', 'fault', 'serial_no_title', 'serial_no', 'job_title', 'job_no_title', 'brand', 'brand_title', 'category', 'category_title', 'model', 'model_title'))->with('pageTitle', 'Job Information Detail List');
        }
    }
}
