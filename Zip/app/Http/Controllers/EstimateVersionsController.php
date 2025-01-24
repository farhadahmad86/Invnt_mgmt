<?php

namespace App\Http\Controllers;

use App\Models\EmployeeRegistrationModel;
use App\Models\EstimateVersionsModel;
use App\Models\JobInformationModel;
use App\Models\JobTransfer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstimateVersionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:estimate-version-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:estimate-version-create', ['only' => ['create', 'store']]);
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = EstimateVersionsModel::all();

        $datas = DB::table('estimate_versions')
            ->where('estimate_versions.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'estimate_versions.ev_user_id')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('job_information', 'job_information.job_id', '=', 'estimate_versions.ev_job_no')
            ->where('job_information.company_id', $auth->company_id);
            // ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            // ->where('job_issue_to_technician.company_id', $auth->company_id)
            // ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            // ->where('technician.company_id', $auth->company_id);
        // ->orderBy('ev_id','Desc');

        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $start = date('Y-m-d', strtotime($from_date));

        $end = date('Y-m-d', strtotime($to_date));
        $query = $datas;

        if (isset($request->job_no)) {
            $query->orWhere('estimate_versions.ev_job_no', 'like', '%' . $request->job_no . '%');
        }

        if (!empty($from_date) && !empty($to_date)) {
            $query->whereDate('estimate_versions.ev_created_at', '>=', $start)->whereDate('estimate_versions.ev_created_at', '<=', $end);
        } elseif (isset($request->from_date)) {
            $query->whereDate('estimate_versions.ev_created_at', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('estimate_versions.ev_created_at', '=', $end);
        }

        // $query = $query->get();
        $query = $query->orderBy('ev_id', 'DESC')->paginate($pagination_number);

        return view('estimate_versions/estimate_versions_list', compact('job_no', 'from_date', 'to_date', 'query'))->with('pageTitle', 'Estimate Versions List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Assign')->where('company_id', $auth->company_id)->get();
        return view('estimate_versions/add_estimate_versions', compact('job_num'))->with('pageTitle', 'Create Estimate Versions');
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
        DB::transaction(function () use ($request) {
            // $this->validation($request);

            $auth = Auth::user();
            $ev = new EstimateVersionsModel();
            $ev->ev_job_no = $request->select_job;
            $ev->ev_old_estimate_version = $request->old_estimate_versions;
            $ev->ev_new_estimate_version = $request->new_estimate_versions;
            $ev->ev_reason = $request->reason;
            $ev->ev_remarks = $request->remarks;
            $ev->ev_user_id = $auth->id;
            $ev->company_id = $auth->company_id;

            // coding from shahzaib start
            $tbl_var_name = 'ev';
            $prfx = 'ev';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            //        $jt->bra_created_at=Carbon::now()->toDateTimeString();
            //        $jt->bra_updated_at=$auth->id;
            $ev->save();
        });
        $auth = Auth::user();
        jobInformationModel::where('job_id', '=', $request->select_job)->where('company_id', $auth->company_id)->update(['ji_estimated_cost' => $request->new_estimate_versions]);

        //        return $ev;
        return redirect()
            ->route('estimate_versions.index')
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
