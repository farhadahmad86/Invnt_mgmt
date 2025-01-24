<?php

namespace App\Http\Controllers;

use App\Models\CashAccountModel;
use App\Models\CompanyProfile;
use App\Models\IssuePartsToJobModel;
use App\Models\JobCloseReasonModel;
use App\Models\JobHoldModel;
use App\Models\JobHoldReason;
use App\Models\JobInformationModel;
use App\Models\PartsModel;
use App\Models\SaleInvoiceForJobsModel;
use App\Models\Technician;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class JobTrackController extends Controller
{
    public function track_job()
    {
        return view('job_info.track_job')->with('pageTitle', 'Job Track');
    }
    public function track_job_find(Request $request)
    {
        $auth = Auth::user();
        $id = $request->job_id;
        $company_profile = CompanyProfile::where('company_id', $auth->company_id)->first();
        // $job_pending = JobInformationModel::where('company_id', $auth->company_id)
        //     ->where('ji_job_status', '=', 'Pending')
        //     ->where('job_id', $id)
        //     ->get();
        // // dd($job_paid);
        // if ($job_pending->isNotEmpty()) {
        //     // Redirect back if the collection is empty
        //     return response()->json(['status' => 'error', 'message' => 'This Job Is Pending. Please First Assign It.']);
        // }
        //    dd(12);
        $items = DB::table('job_information')
            ->where('job_information.company_id', $auth->company_id)
            ->leftJoin('brands', 'brands.bra_id', '=', 'job_information.ji_bra_id')
            ->leftJoin('categories', 'categories.cat_id', '=', 'job_information.ji_cat_id')
            ->leftJoin('model_table', 'model_table.mod_id', '=', 'job_information.ji_mod_id')
            ->leftJoin('vendor', 'vendor.vendor_id', '=', 'job_information.ji_vendor')
            ->leftJoin('client', 'client.cli_id', '=', 'job_information.ji_cli_id')
            ->leftJoin('job_transfer', 'job_transfer.jt_job_no', '=', 'job_information.job_id')
            ->leftJoin('technician as old_tec', 'old_tec.tech_id', '=', 'job_transfer.jt_technician')
            ->where('job_id', $id)
            ->first();
        //        return $items;
        // $nbrOfWrds = $this->myCnvrtNbr($items->ji_estimated_cost);

        $complain_items = DB::table('job_information_items')
            ->where('job_information_items.company_id', $auth->company_id)
            //  ->select(DB::raw("jii_ji_id, GROUP_CONCAT(jii_item_name,'') jii_item_name"))
            ->where('jii_status', '=', 'Complain')
            ->where('jii_ji_job_id', '=', $id)
            //  ->groupBy('jii_ji_id')
            ->get();

        $accessory_items = DB::table('job_information_items')
            ->where('job_information_items.company_id', $auth->company_id)
            ->where('jii_status', '=', 'Accessory')
            ->where('jii_ji_job_id', '=', $id)
            ->get();

        $job_transfer = DB::table('job_transfer')
            ->where('job_transfer.company_id', $auth->company_id)
            ->leftJoin('users', 'users.id', '=', 'job_transfer.jt_user_id')
            ->leftJoin('technician as old_tec', 'old_tec.tech_id', '=', 'job_transfer.jt_technician')
            ->leftJoin('technician as new_tec', 'new_tec.tech_id', '=', 'job_transfer.jt_new_technician')
            ->select('job_transfer.*', 'old_tec.tech_name as old_name', 'new_tec.tech_name as new_name')
            ->where('jt_job_no', $id)
            ->get();
        $part_report = [];
        $part_reports = DB::table('issue_parts_to_job')
            ->where('issue_parts_to_job.company_id', $auth->company_id)
            ->where('iptj_job_no', $id)
            ->get();

        if ($part_reports->isNotEmpty()) {
            // Assuming that there could be multiple part reports
            foreach ($part_reports as $part_report_item) {
                $part_id = $part_report_item->iptj_id;

                if ($part_id) {
                    $parts = DB::table('issue_parts_to_job_items')
                        ->where('iptji_iptj_id', $part_id)
                        ->where('issue_parts_to_job_items.company_id', $auth->company_id)
                        ->leftJoin('parts', 'parts.par_id', '=', 'issue_parts_to_job_items.iptji_parts')
                        ->leftJoin('issue_parts_to_job', 'issue_parts_to_job.iptj_id', '=', 'issue_parts_to_job_items.iptji_iptj_id')
                        ->select('issue_parts_to_job_items.*', 'par_id', 'par_name', 'issue_parts_to_job.iptj_id', 'issue_parts_to_job.iptj_status')
                        ->get();
                    // Now $parts contains the parts for the current $part_report_item
                    $part_report[] = $parts;
                }
            }
        }

        // dd($part_report);
        $datas = null;
        $old_tech = DB::table('job_transfer')
            ->leftJoin('technician', 'technician.tech_id', '=', 'job_transfer.jt_technician')
            ->where('job_transfer.jt_job_no', $id)
            ->where('job_transfer.company_id', $auth->company_id)
            ->where('technician.company_id', $auth->company_id)
            ->select('job_transfer.jt_id', 'job_transfer.company_id', 'job_transfer.jt_job_no', 'technician.company_id', 'technician.tech_id', 'technician.tech_name')
            ->limit(1)
            ->get();
        // dd($old_tech);
        if ($old_tech->isEmpty()) {
            // dd(1);
            $datas = DB::table('job_issue_to_technician')
                ->where('jitt_job_no', $id)
                ->where('job_issue_to_technician.company_id', $auth->company_id)
                ->leftJoin('technician', 'technician.tech_id', '=', 'job_issue_to_technician.jitt_technician')
                ->where('technician.company_id', $auth->company_id)
                ->select('job_issue_to_technician.jitt_id', 'job_issue_to_technician.company_id', 'technician.company_id', 'technician.tech_id', 'technician.tech_name')
                ->first();
        }
        // if ($datas == null) {
        //     // dd(1);
        //     $datas = '';
        // }

        // dd($datas, $old_tech);
        if ($items == '') {
            return response()->json(['status' => 'error', 'message' => 'No data found for the specified job.']);
        }
        // dd($company_profile,$job_transfer,$part_report,  $items, $complain_items, $accessory_items,$datas);
        return response()->json(['job_transfer' => $job_transfer, 'part_report' => $part_report, 'company_profile' => $company_profile, 'items' => $items, 'complain_items' => $complain_items, 'accessory_items' => $accessory_items, 'datas' => $datas, 'old_tech' => $old_tech]);
        // return response()->json(['part_report' => $part_report,]);
    }
    public function job_assign_to_technician_edit($id)
    {
        $auth = Auth::user();
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Pending')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();

        if ($job_num->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job has Already Assign');
        }
        $job_hold = JobInformationModel::where('ji_job_status', '=', 'Hold')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        if ($job_hold->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Hold');
        }
        $job_close = JobInformationModel::where('ji_job_status', '=', 'Close')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_close);
        if ($job_close->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is close');
        }
        $job_paid = JobInformationModel::where('ji_job_status', '=', 'Paid')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_paid->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Paid');
        }
        $job_credit = JobInformationModel::where('ji_job_status', '=', 'Credit')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_credit);
        if ($job_credit->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Credit');
        }

        // If there are items in the collection, you can continue processing them
        // dd($job_num);
        $technicians = Technician::where('status', '=', '1')
            ->where('company_id', $auth->company_id)
            ->where('tech_status', '=', '1')
            ->get();
        return view('job_track/job_assign_to_technician_edit', compact('job_num', 'technicians', 'id'))->with('pageTitle', 'Create Job Issue To Technician');
    }
    public function job_transfer_edit($id)
    {
        $auth = Auth::user();
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        $job_hold = JobInformationModel::where('ji_job_status', '=', 'Hold')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        if ($job_hold->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Hold');
        }
        $job_close = JobInformationModel::where('ji_job_status', '=', 'Close')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_close);
        if ($job_close->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is close');
        }

        $job_paid = JobInformationModel::where('ji_job_status', '=', 'Paid')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_paid->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Paid');
        }
        $job_credit = JobInformationModel::where('ji_job_status', '=', 'Credit')
            ->where('job_information.company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_credit);
        if ($job_credit->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Credit');
        }
        if ($job_num->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Pending');
        }
        // dd($job_num);
        $old_technicians = Technician::where('status', '=', '1')
            ->where('company_id', $auth->company_id)
            ->where('tech_status', '=', '1')
            ->get();
        $new_technicians = Technician::where('status', '=', '1')
            ->where('company_id', $auth->company_id)
            ->where('tech_status', '=', '1')
            ->get();
        return view('job_track/job_transfer_edit', compact('job_num', 'old_technicians', 'new_technicians', 'id'))->with('pageTitle', 'Create Job Transfer');
    }
    public function job_hold_edit($id)
    {
        $auth = Auth::user();
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);
        $reasons = JobHoldReason::where('company_id', $auth->company_id)->get();
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        $job_hold = JobInformationModel::where('ji_job_status', '=', 'Hold')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        if ($job_hold->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Already On Hold');
        }
        $job_close = JobInformationModel::where('ji_job_status', '=', 'Close')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_close);
        if ($job_close->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is close');
        }
        $job_paid = JobInformationModel::where('ji_job_status', '=', 'Paid')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_paid->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Paid');
        }
        $job_credit = JobInformationModel::where('ji_job_status', '=', 'Credit')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_credit);
        if ($job_credit->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Credit');
        }
        if ($job_num->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Pending');
        }
        // dd($job_num);

        return view('job_track/job_hold_edit', compact('job_num', 'reasons', 'id'))->with('pageTitle', 'Create Job Hold');
    }
    public function job_reopen_edit($id)
    {
        $auth = Auth::user();
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);
        $reasons = JobCloseReasonModel::where('company_id', $auth->company_id)->get();
        $job_num = JobInformationModel::whereIn('ji_job_status', ['Credit', 'Close', 'Paid'])
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        $job_close = JobInformationModel::where('ji_job_status', '=', 'Pending')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_close);
        if ($job_close->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Pending');
        }
        if ($job_num->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Hold and Cannot Reopen');
        }
        return view('job_track/job_reopen_edit', compact('job_num', 'reasons', 'id'))->with('pageTitle', 'Create Job Re-Open');
    }
    public function job_close_edit($id)
    {
        $auth = Auth::user();
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);
        $reasons = JobCloseReasonModel::where('company_id', $auth->company_id)->get();
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        $job_close = JobInformationModel::where('ji_job_status', '=', 'Close')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_close);
        if ($job_close->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Also close');
        }
        $job_credit = JobInformationModel::where('ji_job_status', '=', 'Credit')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_credit);
        if ($job_credit->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Credit');
        }
        $job_paid = JobInformationModel::where('ji_job_status', '=', 'Paid')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_paid->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Paid');
        }
        $job_credit = JobInformationModel::where('ji_job_status', '=', 'Credit')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_credit);
        if ($job_credit->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Credit');
        }
        if ($job_num->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Not Assign');
        }
        return view('job_track/job_close_edit', compact('job_num', 'reasons', 'id'))->with('pageTitle', 'Create Job Close');
    }
    public function job_invoice_edit($id)
    {
        $auth = Auth::user();
        // dd('inv');
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);

        $job_number = JobInformationModel::where(function ($query) use ($id) {
            $query->where('ji_job_status', '=', 'Close')->orWhere('ji_job_status', '=', 'Credit');
        })
            ->where('job_id', $id)
            ->where('company_id', $auth->company_id)
            ->get();
        // dd($job_number);
        $count = SaleInvoiceForJobsModel::where('company_id', $auth->company_id)->max('sifj_inv_id');

        // If no records are found, set $count to 1, otherwise increment by 1
        $count = $count ? $count + 1 : 1;
        // dd($count);
        $cash_accounts = CashAccountModel::where('company_id', $auth->company_id)->get();
        $sale_invoice_for_jobs = SaleInvoiceForJobsModel::where('company_id', $auth->company_id)->get();
        $job_paid = JobInformationModel::where('ji_job_status', '=', 'Paid')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_paid->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Paid');
        }
        $job_assign = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_assign->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Assign Please First Close It');
        }
        $job_pending = JobInformationModel::where('ji_job_status', '=', 'Pending')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_pending->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Pending Please First Close It');
        }
        if ($job_number->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Not Close Or Credit');
        }
        return view('job_track/job_invoice_edit', compact('count','id', 'sale_invoice_for_jobs', 'job_number', 'cash_accounts'))->with('pageTitle', 'Create Job Invoice');
    }
    public function job_delivery_edit($id)
    {
        $auth = Auth::user();
        // dd('d');
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);
        $job_num = JobInformationModel::whereIn('ji_job_status', ['Close', 'Credit', 'Paid'])
            ->where('company_id', $auth->company_id)
            ->where('job_delivery_status', 1)
            ->where('job_id', $id)
            ->get();
        $job_assign = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_assign);
        if ($job_assign->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Assign Please First Close It');
        }
        if ($job_num->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Not Close First Close It Or Also Delivered');
        }

        return view('job_track/job_delivery_edit', compact('job_num', 'id'))->with('pageTitle', 'Create Job Delivery');
    }
    public function job_part_issue_edit($id)
    {
        $auth = Auth::user();
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);
        $jobs = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($jobs);
        $count = IssuePartsToJobModel::where('company_id', $auth->company_id)
            ->where('iptj_status', 'Issued')
            ->count('iptj_inv_id');

        // If no records are found, set $count to 1, otherwise increment by 1
        $count = $count ? $count + 1 : 1;
        // dd($count);
        $job_hold = JobInformationModel::where('ji_job_status', '=', 'Hold')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        if ($job_hold->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Hold');
        }

        $job_close = JobInformationModel::where('ji_job_status', '=', 'Close')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_close);
        if ($job_close->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is close');
        }
        $job_paid = JobInformationModel::where('ji_job_status', '=', 'Paid')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_paid->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Paid');
        }
        $job_credit = JobInformationModel::where('ji_job_status', '=', 'Credit')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_credit);
        if ($job_credit->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Credit');
        }
        if ($jobs->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Pending');
        }
        // dd($jobs);
        $parts = PartsModel::where('par_status', '=', 'Opening')
            ->where('company_id', $auth->company_id)
            ->get();

        return view('job_track.job_part_issue_edit', compact('count','jobs', 'parts', 'id'))->with('pageTitle', 'Create Issue Parts To Job');
    }
    public function job_part_return_edit($id)
    {
        $auth = Auth::user();
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        // dd($id);
        $jobs = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
            $count = IssuePartsToJobModel::where('company_id', $auth->company_id)
            ->where('iptj_status', 'Returned')
            ->count('iptj_inv_id');

        // If no records are found, set $count to 1, otherwise increment by 1
        $count = $count ? $count + 1 : 1;
        // dd($count);
        $job_hold = JobInformationModel::where('ji_job_status', '=', 'Hold')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_hold);
        if ($job_hold->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Hold');
        }
        $job_close = JobInformationModel::where('ji_job_status', '=', 'Close')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_close);
        if ($job_close->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is close');
        }
        $job_paid = JobInformationModel::where('ji_job_status', '=', 'Paid')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_paid->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Paid');
        }
        $job_credit = JobInformationModel::where('ji_job_status', '=', 'Credit')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_credit);
        if ($job_credit->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Credit');
        }
        if ($jobs->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Pending');
        }
        // $parts = PartsModel::where('par_status', '=', 'Opening')
        //     ->where('company_id', $auth->company_id)
        //     ->get();
        return view('job_track.job_part_return_edit', compact('count','jobs', 'id'))->with('pageTitle', 'Create Part Return');
    }
    public function job_estimate_versions_edit($id)
    {
        $auth = Auth::user();
        if ($id == 0) {
            // dd($id);
            return redirect()
                ->back()
                ->with('error', 'Please Fill Job Id First');
        }
        $job_num = JobInformationModel::where('ji_job_status', '=', 'Assign')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        $job_hold = JobInformationModel::where('ji_job_status', '=', 'Hold')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_hold);
        if ($job_hold->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Hold');
        }
        $job_close = JobInformationModel::where('ji_job_status', '=', 'Close')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_close);
        if ($job_close->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is close');
        }
        $job_paid = JobInformationModel::where('ji_job_status', '=', 'Paid')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_paid);
        if ($job_paid->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Paid');
        }
        $job_credit = JobInformationModel::where('ji_job_status', '=', 'Credit')
            ->where('company_id', $auth->company_id)
            ->where('job_id', $id)
            ->get();
        // dd($job_credit);
        if ($job_credit->isNotEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is On Credit');
        }
        if ($job_num->isEmpty()) {
            // Redirect back if the collection is empty
            return redirect()
                ->back()
                ->with('error', 'This Job Is Pending');
        }
        // dd($id);
        return view('job_track/job_estimate_versions_edit', compact('job_num'))->with('pageTitle', 'Create Estimate Versions');
    }
    public function job_hold_status($id)
    {
        $auth = Auth::user();

        // Retrieve the JobHold record
        $job_hold = JobHoldModel::where('jh_id', $id)
            ->where('company_id', $auth->company_id)
            ->first();

        if ($job_hold) {
            // Retrieve the JobInformation record
            $job_num = JobInformationModel::where('company_id', $auth->company_id)
                ->where('job_id', $job_hold->jh_job_no)
                ->first();

            if ($job_num) {
                // Update the ji_status field
                $job_num->ji_job_status = 'Assign'; // Make sure 'ji_status' is a valid attribute in your model
                $job_num->save();

                // Update the jh_updated_at field in JobHoldModel
                $job_hold->jh_updated_at = now(); // Or use a specific timestamp if needed
                $job_hold->save();

                // Optionally, you can redirect or return a response here
                return redirect()->back()->with('success', 'Job status and job hold updated successfully.');
            } else {
                return redirect()->back()->with('error', 'Job information not found.');
            }
        } else {
            return redirect()->back()->with('error', 'Job hold record not found.');
        }
    }


}
