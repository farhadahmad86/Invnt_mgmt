<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use App\Models\CashBookModel;
use App\Models\JobCloseModel;
use App\Models\JobHoldModel;
use App\Models\JobInformationModel;
use App\Models\JobIssueToTechnicianModel;
use App\Models\PartsModel;
use App\Models\SaleInvoiceForJobsModel;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SaleInvoiceForJobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:sale-invoice-for-job-list', ['only' => ['index', 'show']]);
        $this->middleware('permission:sale-invoice-for-job-create', ['only' => ['create', 'store']]);
    }

    public function index(Request $request)
    {
        $ar = json_decode($request->array);
        $pagination_number = empty($ar) ? 30 : 100000000;
        $auth = Auth::user();
        $datas = DB::table('sale_invoice_for_jobs')
            ->where('sale_invoice_for_jobs.company_id', $auth->company_id)
            ->leftJoin('job_information', 'job_information.job_id', '=', 'sale_invoice_for_jobs.sifj_job_no')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            // ->where('client.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'sale_invoice_for_jobs.sifj_user_id')
            ->where('users.company_id', $auth->company_id)
            ->leftJoin('cash_account', 'cash_account.ca_id', '=', 'sale_invoice_for_jobs.sifj_cash_account')
            ->where('cash_account.company_id', $auth->company_id);
        $prnt_page_dir = 'modal_views.sale_report';
        $pge_title = 'Sale Inoice For Jobs Report';
        $job = $request->job;
        $invoice = $request->invoice;
        $remaining_balance = (int) $request->remaining_balance;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $start = date('Y-m-d', strtotime($from_date));
        $end = date('Y-m-d', strtotime($to_date));
        // dd($start,$end);

        $query = $datas;

        if (isset($request->invoice)) {
            $query->where('sale_invoice_for_jobs.sifj_inv_id', '=', $request->invoice);
        }

        if (isset($request->job)) {
            $query->where('sale_invoice_for_jobs.sifj_job_no', '=', $request->job);
        }

        if (isset($request->remaining_balance)) {
            if ($remaining_balance == 1) {
                $query->where('sale_invoice_for_jobs.sifj_remaining_cost', '=', 0);
            } elseif ($remaining_balance == 2) {
                $query->where('sale_invoice_for_jobs.sifj_remaining_cost', '>=', 1);
            }
        }

        if (!empty($from_date) && !empty($to_date)) {
            $query->whereDate('sale_invoice_for_jobs.sifj_created_at', '>=', $start)->whereDate('sale_invoice_for_jobs.sifj_created_at', '<=', $end);
        } elseif (isset($request->from_date)) {
            $query->whereDate('sale_invoice_for_jobs.sifj_created_at', '=', $start);
        } elseif (isset($request->to_date)) {
            $query->whereDate('sale_invoice_for_jobs.sifj_created_at', '=', $end);
        }

        // Calculate the total sum
        $totalSum = $query->sum('sifj_remaining_cost');
        // $query = $query->toSql();
        // $query = $query->get();
        // dd($query);
        // Apply pagination

        if ($request->pdf_download == '1') {
            $query = $query->orderBy('sifj_id', 'DESC')->get();
            $pdf = PDF::loadView($prnt_page_dir, compact('job', 'from_date', 'to_date', 'query', 'invoice', 'remaining_balance', 'totalSum'));
            $pdf->setPaper('A4', 'Landscape');
            return $pdf->stream($pge_title . '_x.pdf');
        } else {
            $query = $query->orderBy('sifj_id', 'DESC')->paginate($pagination_number);
            return view('sale_invoice/sale_invoice_for_jobs_list', compact('job', 'from_date', 'to_date', 'query', 'invoice', 'remaining_balance', 'totalSum'))->with('pageTitle', 'Sale Invoice For Jobs List');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auth = Auth::user();
        $cash_accounts = CashAccountModel::where('company_id', $auth->company_id)->get();
        $job_number = JobInformationModel::where('company_id', $auth->company_id)
            ->where(function ($query) {
                $query->where('ji_job_status', '=', 'Close')->orWhere('ji_job_status', '=', 'Credit');
            })
            ->get();
            $count = SaleInvoiceForJobsModel::where('company_id', $auth->company_id)->max('sifj_inv_id');

            // If no records are found, set $count to 1, otherwise increment by 1
            $count = $count ? $count + 1 : 1;

            // dd($count);
        // dd($job_number);

        // $sale_invoice_for_jobs = SaleInvoiceForJobsModel::where('company_id', $auth->company_id)->get();

        return view('sale_invoice/sale_invoice_for_jobs', compact('job_number','count', 'cash_accounts'))->with('pageTitle', 'Create Sale Invoice For Jobs');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        global $sifj_id;

        $this->validate($request, [
            'job_no' => 'required',
            'cash_account' => 'required',
            'amount' => 'required|integer|min:0',
            'estimated_cost' => 'required|integer|min:1',
            'remaining_estimated_cost' => 'required|integer|min:0',
        ]);

        DB::transaction(function () use ($request, $sifj_id) {
            $auth = Auth::user();
            $sale_invoice_for_jobs = new SaleInvoiceForJobsModel();
            $sale_invoice_for_jobs->sifj_inv_id = $request->inv_id;
            $sale_invoice_for_jobs->sifj_job_no = $request->job_no;
            $sale_invoice_for_jobs->sifj_cash_account = $request->cash_account;
            $sale_invoice_for_jobs->sifj_amount_paid = $request->amount;
            $sale_invoice_for_jobs->sifj_real_estimated_cost = $request->real_estimated_cost;
            $sale_invoice_for_jobs->sifj_estimated_cost = $request->estimated_cost;
            $sale_invoice_for_jobs->sifj_remaining_cost = $request->remaining_estimated_cost;
            $sale_invoice_for_jobs->sifj_discount = $request->discount;
            $sale_invoice_for_jobs->sifj_remarks = $request->remarks;
            $sale_invoice_for_jobs->sifj_user_id = $auth->id;
            $sale_invoice_for_jobs->company_id = $auth->company_id;

            $t_amount_pay = $request->real_estimated_cost - $request->remaining_estimated_cost;

            // coding from shahzaib start
            $tbl_var_name = 'sale_invoice_for_jobs';
            $prfx = 'sifj';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            $sale_invoice_for_jobs->save();

            $discount_amount = jobInformationModel::where('job_id', '=', $request->job_no)
                ->where('company_id', $auth->company_id)
                ->pluck('ji_discount')
                ->first();
            if ($request->remaining_estimated_cost == 0) {
                //        update job information status
                jobInformationModel::where('job_id', '=', $request->job_no)
                    ->where('company_id', $auth->company_id)
                    ->update(['ji_job_status' => 'Paid', 'ji_remaining' => $request->remaining_estimated_cost, 'ji_amount_pay' => $t_amount_pay, 'ji_discount' => $discount_amount + $request->discount]);
            } else {
                //        update job information status
                jobInformationModel::where('job_id', '=', $request->job_no)
                    ->where('company_id', $auth->company_id)
                    ->update(['ji_job_status' => 'Credit', 'ji_remaining' => $request->remaining_estimated_cost, 'ji_amount_pay' => $t_amount_pay, 'ji_discount' => $discount_amount + $request->discount]);
            }

            //        update cash account
            $pat = CashAccountModel::where('ca_id', '=', $request->cash_account)
                ->where('company_id', $auth->company_id)
                ->first();
            $pat->ca_balance = $pat->ca_balance + $request->amount;
            $pat->save();

            //        add cash book data
            $last_qty = CashBookModel::where('cb_ca_id', '=', $request->cash_account)
                ->where('company_id', $auth->company_id)
                ->OrderBy('cb_id', 'DESC')
                ->first();

            // farhad add
            // Update status in Job close
            $job_close = JobCloseModel::where('jc_job_no', '=', $request->job_no)
                ->where('company_id', $auth->company_id)
                ->first();
            $job_close->jc_inv_status = 2;
            $job_close->save();
            if ($last_qty == null) {
                $new_qty = $request->amount;
            } else {
                $new_qty = $last_qty->cb_total + $request->amount;
            }

            $cash_book = new CashBookModel();
            $cash_book->cb_ca_id = $sale_invoice_for_jobs->sifj_cash_account;
            $cash_book->cb_user_id = $auth->id;
            $cash_book->company_id = $auth->company_id;
            $cash_book->cb_type = 'Job Invoice';
            $cash_book->cb_type_id = $sale_invoice_for_jobs->sifj_inv_id;
            //            $cash_book->cb_job_id = $sale_invoice_for_jobs->sifj_id;
            $cash_book->cb_job_id = $request->job_no;
            $cash_book->cb_in = $request->amount;
            $cash_book->cb_total = $new_qty;
            $cash_book->save();

            global $sifj_id;

            $sifj_id = $sale_invoice_for_jobs->sifj_inv_id;
        });

        //        dd($sifj_id);

        return redirect()
            ->route('sale_invoice_for_jobs.index')
            ->with('sifj_id', $sifj_id);
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
        $cash_accounts = CashAccountModel::where('company_id', $auth->company_id)->get();
        $job_number = JobInformationModel::where('company_id', $auth->company_id)->get();
        $sale_invoice_for_jobs = SaleInvoiceForJobsModel::where('sifj_inv_id', '=', $id)
            ->where('company_id', $auth->company_id)
            ->first();
        return view('sale_invoice/edit_sale_invoice_for_jobs', compact('sale_invoice_for_jobs', 'job_number', 'cash_accounts'))->with('pageTitle', 'Edit Sale Invoice For Jobs');
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
            $sale_invoice_for_jobs = SaleInvoiceForJobsModel::where('sifj_id', '=', $id)->first();
            $sale_invoice_for_jobs->sifj_job_no = $request->job_no;
            $sale_invoice_for_jobs->sifj_cash_account = $request->cash_account;
            $sale_invoice_for_jobs->sifj_amount_paid = $request->amount;
            $sale_invoice_for_jobs->sifj_estimated_cost = $request->estimated_cost;
            $sale_invoice_for_jobs->sifj_remaining_cost = $request->remaining_estimated_cost;
            $sale_invoice_for_jobs->sifj_remarks = $request->remarks;
            $sale_invoice_for_jobs->sifj_user_id = $auth->id;
            $sale_invoice_for_jobs->company_id = $auth->company_id;

            // coding from shahzaib start
            $tbl_var_name = 'sale_invoice_for_jobs';
            $prfx = 'sifj';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end

            $sale_invoice_for_jobs->save();
        });
        return redirect()
            ->route('sale_invoice_for_jobs.index')
            ->with('success', 'Successfully Updated');
        //        return redirect()->back()->with('success','Successfully Saved');
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
