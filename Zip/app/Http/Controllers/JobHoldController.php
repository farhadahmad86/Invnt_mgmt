<?php

namespace App\Http\Controllers;

use App\Models\JobCloseModel;
use App\Models\JobCloseReasonModel;
use App\Models\JobHoldModel;
use App\Models\JobHoldReason;
use App\Models\JobInformationModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobHoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:job-hold-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:job-hold-create', ['only' => ['create', 'store']]);
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;
        // $datas = JobHoldModel::all();

        $datas = DB::table('job_hold')
            ->where('job_hold.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'job_hold.jh_user_id')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('job_information', 'job_information.job_id', '=', 'job_hold.jh_job_no')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where('technician.company_id', $auth->company_id)
            ->leftJoin('job_hold_reason', 'job_hold_reason.jhr_id', '=', 'job_hold.jh_reason')
            ->where('job_hold_reason.company_id', $auth->company_id);
        // ->orderBy('jh_id','Desc');

        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $start = date('Y-m-d', strtotime($from_date));

        $end = date('Y-m-d', strtotime($to_date));
        $query = $datas;

        if (isset($request->job_no)) {
            $query->where('job_hold.jh_job_no','=', $request->job_no );
        }

        if (!empty($from_date) && !empty($to_date)) {
            $query->whereDate('job_hold.jh_created_at', '>=', $start)->whereDate('job_hold.jh_created_at', '<=', $end);
        } elseif (isset($request->from_date)) {
            $query->whereDate('job_hold.jh_created_at', '>=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('job_hold.jh_created_at', '<=', $end);
        }

        // $query = $query->get();
        $query = $query->orderBy('jh_id', 'DESC')->paginate($pagination_number);

        return view('job_hold/job_hold_list', compact('job_no', 'from_date', 'to_date', 'query'))->with('pageTitle', 'Job Hold List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $reasons = JobHoldReason::where('company_id', $auth->company_id)->get();
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Assign')->where('company_id', $auth->company_id)->get();

        return view('job_hold/add_job_hold', compact('job_num', 'reasons'))->with('pageTitle', 'Create Job Hold');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            // $this->validation($request);

            $auth = Auth::user();
            $jh = new JobHoldModel();
            $jh->jh_job_no = $request->select_job;
            $jh->jh_reason = $request->select_reason;
            $jh->jh_remarks = $request->remarks;
            $jh->jh_user_id = $auth->id;
            $jh->company_id = $auth->company_id;

            // coding from shahzaib start
            $tbl_var_name = 'jh';
            $prfx = 'jh';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
//            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
//            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            //        $jh->bra_created_at=Carbon::now()->toDateTimeString();
            //        $jh->bra_updated_at=$auth->id;
            $jh->save();
        });
        $auth = Auth::user();
        jobInformationModel::where('job_id', '=', $request->select_job)->where('company_id', $auth->company_id)->update(['ji_job_status' => 'Hold']);

        return redirect()
            ->route('job_hold.index')
            ->with('success', 'Successfully Saved');
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
        $auth = Auth::user();
        $job_reasons = JobHoldReason::where('company_id', $auth->company_id)->get();

        $job_hold = JobHoldModel::where('jh_id', '=', $id)->where('company_id', $auth->company_id)->first();
        $job_num = JobInformationModel::where('company_id', $auth->company_id)->where('job_id',$job_hold->jh_job_no)->get();
//        dd($job_num);
        return view('job_hold/edit_job_hold', compact('job_hold', 'job_reasons', 'job_num'))->with('pageTitle', 'Edit Job Hold');
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
        DB::transaction(function () use ($request, $id) {
            $auth = Auth::user();
            $job_hold = JobHoldModel::where('jh_id', '=', $id)->first();
            $job_hold->jh_job_no = $request->select_job;
            $job_hold->jh_reason = $request->select_reason;
            $job_hold->jh_remarks = $request->remarks;
            $job_hold->jh_user_id = $auth->id;
            $job_hold->company_id = $auth->company_id;

            // coding from shahzaib start
            $tbl_var_name = 'jh';
            $prfx = 'jh';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $job_hold->save();
        });
        return redirect()
            ->route('job_hold.index')
            ->with('success', 'Successfully Updated');
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
