<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ClientModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:category-list', ['only' => ['category_list']]);
        $this->middleware('permission:category-create', ['only' => ['add_category', 'store_category']]);
        $this->middleware('permission:category-edit', ['only' => ['edit_category', 'update_category']]);
    }

    public function add_category()
    {
        $auth = Auth::user();
        $brands = Brand::where('company_id', $auth->company_id)->get();

        return view('category/add_category', compact('brands'))->with('pageTitle', 'Create Category');
    }

    public function store_category(Request $request)
    {
        DB::transaction(function () use ($request) {
            //        $this->category_validation($request);
            $this->validation($request);

            $auth = Auth::user();

            $category = new Category();
            $category->cat_name = $request->cat_name;
            $category->cat_bra_id = $request->bra_name;
            $category->cat_user_id = $auth->id;
            $category->company_id = $auth->company_id;

            // coding from shahzaib start
            $tbl_var_name = 'category';
            $prfx = 'cat';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $category->save();
            //        return redirect()->back()->with('success','Successfully Saved');
        });
        return redirect()
            ->back()
            ->with('success', 'Successfully Saved');
    }

    //    public function category_validation($request)
    //    {
    //        return $this->validate($request,[
    //           'cat_name' => ['required', 'string','cat_name,NULL,cat_id,cat_bra_id,'.$request->bra_name],
    //
    //        ]);
    //
    //    }

    public function category_list(Request $request)
    {
        $ar = json_decode($request->array);
        $search_category = $request->search_category;
        $bra_name = $request->bra_name;
        $auth = Auth::user();
        $pagination_number = empty($ar) ? 30 : 100000000;
        // $datas = Category::all();
        $brands = Brand::where('company_id', $auth->company_id)->get();

        $datas = DB::table('categories')
            ->leftJoin('users', 'users.id', '=', 'categories.cat_user_id')
            ->leftJoin('brands', 'brands.bra_id', '=', 'categories.cat_bra_id')
            ->where('categories.company_id', $auth->company_id)
            ->orderBy('cat_id', 'Desc');
        $query = $datas;

        if (isset($request->search_category)) {
            $query->orWhere('categories.cat_name', 'like', '%' . $request->search_category . '%');
        }

        if (isset($request->bra_name)) {
            $query->orWhere('brands.bra_name', 'like', '%' . $request->bra_name . '%');
        }

        // $query = $query->get();
        $query = $query
            ->orderBy('cat_id', 'DESC')
            ->paginate($pagination_number)
            ->appends([
                'search_category' => $search_category,
                'bra_name' => $bra_name,
            ]);

        return view('category/category_list', compact('bra_name', 'search_category', 'query', 'brands'))->with('pageTitle', 'Category List');
    }

    public function client_exist(Request $request)
    {
        //        dd(12);
        $auth = Auth::user();
        $client_no = $request->number;
        $data = ClientModel::where('cli_number', '=', $client_no)
            ->where('company_id', $auth->company_id)
            ->first();

        return response()->json($data);
    }

    public function edit_category($id)
    {
        $auth = Auth::user();
        $brands = Brand::where('company_id', $auth->company_id)->get();
        $category = Category::where('cat_id', '=', $id)
            ->where('company_id', $auth->company_id)
            ->first();
        return view('category/edit_category', compact('category', 'brands'))->with('pageTitle', 'Edit Category');
    }
    public function update_category(Request $request, $id)
    {
        DB::transaction(function () use ($request, $id) {
            $auth = \Illuminate\Support\Facades\Auth::user();
            $category = Category::where('cat_id', '=', $id)->first();

            $category->cat_name = $request->cat_name;
            $category->cat_bra_id = $request->bra_name;

            $category->cat_user_id = $auth->id;
            $category->company_id = $auth->company_id;
            // coding from shahzaib start
            $tbl_var_name = 'category';
            $prfx = 'cat';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $category->save();
        });
        return redirect()
            ->route('category_list')
            ->with('success', 'Successfully Updated');
    }

    public function validation($request)
    {
        $auth = Auth::user();
        $this->validate($request, [
            'cat_name' => [
                'required',
                Rule::unique('categories', 'cat_name')->where(function ($query) use ($auth) {
                    return $query->where('company_id', $auth->company_id);
                }),
            ],
            // 'permission' => 'required',
        ]);
        // return $this->validate($request,[
        //     'cat_name' => ['required', 'string','unique:categories,cat_name,NULL,cat_id,cat_bra_id,'.$request->bra_name],
        // ]);
    }
}
