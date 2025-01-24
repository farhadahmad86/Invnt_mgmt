<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Jenssegers\Agent\Agent;

class BrandController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:brand-list', ['only' => ['brand_list']]);
        $this->middleware('permission:brand-create', ['only' => ['add_brand','store_brand']]);
        $this->middleware('permission:brand-edit', ['only' => ['edit_brand','update_brand']]);
    }



    public function add_brand()
    {
        return view('brand/add_brand')->with('pageTitle', 'Create Brand');
    }

    public function brand_list(Request $request)
    {
        // $datas = Brand::all();
        $auth = Auth::user();
        $datas = DB::table('brands')
            ->leftJoin('users', 'users.id','=', 'brands.bra_user_id')
            ->where('brands.company_id', $auth->company_id)
            ->orderBy('bra_id','Desc')
            ->paginate(30);
            // ->get();

        $query = $datas;

        return view('brand/brand_list', compact(  'query'))->with('pageTitle', 'Brand List');
    }

    public function store_brand(Request $request)
    {
        DB::transaction(function () use( $request ) {

        $this->validation($request);

        $auth = Auth::user();
        $brand = new Brand();
        $brand->bra_name=ucwords($request->brand);
        $brand->bra_user_id=$auth->id;
        $brand->company_id=$auth->company_id;
//        $brand->bra_created_at=Carbon::now()->toDateTimeString();
//        $brand->bra_updated_at=$auth->id;

        // coding from shahzaib start
        $tbl_var_name = 'brand';
        $prfx = 'bra';
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

        $brand->save();
        });

        return redirect()->back()->with('success','Successfully Saved Brand');

//        return redirect()->back()->with('success','Successfully Saved');
    }


    public function edit_brand($id)
    {
        $auth = Auth::user();
        $brand = Brand::where('bra_id','=',$id)->where('company_id', $auth->company_id)->first();
        return view('brand/edit_brand',compact('brand'))->with('pageTitle', 'Edit Brand');

    }
    public function update_brand(Request $request, $id)
    {
        DB::transaction(function () use( $request , $id) {
            $auth = Auth::user();
            $brand = Brand::where('bra_id', '=', $id)->first();

            $brand->bra_name = ucwords($request->brand);
            $brand->bra_user_id = $auth->id;
            $brand->company_id = $auth->company_id;
            $tbl_var_name = 'brand';
            $prfx = 'bra';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            $brand->save();
        });
        return redirect()->route('brand_list')->with('success', 'Successfully Updated');

    }

    public function validation($request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'brand' => [
                'required',
                Rule::unique('brands', 'bra_name')->where(function ($query) use ($auth) {
                    return $query->where('company_id', $auth->company_id);
                }),
            ],
            // 'permission' => 'required',
        ]);
        // return $this->validate($request,[
        //     'brand' => ['required', 'string','unique:brands,bra_name'],
        // ]);

    }

}
