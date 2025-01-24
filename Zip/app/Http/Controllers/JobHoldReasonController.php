<?php

namespace App\Http\Controllers;

use App\Models\JobHoldReason;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class JobHoldReasonController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:job-lab-hold-reason-list', ['only' => ['job_hold_reason_list']]);
        $this->middleware('permission:job-lab-hold-reason-create', ['only' => ['add_job_hold_reason','store_job_hold_reason']]);
        $this->middleware('permission:job-lab-hold-reason-edit', ['only' => ['edit_job_hold_reason','update_job_hold_reason']]);
    }




    public function add_job_hold_reason()
    {
        return view('job_hold_reason/add_job_hold_reason')->with('pageTitle', 'Create Job Hold Reason');
    }

    public function job_hold_reason_list(Request $request)
    {
        // $datas = JobHoldReason::all();
        $auth = Auth::user();

        $datas = DB::table('job_hold_reason')
            ->leftJoin('users', 'users.id','=', 'job_hold_reason.jhr_user_id')
            ->orderBy('jhr_id','Desc')
            ->where('job_hold_reason.company_id', $auth->company_id)
            ->paginate(30);

        $query = $datas;

        return view('job_hold_reason/job_hold_reason_list', compact(  'query'))->with('pageTitle', 'Job Hold Reason List');
    }
    public function store_job_hold_reason(Request $request)
    {
        DB::transaction(function () use( $request ) {
            $this->validation($request);

            $auth = Auth::user();

            $job_hold_reason = new JobHoldReason();
            $job_hold_reason->jhr_name = ($request->job_hold_reason);

            $job_hold_reason->jhr_user_id = $auth->id;
            $job_hold_reason->company_id = $auth->company_id;

            // coding from shahzaib start
            $tbl_var_name = 'job_hold_reason';
            $prfx = 'jhr';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $job_hold_reason->save();
        });
        return redirect()->back()->with('success','Successfully Saved');
    }


    public function update_job_hold_reason(Request $request, $id)
    {
        DB::transaction(function () use( $request ,$id) {
            $auth = Auth::user();
            $job_hold_reason = JobHoldReason::where('jhr_id', '=', $id)->first();

            $job_hold_reason->jhr_name = $request->job_hold_reason;


            $job_hold_reason->jhr_user_id = $auth->id;
            $job_hold_reason->company_id = $auth->company_id;
            // coding from shahzaib start
            $tbl_var_name = 'job_hold_reason';
            $prfx = 'jhr';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $job_hold_reason->save();
        });

        return redirect()->route('job_hold_reason_list')->with('success', 'Successfully Updated');

    }

    public function edit_job_hold_reason($id)
    {
        $auth = Auth::user();
        $job_hold_reason = JobHoldReason::where('jhr_id','=',$id)->where('company_id', $auth->company_id)->first();
        return view('job_hold_reason/edit_job_hold_reason',compact('job_hold_reason'))->with('pageTitle', 'Edit Job Hold Reason');
    }


    public function validation($request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'job_hold_reason' => [
                'required',
                Rule::unique('job_hold_reason', 'jhr_name')->where(function ($query) use ($auth) {
                    return $query->where('company_id', $auth->company_id);
                }),
            ],
            // 'permission' => 'required',
        ]);
//        return $this->validate($request,[
//            'job_hold_reason' => ['required', 'string','unique:job_hold_reason,job_hold_reason'],
//
//        ]);

    }
}
