<?php

namespace App\Http\Controllers;

use App\Models\JobCloseModel;
use App\Models\JobCloseReasonModel;
use App\Models\JobInformationModel;
use App\Models\JobIssueToTechnicianModel;
use App\Models\JobTransfer;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:job-transfer-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:job-transfer-create', ['only' => ['create', 'store']]);
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;
        // $datas = JobTransfer::all();
        $datas = DB::table('job_transfer')
            ->where('job_transfer.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'job_transfer.jt_user_id')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('technician as old_tec', 'old_tec.tech_id', '=', 'job_transfer.jt_technician')
            ->where('old_tec.company_id', $auth->company_id)
            ->leftJoin('technician as new_tec', 'new_tec.tech_id', '=', 'job_transfer.jt_new_technician')
            ->where('new_tec.company_id', $auth->company_id)
            ->select('job_transfer.*', 'old_tec.tech_name as old_name', 'new_tec.tech_name as new_name');
        // ->orderBy('jt_id','Desc');

        $job_no = $request->job_no;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $start = date('Y-m-d', strtotime($from_date));

        $end = date('Y-m-d', strtotime($to_date));
        $query = $datas;

        if (isset($request->job_no)) {
            $query->Where('job_transfer.jt_job_no', '=' ,  $request->job_no);
        }

        if (isset($request->status)) {
            $query->Where('job_transfer.jt_status', 'like', '%' . $request->status . '%');
        }

        if (!empty($from_date) && !empty($to_date)) {
            $query->whereDate('job_transfer.jt_created_at', '>=', $start)->whereDate('job_transfer.jt_created_at', '<=', $end);
        } elseif (isset($request->from_date)) {
            $query->whereDate('job_transfer.jt_created_at', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('job_transfer.jt_created_at', '=', $end);
        }

        // $query = $query->get();
        $query = $query->orderBy('jt_id', 'DESC')->paginate($pagination_number);

        return view('job_transfer/job_transfer_list', compact('job_no', 'from_date', 'to_date', 'query'))->with('pageTitle', 'Job Transfer List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->get();
        $old_technicians = Technician::where('status', '=', '1')
            ->where('tech_status', '=', '1')
            ->where('company_id', $auth->company_id)
            ->get();
        $new_technicians = Technician::where('status', '=', '1')
            ->where('tech_status', '=', '1')
            ->where('company_id', $auth->company_id)
            ->get();

        return view('job_transfer/add_job_transfer', compact('job_num', 'old_technicians', 'new_technicians'))->with('pageTitle', 'Create Job Transfer');
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

            //        dd($request->all());

            $auth = Auth::user();
            $jt = new JobTransfer();
            $jt->jt_job_no = $request->job_no;
            $jt->jt_technician = $request->old_tech;
            $jt->jt_new_technician = $request->new_tech;
            $jt->jt_user_id = $auth->id;
            $jt->company_id = $auth->company_id;

            // coding from shahzaib start
            $tbl_var_name = 'jt';
            $prfx = 'jt';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $jt->save();
            JobIssueToTechnicianModel::where('jitt_job_no', '=', $jt->jt_job_no)->update(['jitt_technician' => $jt->jt_new_technician]);
        });

        return redirect()
            ->route('job_transfer.index')
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
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Assign')->get();
        $old_technicians = Technician::where('status', '=', '1')
            ->where('tech_status', '=', '1')
            ->where('company_id', $auth->company_id)
            ->get();
        $new_technicians = Technician::where('status', '=', '1')
            ->where('tech_status', '=', '1')
            ->where('company_id', $auth->company_id)
            ->get();

        $job_transfer = JobTransfer::where('jt_id', '=', $id)
            ->where('company_id', $auth->company_id)
            ->first();
        return view('job_transfer/edit_job_transfer', compact('job_transfer', 'job_num', 'old_technicians', 'new_technicians'))->with('pageTitle', 'Edit Job Transfer');
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
            $job_transfer = new JobTransfer();
            $job_transfer->jt_job_no = $request->job_no;
            $job_transfer->jt_technician = $request->old_tech;
            $job_transfer->jt_new_technician = $request->new_tech;
            $job_transfer->jt_user_id = $auth->id;
            $job_transfer->company_id = $auth->company_id;

            // coding from shahzaib start
            $tbl_var_name = 'job_transfer';
            $prfx = 'jt';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $job_transfer->save();
        });
        return redirect()
            ->route('job_transfer.index')
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
