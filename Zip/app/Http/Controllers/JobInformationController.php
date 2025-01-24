<?php

namespace App\Http\Controllers;

use App\Exports\ExcelFileCusExport;
use App\Jobs\GenerateJobReportPDF;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ClientModel;
use App\Models\CompanyProfile;
use App\Models\JobInformationItemsModel;
use App\Models\JobInformationModel;
use App\Models\JobTransfer;
use App\Models\Modal;
use App\Models\ModelTable;
use App\Models\VendorModel;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use function GuzzleHttp\Promise\all;

class JobInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:job-information-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:job-information-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:job-information-edit', ['only' => ['edit', 'update']]);
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $job_no = !isset($request->job_no) && empty($request->job_no) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->job_no;
        $status = !isset($request->status) && empty($request->status) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->status;
        $warranty = !isset($request->warranty) && empty($request->warranty) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->warranty;
        $client_name = !isset($request->client_name) && empty($request->client_name) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->client_name;
        $client_number = !isset($request->client_number) && empty($request->client_number) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->client_number;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[6]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[7]->{'value'} : '') : $request->to_date;

        $search_by_user = isset($request->search_by_user) && !empty($request->search_by_user) ? $request->search_by_user : '';
        $prnt_page_dir = 'modal_views.job_report';
        $pge_title = 'Job Information Report';
        $srch_fltr = [];
        array_push($srch_fltr, $job_no, $status, $warranty, $client_name, $client_number, $from_date, $to_date);
        // dd($srch_fltr);
        //        dd($request->array);

        $pagination_number = empty($ar) ? 30 : 100000000;

        $datas = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'job_information.ji_user_id')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('users as user', 'user.id', '=', 'job_information.job_delivered_by')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('vendor', 'vendor.vendor_id', '=', 'job_information.ji_vendor')
            // ->where('vendor.company_id', $auth->company_id)
            ->leftJoin('brands', 'brands.bra_id', '=', 'job_information.ji_bra_id')
            ->where('brands.company_id', $auth->company_id)
            ->leftJoin('categories', 'categories.cat_id', '=', 'job_information.ji_cat_id')
            ->where('categories.company_id', $auth->company_id)
            ->leftJoin('model_table', 'model_table.mod_id', '=', 'job_information.ji_mod_id')
            ->where('model_table.company_id', $auth->company_id)
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            ->where('client.company_id', $auth->company_id)
            ->select('job_information.*', 'users.*', 'vendor.*', 'brands.*', 'categories.*', 'model_table.*', 'client.*', 'user.name as user_name');
        // $datas = DB::table('job_information')
        //     ->leftJoin('users', 'users.id', '=', 'job_information.ji_user_id')
        //     ->leftJoin('vendor', 'vendor.vendor_id', '=', 'job_information.ji_vendor')
        //     ->leftJoin('brands', 'brands.bra_id', '=', 'job_information.ji_bra_id')
        //     ->leftJoin('categories', 'categories.cat_id', '=', 'job_information.ji_cat_id')
        //     ->leftJoin('model_table', 'model_table.mod_id', '=', 'job_information.ji_mod_id')
        //     ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id');
        // ->orderBy('ji_id', 'Desc');

        //
        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_job_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Complain')
            ->where('job_information_items.company_id', $auth->company_id)
            ->groupBy('jii_ji_job_id')
            ->orderBy('jii_ji_job_id', 'Desc')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_job_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Accessory')
            ->where('job_information_items.company_id', $auth->company_id)
            ->groupBy('jii_ji_job_id')
            ->orderBy('jii_ji_job_id', 'Desc')
            ->get();

        $job_no = $request->job_no;
        $status = $request->status;
        $client_name = $request->client_name;
        $client_number = $request->client_number;
        $warranty = $request->warranty;
        $vendor_name = $request->vendor_name;

        // $from_date = $request->from_date;
        // $to_date = $request->to_date;

        $start = date('Y-m-d', strtotime($from_date));

        $end = date('Y-m-d', strtotime($to_date));
        // dd($to_date);

        $query = $datas;

        // if ($request->warranty == '0') {
        //     //            dd($request->warranty);
        //     $query->whereNull('job_information.ji_warranty_status');
        //     //    dd($query->get());
        // }

        if (isset($request->vendor_name)) {
            $query->where('vendor.vendor_name', '=', $request->vendor_name);
        }

        if (isset($request->warranty)) {
            $query->where('job_information.ji_warranty_status', '=', $request->warranty);
        }

        if (isset($request->job_no)) {
            $query->where('job_information.job_id', '=', $request->job_no);
        }
        if (!empty($request->status) && !empty($request->client_name)) {
            $query->where('job_information.ji_job_status', '=', $request->status)->where('client.cli_name', '=', $request->client_name);
            //    dd($query->get());
        } elseif (isset($request->status)) {
            $query->where('job_information.ji_job_status', '=', $request->status);
        } elseif (isset($request->client_name)) {
            $query->where('client.cli_name', '=', $request->client_name);
        }
        if (isset($request->client_number)) {
            $query->where('client.cli_number', 'like', '%' . $request->client_number . '%');
        }

        if (!empty($request->from_date) && !empty($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=', $start)->whereDate('job_information.ji_recieve_datetime', '<=', $end);
            //            dd($query->get());
        } elseif (isset($request->from_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $end);
        }
        $client_title = DB::table('client')
            ->leftJoin('users', 'users.id', '=', 'client.cli_user_id')
            ->where('client.company_id', $auth->company_id)
            ->get();
        $warrenty_vendor = DB::table('vendor')
            ->where('vendor.company_id', $auth->company_id)
            ->get();
        $company_profile = CompanyProfile::where('company_id', $auth->company_id)->first();
        // $query = $query->take(30)->get();

        //        if (isset($request->array) && !empty($request->array)) {
        if ($request->pdf_download == '1') {
            $query = $query->orderBy('ji_id', 'DESC')->get();
            $pdf = PDF::loadView($prnt_page_dir, compact('query', 'pge_title', 'complain_items', 'accessory_items','company_profile'));
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream($pge_title . '_x.pdf');
            // $data = [
            //     'query' => $query,
            //     'pge_title' => $pge_title,
            //     'complain_items' => $complain_items,
            //     'accessory_items' => $accessory_items,
            // ];

            // GenerateJobReportPDF::dispatch($data)->onQueue('pdf'); // You can specify a queue name if needed

            // return response()->json(['message' => 'PDF generation queued.']);
        } else {
            // dd($query->get());
            $query = $query
                ->where('job_information.company_id', $auth->company_id)
                ->orderBy('ji_id', 'DESC')
                ->paginate($pagination_number);
            return view('job_info.job_info_list_new', compact('client_title', 'job_no', 'status', 'client_name', 'client_number', 'from_date', 'to_date', 'query', 'complain_items', 'accessory_items', 'warranty', 'vendor_name', 'warrenty_vendor'))
                ->with('pageTitle', 'Job Information List')
                ->render();
        }
    }
    public function load(Request $request)
    {
        $datas = DB::table('job_information')
            ->leftJoin('users', 'users.id', '=', 'job_information.ji_user_id')
            ->leftJoin('vendor', 'vendor.vendor_id', '=', 'job_information.ji_vendor')
            ->leftJoin('brands', 'brands.bra_id', '=', 'job_information.ji_bra_id')
            ->leftJoin('categories', 'categories.cat_id', '=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id', '=', 'job_information.ji_mod_id')
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            ->orderBy('ji_id', 'Desc');

        //
        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Complain')
            ->groupBy('jii_ji_id')
            ->orderBy('jii_ji_id', 'Desc')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Accessory')
            ->groupBy('jii_ji_id')
            ->orderBy('jii_ji_id', 'Desc')
            ->get();

        $query = $datas;
        $query = $query->take(30)->get();
        return response()->json($query);
    }

    public function index1(Request $request)
    {
        $ar = json_decode($request->array);
        $job_no = !isset($request->job_no) && empty($request->job_no) ? (!empty($ar) ? $ar[1]->{'value'} : '') : $request->job_no;
        $status = !isset($request->status) && empty($request->status) ? (!empty($ar) ? $ar[2]->{'value'} : '') : $request->status;
        $warranty = !isset($request->warranty) && empty($request->warranty) ? (!empty($ar) ? $ar[3]->{'value'} : '') : $request->warranty;
        $client_name = !isset($request->client_name) && empty($request->client_name) ? (!empty($ar) ? $ar[4]->{'value'} : '') : $request->client_name;
        $client_number = !isset($request->client_number) && empty($request->client_number) ? (!empty($ar) ? $ar[5]->{'value'} : '') : $request->client_number;
        $from_date = !isset($request->from_date) && empty($request->from_date) ? (!empty($ar) ? $ar[6]->{'value'} : '') : $request->from_date;
        $to_date = !isset($request->to_date) && empty($request->to_date) ? (!empty($ar) ? $ar[7]->{'value'} : '') : $request->to_date;

        $search_by_user = isset($request->search_by_user) && !empty($request->search_by_user) ? $request->search_by_user : '';
        $prnt_page_dir = 'modal_views.job_report';
        $pge_title = 'Job Information Report';
        $srch_fltr = [];
        array_push($srch_fltr, $job_no, $status, $warranty, $client_name, $client_number, $from_date, $to_date);

        //        dd($request->array);

        $datas = DB::table('job_information')
            ->leftJoin('users', 'users.id', '=', 'job_information.ji_user_id')
            ->leftJoin('vendor', 'vendor.vendor_id', '=', 'job_information.ji_vendor')
            ->leftJoin('brands', 'brands.bra_id', '=', 'job_information.ji_bra_id')
            ->leftJoin('categories', 'categories.cat_id', '=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id', '=', 'job_information.ji_mod_id')
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            ->orderBy('ji_id', 'Desc');

        //
        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Complain')
            ->groupBy('jii_ji_id')
            ->orderBy('jii_id', 'Desc')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Accessory')
            ->groupBy('jii_ji_id')
            ->orderBy('jii_id', 'Desc')
            ->get();

        $job_no = $request->job_no;
        $status = $request->status;
        $client_name = $request->client_name;
        $client_number = $request->client_number;
        $warranty = $request->warranty;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $from_date = date('Y-m-d', strtotime($from_date));
        $to_date = date('Y-m-d', strtotime($to_date));

        $query = $datas;

        if ($request->warranty == '0') {
            //            dd($request->warranty);
            $query->whereNull('job_information.ji_warranty_status');
            //            dd($query->get());
        }

        if (isset($request->warranty)) {
            $query->orWhere('job_information.ji_warranty_status', 'like', '%' . $request->warranty . '%');
        }

        if (isset($request->job_no)) {
            $query->orWhere('job_information.ji_id', 'like', '%' . $request->job_no . '%');
        }
        if (isset($request->status)) {
            $query->where('job_information.ji_job_status', '=', $request->status);
        }
        if (isset($request->client_name)) {
            $query->orWhere('client.cli_name', 'like', '%' . $request->client_name . '%');
        }
        if (isset($request->client_number)) {
            $query->orWhere('client.cli_number', 'like', '%' . $request->client_number . '%');
        }
        //        dd($query->get());

        if (!empty($request->from_date) && !empty($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=', $from_date)->whereDate('job_information.ji_recieve_datetime', '<=', $to_date);
            //            dd($query->get());
        } elseif (isset($request->from_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=', $from_date);
        } elseif (isset($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '<=', $to_date);
        }

        $query = $query->get();

        //        if (isset($request->array) && !empty($request->array)) {
        if ($request->pdf_download == '1') {
            $pdf = SnappyPdf::loadView($prnt_page_dir, compact('query', 'pge_title', 'complain_items', 'accessory_items'));

            return $pdf->stream($pge_title . '_x.pdf');
        } else {
            return view('job_info.add_job_info_list_new', compact('job_no', 'status', 'client_name', 'client_number', 'from_date', 'to_date', 'query', 'complain_items', 'accessory_items', 'warranty'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();

        $vendors = VendorModel::where('company_id', $auth->company_id)->get();
        $categories = Category::where('company_id', $auth->company_id)->get();
        $brands = Brand::where('company_id', $auth->company_id)->get();
        $models = ModelTable::where('company_id', $auth->company_id)->get();

        $job_id = JobInformationModel::where('company_id', $auth->company_id)->max('job_id');

        // If no records are found, set $job_id to 1, otherwise increment by 1
        $job_id = $job_id ? $job_id + 1 : 1;

        // dd($job_id);

        return view('job_info.job_info_new', compact('categories', 'brands', 'models', 'job_id', 'vendors'))->with('pageTitle', 'Create Job Information');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        global $ji_id;
//         dd($request->all());
        $auth = Auth::user();

        $this->validate($request, [
            'number' => 'required',
            'client_name' => 'required',
            //            'estimated_cost' => 'required|integer|min:0',
        ]);
        $JobTitle = JobInformationModel::where('ji_title', $request->job_title)
            ->whereNotIn('ji_job_status', ['Close', 'Paid'])
            ->where('company_id', $auth->company_id)
            ->count();
//        dd($JobTitle);
        if($JobTitle != 0){
            return redirect()->back()->with('fail', 'This Job Title Is Also Used ' . $request->job_title);
        }
        DB::transaction(function () use ($request, $ji_id) {
            $auth = Auth::user();
            if (
                $clients = ClientModel::where('cli_number', '=', $request->number)
                    ->where('company_id', $auth->company_id)
                    ->exists()
            ) {
                $clients = ClientModel::where('cli_number', '=', $request->number)
                    ->where('company_id', $auth->company_id)
                    ->first();
                //            dd($request->number);
            } else {
                $clients = new ClientModel();
                //            dd("new");
            }

            //        $job_id = JobInformationModel::select("ji_id")->orderby('ji_id', "DESC")->first();

            //        dd($request->all());

            $clients->cli_name = ucwords($request->client_name);
            $clients->cli_number = $request->number;
            $clients->cli_address = $request->client_address;
            $clients->cli_user_id = $auth->id;
            $clients->company_id = $auth->company_id;
            $clients->save();

            $job_info = new JobInformationModel();

            $job_info->ji_cli_id = $clients->cli_id;
            $job_info->ji_delivery_datetime = $request->delivery_time;
            if (!isset($request->warrenty)) {
                // dd(1,$request->warrenty);
                $job_info->ji_warranty_status = 0;
            } else {
                // dd($request->warrenty,2);
                $job_info->ji_warranty_status = $request->warrenty;
            }
            $job_info->ji_title = $request->job_title;

            if ($request->warrenty == 1) {
                $job_info->ji_vendor = $request->wander;
            }

            //        $job_info->ji_vendor = $request->wander;
            // coding from shahzaib start
            $tbl_var_name = 'job_info';
            $prfx = 'ji';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $job_info->ji_bra_id = $request->brand;
            $job_id = JobInformationModel::where('company_id', $auth->company_id)->max('job_id');

            // If no records are found, set $job_id to 1, otherwise increment by 1
            $job_id = $job_id ? $job_id + 1 : 1;
            $job_info->job_id = $job_id;
            $job_info->job_created_by = $auth->id;
            $job_info->ji_mod_id = $request->model;
            $job_info->ji_cat_id = $request->category;
            $job_info->ji_equipment = $request->equipment;
            $job_info->ji_serial_no = $request->serial_no;
            $job_info->ji_estimated_cost = isset($request->estimated_cost) ? $request->estimated_cost : 0;
            $job_info->ji_remaining = isset($request->estimated_cost) ? $request->estimated_cost : 0;
            $job_info->ji_amount_pay = 0;
            $job_info->ji_user_id = $auth->id;
            $job_info->company_id = $auth->company_id;
            $job_info->ji_job_status = 'Pending';
            $job_info->save();

            $complains = $request->complain_data;
            $accessories = $request->accessory_data;

            foreach ($complains as $index => $complain) {
                $job_item = new JobInformationItemsModel();
                $job_item->jii_ji_id = $job_info->ji_id;
                $job_item->jii_ji_job_id = $job_info->job_id;
                $job_item->jii_user_id = $auth->id;
                $job_item->company_id = $auth->company_id;
                $job_item->jii_item_name = $request->complain_data[$index];
                $job_item->jii_status = 'Complain';
                $job_item->save();
            }
            foreach ($accessories as $index => $accessory) {
                $job_item = new JobInformationItemsModel();
                $job_item->jii_ji_id = $job_info->ji_id;
                $job_item->jii_ji_job_id = $job_info->job_id;
                $job_item->jii_user_id = $auth->id;
                $job_item->company_id = $auth->company_id;
                $job_item->jii_item_name = $request->accessory_data[$index];
                $job_item->jii_status = 'Accessory';
                $job_item->save();
            }
            global $ji_id;
            $ji_id = $job_info->job_id;

            //        return redirect()->back()->with('success', 'Successfully Saved With Job ID:' . $job_info->ji_id);
        });
        //        return redirect()->route('job_issue_to_technician.create')->with('success', 'Successfully Saved With Job ID:' . $job_info->ji_id);
        return redirect()
            ->back()
            ->with('ji_id', $ji_id);
    }

    // Farhad add

    public function job_delivery()
    {
        $auth = Auth::user();
        $job_close = JobInformationModel::whereIn('ji_job_status', ['Close', 'Credit', 'Paid'])
            ->where('company_id', $auth->company_id)
            ->where('job_delivery_status', 1)
            ->get();

//            dd($job_close);

        return view('job_info.job_delivery', compact('job_close'))->with('pageTitle', 'Create Job Delivery');
    }

    public function job_delivery_save(Request $request)
    {
        // dd($request->all());
        $id = $request->select_job;
        DB::transaction(function () use ($request, $id) {
            $auth = Auth::user();
            // dd($auth);
            $job_info = JobInformationModel::where('job_id', $id)
                ->where('company_id', $auth->company_id)
                ->first();

            $job_info->job_delivery_status = 2;
            $job_info->job_delivered_by = $auth->id;
            $job_info->company_id = $auth->company_id;
            $job_info->save();
        });

        //        return redirect()->back()->with('success', 'Successfully Saved With Job ID:' . $job_info->job_id);
        return redirect()
            ->route('add_job_info_list.index')
            // ->back()
            ->with('success', 'Successfully Saved');
    }

    public function job_delivery_edit($id)
    {
        $auth = Auth::user();
        $job_close = JobInformationModel::where('company_id', $auth->company_id)
            ->where('job_id', '=', $id)
            ->get();

        //    dd($job_close);

        return view('job_info.job_delivery_edit', compact('job_close', 'id'))->with('pageTitle', 'Create Job Delivery');
    }
    public function job_delivery_update(Request $request)
    {
        // dd($request->all());
        $id = $request->select_job;
        DB::transaction(function () use ($request, $id) {
            $auth = Auth::user();
            // dd($auth);
            $job_info = JobInformationModel::where('job_id', $id)
                ->where('company_id', $auth->company_id)
                ->first();
            if ($request->delivered == 'on') {
                // dd($request->all(),'on');
                $job_info->job_delivery_status = 2;
                $job_info->job_delivered_by = $auth->id;
            } else {
                $job_info->job_delivery_status = 1;
                // dd($request->all());
                $job_info->job_delivered_by = null;
            }
            $job_info->company_id = $auth->company_id;
            $job_info->save();
        });

        //        return redirect()->back()->with('success', 'Successfully Saved With Job ID:' . $job_info->ji_id);
        return redirect()
            ->route('add_job_info_list.index')
            // ->back()
            ->with('success', 'Successfully Updated');
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth = Auth::user();

        $vendors = VendorModel::where('company_id', $auth->company_id)->get();
        $categories = Category::where('company_id', $auth->company_id)->get();
        $brands = Brand::where('company_id', $auth->company_id)->get();
        $models = ModelTable::where('company_id', $auth->company_id)->get();
        $clients = ClientModel::where('company_id', $auth->company_id)->get();

        $job_info = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            ->leftJoin('job_complaint', 'job_complaint.jc_id', '=', 'job_complaint.jc_complaint')
            ->leftJoin('job_accessories', 'job_accessories.ja_id', '=', 'job_accessories.ja_accessories')
            ->leftJoin('vendor', 'vendor.vendor_id', '=', 'job_information.ji_vendor')
            ->where('ji_id', '=', $id)
            ->get();
//dd($job_info);
        //        dd($job_info);

        //        foreach ($job_info as $value){
        //            return $value->cli_number;
        //        }

        //        $job_info = JobInformationModel::orderby('ji_id', "DESC")->first();

        //        $client_info = JobInformationModel::Where("ji_cli_id")->orderby('ji_id', "DESC")->first();

        //        dd($job_info);

        return view('job_info/edit_job_info', compact('categories', 'brands', 'models', 'job_info', 'clients', 'vendors'))->with('pageTitle', 'Edit Job Information');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
//         dd($request->all());
        DB::transaction(function () use ($request, $id) {
            $auth = Auth::user();
            if ($clients = ClientModel::where('cli_number', '=', $request->number)->where('company_id',$auth->company_id)->exists()) {
                // dd($request->all(),1);
                $clients = ClientModel::where('cli_number', '=', $request->number)->where('company_id',$auth->company_id)->first();
            } else {
                //            $clients = new ClientModel();
                // dd($request->all(),2);
                $clients = new ClientModel();
            }

            //        $job_id = JobInformationModel::select("ji_id")->orderby('ji_id', "DESC")->first();

            //        dd($request->all());

            $clients->cli_name = ucwords($request->client_name);
            $clients->cli_number = $request->number;
            $clients->cli_address = $request->client_address;
            $clients->cli_user_id = $auth->id;
            $clients->company_id = $auth->company_id;
// dd($clients,$id);
            $clients->save();

            //        $job_info = new JobInformationModel();
            $job_info = JobInformationModel::where('ji_id', $id)->where('company_id',$auth->company_id)->first();
            $job_info->ji_cli_id = $clients->cli_id;
            $job_info->ji_delivery_datetime = $request->delivery_time;
            // $job_info->job_id = $request->job_id;
            $job_info->ji_warranty_status = $request->warrenty;
            $job_info->ji_title = $request->job_title;
            $job_info->ji_vendor = $request->wander;
            $job_info->ji_bra_id = $request->brand;
            $job_info->ji_mod_id = $request->model;
            $job_info->ji_cat_id = $request->category;
            $job_info->ji_equipment = $request->equipment;
            $job_info->ji_serial_no = $request->serial_no;
            $job_info->ji_estimated_cost = $request->estimated_cost;
            $job_info->ji_user_id = $auth->id;
            $job_info->company_id = $auth->company_id;
            //        $job_info->ji_job_status = 'Pending';
            // coding from shahzaib start
            $tbl_var_name = 'job_info';
            $prfx = 'ji';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $job_info->save();

            $job_item_del = JobInformationItemsModel::where('jii_ji_id', '=', $id)->delete();

            $complains = $request->complain_data;
            $accessories = $request->accessory_data;
// dd($complains,$accessories);
            foreach ($complains as $index => $complain) {
                $job_item = new JobInformationItemsModel();
                $job_item->jii_ji_id = $job_info->ji_id;
                $job_item->jii_ji_job_id = $job_info->job_id;
                $job_item->jii_user_id = $auth->id;
                $job_item->company_id = $auth->company_id;
                $job_item->jii_item_name = $request->complain_data[$index];
                $job_item->jii_status = 'Complain';
                $job_item->save();
            }
            foreach ($accessories as $index => $accessory) {
                $job_item = new JobInformationItemsModel();
                $job_item->jii_ji_id = $job_info->ji_id;
                $job_item->jii_ji_job_id = $job_info->job_id;
                $job_item->jii_user_id = $auth->id;
                $job_item->company_id = $auth->company_id;
                $job_item->jii_item_name = $request->accessory_data[$index];
                $job_item->jii_status = 'Accessory';
                $job_item->save();
            }
        });

        //        return redirect()->back()->with('success', 'Successfully Saved With Job ID:' . $job_info->ji_id);
        return redirect()
            ->route('job_info.index')
            ->with('success', 'Successfully Updated');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
