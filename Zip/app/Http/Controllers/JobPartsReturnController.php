<?php

namespace App\Http\Controllers;

use App\Models\IssuePartsToJobItemsModel;
use App\Models\IssuePartsToJobModel;
use App\Models\JobInformationModel;
use App\Models\PartsModel;
use App\Models\StockModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobPartsReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:add-job-parts-return', ['only' => ['create', 'store']]);
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
            ->where('iptj_status', 'Returned');
        // ->orderBy('iptj_id','Desc');

        $job_no = $request->job_no;
        $inv_no = $request->inv_no;
        $status = $request->status;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $start = date('Y-m-d', strtotime($from_date));

        $end = date('Y-m-d', strtotime($to_date));
        $query = $datas;

        if (isset($request->job_no)) {
            // dd(2);
            $query->Where('issue_parts_to_job.iptj_job_no', '=', $request->job_no);
        }
        if (isset($request->inv_no)) {
            $query->Where('issue_parts_to_job.iptj_inv_id', '=', $request->inv_no);
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
        $query = $query->orderBy('iptj_id', 'DESC')->paginate($pagination_number);

        return view('job_parts_return/job_parts_return_list', compact('job_no','inv_no', 'from_date', 'to_date', 'query', 'status'))->with('pageTitle', 'Part Return List');
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
        // $parts = PartsModel::where("par_status","=","Opening")->get();
        $count = IssuePartsToJobModel::where('company_id', $auth->company_id)
            ->where('iptj_status', 'Returned')
            ->count('iptj_inv_id');

        // If no records are found, set $count to 1, otherwise increment by 1
        $count = $count ? $count + 1 : 1;
        // dd($count);

        return view('job_parts_return/add_job_parts_return', compact('jobs', 'count'))->with('pageTitle', 'Create Part Return');
    }
    public function get_parts(Request $request)
    {
        $auth = Auth::user();
        // dd($request->all());
        $parts = IssuePartsToJobModel::where('iptj_job_no', $request->job_id)
            ->where('iptj_status', 'Issued')
            ->where('company_id', $auth->company_id)
            ->select('issue_parts_to_job.iptj_id', 'issue_parts_to_job.iptj_job_no')
            ->get();

        $partNumbers = [];
        foreach ($parts as $part) {
            $partNumbers[] = $part->iptj_id;
        }

        // dd($parts, $partNumbers);
        $parts_items = DB::table('issue_parts_to_job_items')
            ->leftJoin('parts', 'parts.par_id', '=', 'issue_parts_to_job_items.iptji_parts')
            ->whereIn('iptji_iptj_id', $partNumbers)
            ->select('issue_parts_to_job_items.*', 'parts.par_id', 'parts.par_name')
            ->get();

        // dd($parts_items,$parts, $partNumbers);
        return response()->json(['parts_items' => $parts_items]);
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
        ]);

        DB::transaction(function () use ($request) {
            $auth = Auth::user();

            $requested_arrays = $request->parts;

            $issue_parts = new IssuePartsToJobModel();
            $issue_parts->iptj_user_id = $auth->id;
            $issue_parts->company_id = $auth->company_id;
            $issue_parts->iptj_job_no = $request->select_job;
            $issue_parts->iptj_inv_id = $request->inv_id;
            $issue_parts->iptj_remarks = $request->remarks;
            $issue_parts->iptj_status = 'Returned';

            $issue_parts->save();

            foreach ($requested_arrays as $index => $requested_array) {
                $part_rate = PartsModel::select('par_purchase_price')
                    ->where('par_id', '=', $request->parts[$index])
                    ->first();

                //            dd($part_rate['par_purchase_price']);
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
                $issue_parts_items->iptji_status = 'Returned';

                $issue_parts_items->save();

                //        update in parts table
                $pat = PartsModel::where('par_id', '=', $request->parts[$index])
                    ->where('company_id', $auth->company_id)
                    ->first();
                $pat->par_total_qty = $pat->par_total_qty + $request->qty[$index];
                $pat->save();

                //        add stock data
                $last_qty = StockModel::where('sto_par_id', '=', $request->parts[$index])
                    ->where('company_id', $auth->company_id)
                    ->OrderBy('sto_id', 'DESC')
                    ->first();
                $new_qty = $last_qty->sto_total + $request->qty[$index];

                $stock = new StockModel();
                $stock->sto_par_id = $request->parts[$index];
                $stock->sto_user_id = $auth->id;
                $stock->company_id = $auth->company_id;
                $stock->sto_job_id = $issue_parts->iptj_job_no;
                $stock->sto_type = 'Return';
                $stock->sto_type_id = $issue_parts->iptj_inv_id;
                $stock->sto_in = $request->qty[$index];
                $stock->sto_in_rate = $part_rate['par_purchase_price'];
                $stock->sto_in_amount = $part_amount;
                $stock->sto_total = $new_qty;
                $stock->save();
            }
        });

        return redirect()
            ->route('job_parts_return.index')
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
