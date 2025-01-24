<?php

namespace App\Http\Controllers;

use App\Models\IssuePartsToJobItemsModel;
use App\Models\IssuePartsToJobModel;
use App\Models\JobInformationModel;
use App\Models\PartsModel;
use App\Models\StockModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IssuePartsToJobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:issue-parts-to-job-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:issue-parts-to-job-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:issue-parts-to-job-edit', ['only' => ['edit', 'update']]);
    }

    public function index(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = DB::table('issue_parts_to_job')
            ->where('issue_parts_to_job.company_id', $auth->company_id)
            ->leftJoin('job_information', 'job_information.job_id', '=', 'issue_parts_to_job.iptj_job_no')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no', '=', 'job_information.job_id')
            ->where('job_issue_to_technician.company_id', $auth->company_id)
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
            ->where('technician.company_id', $auth->company_id)
            ->where('iptj_status', 'issued');
        // ->first();
        // dd($datas);
        // ->orderBy('iptj_id','Desc');

        $job_no = $request->job_no;
        $inv_no = $request->inv_no;
        $damage = $request->damage;
        $status = $request->status;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $start = date('Y-m-d', strtotime($from_date));

        $end = date('Y-m-d', strtotime($to_date));
        $query = $datas;

        if (isset($request->job_no)) {
            $query->Where('issue_parts_to_job.iptj_job_no', '=', $request->job_no);
        }
        if (isset($request->inv_no)) {
            $query->Where('issue_parts_to_job.iptj_inv_id', '=', $request->inv_no);
        }
        if (isset($request->damage)) {
            $query->Where('issue_parts_to_job.issue_against_damage', '=', $request->damage);
        }

        if (isset($request->status)) {
            $query->orWhere('issue_parts_to_job.iptj_status', 'like', '%' . $request->status . '%');
        }

        if (!empty($from_date) && !empty($to_date)) {
            $query->whereDate('issue_parts_to_job.iptj_created_at', '>=', $start)->whereDate('issue_parts_to_job.iptj_created_at', '<=', $end);
        } elseif (isset($request->from_date)) {
            $query->whereDate('issue_parts_to_job.iptj_created_at', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('issue_parts_to_job.iptj_created_at', '=', $end);
        }

        // $query = $query->get();
        // dd($query);
        // dd(1);
        $query = $query->orderBy('iptj_id', 'DESC')->paginate($pagination_number);

        return view('issue_parts_to_job/issue_parts_to_job_list', compact('job_no','inv_no', 'from_date', 'to_date', 'query', 'status', 'damage'))->with('pageTitle', 'Issue Parts To Job List');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $jobs = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->get();
        $parts = PartsModel::where('par_status', '=', 'Opening')
            ->where('company_id', $auth->company_id)
            ->get();
        $count = IssuePartsToJobModel::where('company_id', $auth->company_id)
        ->where('iptj_status',"issued")
        ->count('iptj_inv_id');

        // If no records are found, set $count to 1, otherwise increment by 1
        $count = $count ? $count + 1 : 1;
        // dd($count);
        return view('issue_parts_to_job/add_issue_parts_to_job', compact('count', 'jobs', 'parts'))->with('pageTitle', 'Create Issue Parts To Job');
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

        $this->validate($request, [
            'select_job' => 'required',
            'qty.*' => 'required|integer|min:1',
            'st_qty.*' => 'required|integer|min:1',
        ]);

        DB::transaction(function () use ($request) {
            $auth = Auth::user();

            // dd($request->all());
            $requested_arrays = $request->parts;

            $issue_parts = new IssuePartsToJobModel();
            $issue_parts->iptj_user_id = $auth->id;
            $issue_parts->iptj_inv_id = $request->inv_id;
            $issue_parts->company_id = $auth->company_id;
            $issue_parts->iptj_job_no = $request->select_job;
            $issue_parts->iptj_remarks = $request->remarks;
            if ($request->issue_against_damage == 'on') {
                // dd(2);
                $issue_parts->issue_against_damage = 2;
            }
            $issue_parts->iptj_status = 'Issued';

            $issue_parts->save();

            foreach ($requested_arrays as $index => $requested_array) {
                $part_rate = PartsModel::select('par_purchase_price')
                    ->where('company_id', $auth->company_id)
                    ->where('par_id', '=', $request->parts[$index])
                    ->first();

                //    dd($part_rate['par_purchase_price']);
                $part_amount = $request->qty[$index] * $part_rate['par_purchase_price'];

                $issue_parts_items = new IssuePartsToJobItemsModel();
                $issue_parts_items->iptji_user_id = $auth->id;
                $issue_parts_items->company_id = $auth->company_id;
                $issue_parts_items->iptji_iptj_id = $issue_parts->iptj_id;
                $issue_parts_items->iptji_inv_id = $issue_parts->iptj_inv_id;
                $issue_parts_items->iptji_parts = $request->parts[$index];
                $issue_parts_items->iptji_qty = $request->qty[$index];
                $issue_parts_items->iptji_rate = $part_rate['par_purchase_price'];
                $issue_parts_items->iptji_amount = $part_amount;
                $issue_parts_items->iptji_status = 'Issued';

                $issue_parts_items->save();

                //        update in parts table
                $pat = PartsModel::where('par_id', '=', $request->parts[$index])
                    ->where('company_id', $auth->company_id)
                    ->first();
                $pat->par_total_qty = $pat->par_total_qty - $request->qty[$index];
                $pat->save();

                //        add stock data
                $last_qty = StockModel::where('sto_par_id', '=', $request->parts[$index])
                    ->where('company_id', $auth->company_id)
                    ->OrderBy('sto_id', 'DESC')
                    ->first();
                $new_qty = $last_qty->sto_total - $request->qty[$index];

                $stock = new StockModel();
                $stock->sto_par_id = $request->parts[$index];
                $stock->sto_user_id = $auth->id;
                $stock->company_id = $auth->company_id;
                $stock->sto_job_id = $issue_parts->iptj_job_no;
                $stock->sto_type = 'Issue';
                $stock->sto_type_id = $issue_parts->iptj_inv_id;
                $stock->sto_hold = $request->qty[$index];
                $stock->sto_out = $request->qty[$index];
                $stock->sto_hold_rate = $part_rate['par_purchase_price'];
                $stock->sto_hold_amount = $part_amount;
                $stock->sto_total = $new_qty;
                $stock->save();
            }
        });

        return redirect()
            ->route('issue_parts_to_job.index')
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
