<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Technician;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobInfoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:detail-job-information-list', ['only' => ['index', 'show']]);
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

        //        dd($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;

        $datas = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', function ($join) use ($auth) {
                $join->on('job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')->where('job_issue_to_technician.company_id', $auth->company_id);
            })
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where(function ($query) use ($auth) {
                $query->where('technician.company_id', $auth->company_id)->orWhereNull('technician.company_id');
            })
            ->leftJoin('users', 'users.id', '=', 'job_information.ji_user_id')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('users as user', 'user.id', '=', 'job_information.job_delivered_by')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('vendor', function ($join) {
                $join->on('vendor.vendor_id', '=', 'job_information.ji_vendor')
                    ->whereNotNull('job_information.ji_vendor');
            })
            ->leftJoin('brands', 'brands.bra_id', '=', 'job_information.ji_bra_id')
            ->where('brands.company_id', $auth->company_id)
            ->leftJoin('categories', 'categories.cat_id', '=', 'job_information.ji_cat_id')
            ->where('categories.company_id', $auth->company_id)
            ->leftJoin('model_table', 'model_table.mod_id', '=', 'job_information.ji_mod_id')
            ->where('model_table.company_id', $auth->company_id)
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            ->where('client.company_id', $auth->company_id)
//             ->where('job_information.job_id', 97)
            ->select('job_information.*', 'users.*', 'vendor.*', 'brands.*', 'job_issue_to_technician.*', 'technician.*', 'categories.*', 'model_table.*', 'client.*', 'user.name as user_name');
        // ->distinct();
//         dd($datas->get());
        // ->orderBy('ji_id', 'Desc');
        // farhad add
        // Pluck sto_job_id values
        $stoJobIds = $datas->pluck('job_id')->toArray();

        // Filter non-null values
        $nonNullJobIds = array_filter($stoJobIds, function ($value) {
            return $value !== null;
        });

        // Dump the result
        $tech_names = DB::table('job_issue_to_technician')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where('technician.company_id', $auth->company_id)
            ->select('technician.tech_name', 'technician.tech_id', 'job_issue_to_technician.jitt_job_no') // Add other columns as needed
            ->get();
        $query = $datas;

        // $query = $query->get();
        // dd($query,$tech_names);
        $complain_items = DB::table('job_information_items')
            ->where('job_information_items.company_id', $auth->company_id)
            ->select(DB::raw("jii_ji_job_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Complain')
            ->groupBy('jii_ji_job_id')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->where('job_information_items.company_id', $auth->company_id)
            ->select(DB::raw("jii_ji_job_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Accessory')
            ->groupBy('jii_ji_job_id')
            ->get();

        $job_no = $request->job_no;
        $status = $request->status;
        $client_name = $request->client_name;
        $client_number = $request->client_number;
        $warranty = $request->warranty;
        $tech_name = $request->tech_name;
        $job_delivery = $request->job_delivery;
        $vendor_name = $request->vendor_name;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $start = date('Y-m-d', strtotime($from_date));
        $end = date('Y-m-d', strtotime($to_date));

        // if ($request->warranty == '0') {
        //     //            dd($request->warranty);
        //     $query->whereNull('job_information.ji_warranty_status');
        //     //            dd($query->get());
        // }

        if (isset($request->tech_name)) {
            $query->where('technician.tech_name', '=', $request->tech_name);
        }
        if (isset($request->job_delivery)) {
            $query->where('job_information.job_delivery_status', '=', $request->job_delivery);
        }
        if (isset($request->warranty)) {
            $query->where('job_information.ji_warranty_status', '=', $request->warranty);
        }
        if (isset($request->vendor_name)) {
            $query->where('vendor.vendor_name', '=', $request->vendor_name);
        }
        if (isset($request->job_no)) {
            $query->where('job_information.job_id', '=', $request->job_no);
        }
        if (isset($request->status)) {
            $query->where('job_information.ji_job_status', '=', $request->status);
        }
        if (isset($request->client_name)) {
            $query->where('client.cli_name', '=', $request->client_name);
        }
        if (isset($request->client_number)) {
            $query->where('client.cli_number', 'like', '%' . $request->client_number . '%');
        }
        //        dd($query->get());

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

        $tech_title = Technician::where('tech_status', 1)
            ->where('technician.company_id', $auth->company_id)
            ->get();
        $warrenty_vendor = DB::table('vendor')
            ->where('vendor.company_id', $auth->company_id)
            ->get();
        $company_profile = CompanyProfile::where('company_id', $auth->company_id)->first();
        //        if (isset($request->array) && !empty($request->array)) {
        if ($request->pdf_download == '1') {
            $query = $query->orderBy('ji_id', 'DESC')->get();

            $pdf = PDF::loadView($prnt_page_dir, compact('query', 'pge_title', 'complain_items', 'accessory_items', 'job_delivery','company_profile'));
            return $pdf->stream($pge_title . '_x.pdf');
            $pdf->setPaper('A4', 'Landscape');
        } else {
            // $query = $query->get();
            // $query = $query->toSql();
            // dd($query);
            $query = $query->orderBy('ji_id', 'DESC')->paginate($pagination_number);
            return view('job_info.add_job_info_list_new', compact('tech_names', 'warrenty_vendor', 'vendor_name', 'tech_title', 'client_title', 'job_no', 'status', 'client_name', 'client_number', 'from_date', 'job_delivery', 'to_date', 'query', 'complain_items', 'accessory_items', 'warranty', 'tech_name'))->with('pageTitle', 'Job Information Detail List');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
