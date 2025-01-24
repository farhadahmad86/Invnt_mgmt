<?php

namespace App\Http\Controllers;

use App\Models\JobInformationModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LabTechnicianReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:technisian-lab-report', ['only' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $datas = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'job_information.ji_user_id')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            // ->leftJoin('job_close', 'job_close.jc_job_no', '=', 'job_information.job_id')
            // // ->where('job_close.company_id', $auth->company_id)
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
            ->where('ji_job_status', '=', 'Assign')
            ->orderBy('ji_id', 'Desc');

        $complain_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Complain')
            ->groupBy('jii_ji_id')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Accessory')
            ->groupBy('jii_ji_id')
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
        // dd($query);

        $jobs = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where('technician.company_id', $auth->company_id)
            ->select([DB::raw('COUNT(ji_id) as total_jobs, tech_name')])
            ->where('ji_job_status', '=', 'Assign')
            ->groupBy('tech_name')
            ->get();

        //        dd($jobs);

        //        $jobs = JobInformationModel::where("ji_created_at",">=",$current_date)
        //            ->select([DB::raw("COUNT(ji_id) as total_jobs, tech_name")])
        ////            ->groupBy('id')
        //            ->get();

        return view('reports/technician_lab_report', compact('jobs', 'job_no', 'status', 'client_name', 'client_number', 'from_date', 'to_date', 'query', 'complain_items', 'accessory_items', 'warranty'))->with('pageTitle', 'Technician Lab Report');
    }
}
