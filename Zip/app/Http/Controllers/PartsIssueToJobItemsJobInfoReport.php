<?php

namespace App\Http\Controllers;

use App\Models\PartsModel;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PartsIssueToJobItemsJobInfoReport extends Controller
{
    function __construct()
    {
        $this->middleware('permission:issue-parts-report', ['only' => ['index', 'show']]);
    }

    public function index(Request $request)
    {
        $ar = json_decode($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;
        $auth = Auth::user();

        $datas = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where('technician.company_id', $auth->company_id)
            ->leftJoin('issue_parts_to_job', 'job_information.job_id', '=', 'issue_parts_to_job.iptj_job_no')
            ->where('issue_parts_to_job.company_id', $auth->company_id)
            ->leftJoin('issue_parts_to_job_items', 'issue_parts_to_job_items.iptji_iptj_id', '=', 'issue_parts_to_job.iptj_id')
            ->where('issue_parts_to_job_items.company_id', $auth->company_id)
            ->leftJoin('parts', 'parts.par_id', '=', 'issue_parts_to_job_items.iptji_parts')
            ->where('parts.company_id', $auth->company_id)
            ->select('job_information.job_id', 'job_information.ji_job_status', 'job_information.ji_recieve_datetime', 'job_information.ji_warranty_status', 'job_information.ji_estimated_cost', 'job_issue_to_technician.jitt_technician', 'job_issue_to_technician.jitt_id', 'technician.tech_id', 'technician.tech_name', 'issue_parts_to_job.iptj_id', 'parts.par_id', 'parts.par_purchase_price', 'parts.par_total_qty', 'parts.par_name', 'issue_parts_to_job_items.iptji_qty', 'issue_parts_to_job.iptj_remarks', 'issue_parts_to_job.iptj_status', 'issue_parts_to_job.issue_against_damage');
        // ->first();
        // dd($datas);
        // ->orderBy('job_id', 'Desc');

        $query = $datas;

        $job_no = $request->job_no;
        $status = $request->status;
        $tech_name = $request->tech_name;
        $client_number = $request->client_number;
        $warranty = $request->warranty;
        $parts = $request->parts;
        $damage = $request->damage;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $start = date('Y-m-d', strtotime($from_date));
        $end = date('Y-m-d', strtotime($to_date));

        $tech_title = Technician::where('tech_status', 1)
            ->where('company_id', $auth->company_id)
            ->get();

        $parts_title = PartsModel::where('par_status', 'Opening')
            ->where('company_id', $auth->company_id)
            ->get();
        // dd($parts_title);

        // if ($request->warranty == '0') {
        //     //    dd($request->warranty);
        //     $query->whereNull('job_information.ji_warranty_status');
        //     //            dd($query->get());
        // }
        if (isset($request->damage)) {
            $query->Where('issue_parts_to_job.issue_against_damage', '=', $request->damage);
        }
        if (isset($request->warranty)) {
            // dd($request->warranty);
            $query->Where('job_information.ji_warranty_status', '=', $request->warranty);
        }

        if (isset($request->job_no)) {
            $query->Where('job_information.job_id', '=', $request->job_no);
        }
        if (isset($request->tech_name)) {
            $query->Where('technician.tech_id', '=', $request->tech_name);
        }

        if (isset($request->parts)) {
            $query->Where('parts.par_id', '=', $request->parts);
        }
        if (isset($request->status)) {
            $query->Where('issue_parts_to_job.iptj_status', '=', $request->status);
        }

        if (!empty($request->from_date) && !empty($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '>=', $start)->whereDate('job_information.ji_recieve_datetime', '<=', $end);
        } elseif (isset($request->from_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('job_information.ji_recieve_datetime', '=', $end);
        }

        // $query = $query->toSql();
        // dd($query);
        $query = $query->orderBy('ji_id', 'DESC')->paginate($pagination_number);
        //  dd($datas,$datass);

        return view('reports/Job_Info_Job_Issue_Parts_Items_Report', compact('damage', 'job_no', 'parts', 'parts_title', 'status', 'from_date', 'to_date', 'warranty', 'query', 'tech_name', 'tech_title'))->with('pageTitle', 'Issue Parts Report');
    }
}
