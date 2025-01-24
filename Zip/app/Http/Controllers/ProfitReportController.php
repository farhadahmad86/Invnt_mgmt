<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfitReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:profit-report', ['only' => ['index', 'show']]);
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
            // ->select('job_information.ji_job_status')
            ;
            // $datas = $datas->get();

            $query = $datas;
            // dd($query);

        $issue = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where('technician.company_id', $auth->company_id)
            ->leftJoin('issue_parts_to_job as issue_parts_to_job_issued', 'job_information.job_id', '=', 'issue_parts_to_job_issued.iptj_job_no')
            ->where('issue_parts_to_job_issued.company_id', $auth->company_id)
            ->leftJoin('issue_parts_to_job_items as items_issued', 'items_issued.iptji_iptj_id', '=', 'issue_parts_to_job_issued.iptj_id')
            ->where('items_issued.company_id', $auth->company_id)
            ->leftJoin('parts as parts_issued', 'parts_issued.par_id', '=', 'items_issued.iptji_parts')
            ->where('parts_issued.company_id', $auth->company_id)
            ->select('job_id', DB::raw('SUM(items_issued.iptji_amount) as total_issue'))
            ->where('issue_parts_to_job_issued.iptj_status', '=', 'Issued')
            ->groupBy('job_id')
            ->orderBy('ji_id', 'Desc')
            ->get();

        $retured = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where('technician.company_id', $auth->company_id)
            ->leftJoin('issue_parts_to_job as issue_parts_to_job_return', 'job_information.job_id', '=', 'issue_parts_to_job_return.iptj_job_no')
            ->where('issue_parts_to_job_return.company_id', $auth->company_id)
            ->leftJoin('issue_parts_to_job_items as items_return', 'items_return.iptji_iptj_id', '=', 'issue_parts_to_job_return.iptj_id')
            ->where('items_return.company_id', $auth->company_id)
            ->leftJoin('parts as parts_return', 'parts_return.par_id', '=', 'items_return.iptji_parts')
            ->where('parts_return.company_id', $auth->company_id)
            ->select('job_id', DB::raw('SUM(items_return.iptji_amount) as total_return'))
            ->where('issue_parts_to_job_return.iptj_status', '=', 'Returned')
            ->groupBy('job_id')
            ->orderBy('ji_id', 'Desc')
            ->get();

        //        $issue = $datas->select([DB::raw("SUM(iptji_amount) as total_amount")])->groupBy('ji_id')->where('iptj_status','=','Issued');
        //        $retured = $datas->select([DB::raw("SUM(iptji_amount) as total_amount")])->groupBy('ji_id')->where('iptj_status','=','Returned');
        //       $abc =  $datas->where('iptji_iptj_id','=',3)->get();//->select('ji_id',DB::raw("SUM(ji_estimated_cost) as cc"),DB::raw("SUM(iptji_qty * par_purchase_price) as total_qty"))->groupBy('ji_id')->get();
        //        $datas->select(("par_purchase_price"));
        //        dd($issue->get());
        //        dd($retured);



        $job_no = $request->job_no;
        $status = $request->status;
        $tech_name = $request->tech_name;
        $tech_number = $request->tech_number;
        $warranty = $request->warranty;

        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $start = date('Y-m-d', strtotime($from_date));
        $end = date('Y-m-d', strtotime($to_date));

        // if ($request->warranty == '0') {
        //     //            dd($request->warranty);
        //     $query->whereNull('job_information.ji_warranty_status');
        //     //            dd($query->get());
        // }

        if (isset($request->warranty)) {
            $query->where('job_information.ji_warranty_status', '=', $request->warranty);
        }
        if (isset($request->job_no)) {
            $query->where('job_information.job_id', '=', $request->job_no);
        }
        if (isset($request->status)) {
            $query->where('job_information.ji_job_status', '=', $request->status);
        }
        if (isset($request->tech_name)) {
            $query->where('technician.tech_id', '=', $request->tech_name);
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

        $tech_title = Technician::where('tech_status', 1)
        ->where('company_id', $auth->company_id)
        ->get();
        // dd($query);
        // $query = $query->toSql();
        // $query = $query->get();

        // dd($query, $retured, $issue);
        $query = $query->orderBy('ji_id', 'DESC')->paginate($pagination_number);
        //  dd($datas);

        return view('reports/profit_report', compact('tech_title', 'job_no', 'status', 'from_date', 'to_date', 'warranty', 'query', 'issue', 'retured', 'tech_name'))->with('pageTitle', 'Profit Report');
    }
}
