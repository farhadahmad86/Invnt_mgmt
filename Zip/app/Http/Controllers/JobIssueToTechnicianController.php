<?php

namespace App\Http\Controllers;

use App\Models\JobInformationModel;
use App\Models\JobIssueToTechnicianModel;
use App\Models\JobTransfer;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobIssueToTechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:job-issue-to-technician-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:job-issue-to-technician-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:job-issue-to-technician-edit', ['only' => ['edit', 'update']]);
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = JobIssueToTechnicianModel::all();

        $datas = DB::table('job_issue_to_technician')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'job_issue_to_technician.jitt_user_id')
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician');
        // ->orderBy('jitt_id','Desc');

        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $start = date('Y-m-d', strtotime($from_date));

        $end = date('Y-m-d', strtotime($to_date));

        $query = $datas;

        if (isset($request->job_no)) {
            $query->where('job_issue_to_technician.jitt_job_no', '=', $request->job_no);
        }

        if (!empty($from_date) && !empty($to_date)) {
            $query->whereDate('job_issue_to_technician.jitt_created_at', '>=', $start)->whereDate('job_issue_to_technician.jitt_created_at', '<=', $end);
        } elseif (isset($request->from_date)) {
            $query->whereDate('job_issue_to_technician.jitt_created_at', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('job_issue_to_technician.jitt_created_at', '=', $end);
        }

        // $query = $query->get();
        $query = $query->orderBy('jitt_id', 'DESC')->paginate($pagination_number);

        return view('job_issue_to_technician/job_issue_to_technician_list', compact('job_no', 'from_date', 'to_date', 'query'))->with('pageTitle', 'Job Assign To Technician List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $auth = Auth::user();
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Pending')
            ->where('company_id', $auth->company_id)
            ->get();
        $technicians = Technician::where('status', '=', '1')
            ->where('tech_status', '=', '1')
            ->where('company_id', $auth->company_id)
            ->get();

        return view('job_issue_to_technician/add_job_issue_to_technician', compact('job_num', 'technicians'))->with('pageTitle', 'Create Job Assign To Technician');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // $this->validation($request);

        DB::transaction(function () use ($request) {
            $auth = Auth::user();
            $jitt = new JobIssueToTechnicianModel();
            $jitt->jitt_job_no = $request->job_no;
            $jitt->jitt_technician = $request->technician;
            $jitt->company_id = $auth->company_id;
            $jitt->jitt_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'jitt';
            $prfx = 'jitt';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end


            $jitt->save();
            // dd($jitt);
            //        update job information status
            jobInformationModel::where('job_id', '=', $request->job_no)->update(['ji_job_status' => 'Assign']);
            //        $ji->ji_job_status = "Assign";
        });

        return redirect()
            ->route('job_issue_to_technician.index')
            ->with('success', 'Successfully Saved');

        //        return redirect()->back()->with('success','Successfully Saved');
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
