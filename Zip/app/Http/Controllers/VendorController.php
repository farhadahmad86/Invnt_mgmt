<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\VendorModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:Warrenty-vendor-list', ['only' => ['vendor_list']]);
        $this->middleware('permission:Warrenty-vendor-create', ['only' => ['add_vendor','store_vendor']]);
        $this->middleware('permission:Warrenty-vendor-edit', ['only' => ['edit_vendor','update_vendor']]);
    }


    public function add_vendor()
    {
        return view('vendor/add_vendor')->with('pageTitle', 'Create Warrenty Vendor');
    }

    public function vendor_list(Request $request)
    {

        // $datas = VendorModel::all();
        $auth = Auth::user();
        $datas = DB::table('vendor')
            ->leftJoin('users', 'users.id','=', 'vendor.vendor_user_id')
            ->orderBy('vendor_id','Desc')
            ->where('vendor.company_id', $auth->company_id)
            ->paginate(30);
            // ->get();

        $query = $datas;

        return view('vendor/vendor_list', compact(  'query'))->with('pageTitle', 'Warrenty Vendor List');
    }

    public function store_vendor(Request $request)
    {
        DB::transaction(function () use( $request ) {

            $this->validation($request);

            $auth = Auth::user();
            $vendor = new VendorModel();
            $vendor->vendor_name = ucwords($request->vendor);
            $vendor->vendor_user_id = $auth->id;
            $vendor->company_id = $auth->company_id;
//        $vendor->vendor_created_at=Carbon::now()->toDateTimeString();
//        $vendor->vendor_updated_at=$auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'vendor';
            $prfx = 'vendor';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');

//        dd(Carbon::now('GMT+5'));
            // coding from shahzaib end

            $vendor->save();
//        return redirect()->route('add_category')->with('success','Successfully Saved Brand');
        });
        return redirect()->back()->with('success','Successfully Saved');
    }


    public function edit_vendor($id)
    {
        // $vendors = VendorModel::all();
        $auth = Auth::user();
        $vendor = VendorModel::where('vendor_id','=',$id)->where('company_id', $auth->company_id)->first();
        return view('vendor/edit_vendor',compact('vendor'))->with('pageTitle', 'Edit Warrenty Vendor');

    }
    public function update_vendor(Request $request, $id)
    {
        DB::transaction(function () use( $request ,$id) {

            $auth = Auth::user();
            $vendor = VendorModel::where('vendor_id', '=', $id)->where('company_id', $auth->company_id)->first();

            $vendor->vendor_name = ucwords($request->vendor);
            $vendor->vendor_user_id = $auth->id;
            $vendor->company_id = $auth->company_id;
            $tbl_var_name = 'vendor';
            $prfx = 'vendor';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            $vendor->save();
        });
        return redirect()->route('vendor_list')->with('success', 'Successfully Updated');

    }

    public function validation($request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'vendor' => [
                'required',
                Rule::unique('vendor', 'vendor_name')->where(function ($query) use ($auth) {
                    return $query->where('company_id', $auth->company_id);
                }),
            ],
        ]);
        // return $this->validate($request,[
        //     'vendor' => ['required', 'string','unique:vendor,vendor_name'],
        // ]);

    }
}
