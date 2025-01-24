<?php

namespace App\Http\Controllers;

use App\Models\IssuePartsToJobItemsModel;
use App\Models\IssuePartsToJobModel;
use App\Models\PartsModel;
use App\Models\StockModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OpenningController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:openinning-stock-create', ['only' => ['add_openning','store_openning']]);
    }


    public function add_openning()
    {
        $auth = Auth::user();
        $parts = PartsModel::where('company_id', $auth->company_id)->paginate(30);

        return view('open_stock/openning_stock',compact('parts'))->with('pageTitle', 'Create Openning Stock');
    }

    public function openning_list(Request $request)
    {
        $datas = PartsModel::all();

        $datas = DB::table('opennings')
            ->leftJoin('users', 'users.id','=', 'opennings.bra_user_id')
            ->orderBy('bra_id','Desc')
            ->get();

        $query = $datas;

        return view('openning/openning_list', compact(  'query'))->with('pageTitle', 'Openning Stock List');
    }

    public function store_openning(Request $request)
    {
        // dd(1);

        DB::transaction(function () use( $request ) {
            $auth = Auth::user();


            $requested_arrays = $request->part_id;
            foreach ($requested_arrays as $index => $requested_array) {
                if ($request->qty[$index] == null){
//                    dd($request->qty[$index]);
                }else {
                    $part_rate = PartsModel::select('par_purchase_price')->where('par_id', '=', $request->part_id[$index])->where('company_id', $auth->company_id)->first();
                    $part_amount = $request->qty[$index] * $part_rate['par_purchase_price'];
                    //        update in part_id table
                    $pat = PartsModel::where("par_id", "=", $request->part_id[$index])->where('company_id', $auth->company_id)->first();
                    $pat->par_total_qty = $request->qty[$index];
                    $pat->par_status = "Opening";
                    $pat->save();
                    //        add stock data
                    $last_qty = StockModel::where("sto_par_id", "=", $request->part_id[$index])->where('company_id', $auth->company_id)->OrderBy("sto_id", 'DESC')->first();
                    $new_qty = $last_qty->sto_total + $request->qty[$index];

                    $stock = new StockModel();
                    $stock->sto_par_id = $request->part_id[$index];
                    $stock->sto_user_id = $auth->id;
                    $stock->company_id = $auth->company_id;
                    $stock->sto_type = "Openning";
                    // $stock->sto_type_id = $request->part_id[$index];
                    $stock->sto_in = $request->qty[$index];
                    $stock->sto_in_rate = $part_rate['par_purchase_price'];
                    $stock->sto_in_amount = $part_amount;
                    $stock->sto_total = $new_qty;
                    $stock->save();
                }

            }
        });


        return redirect()->back()->with('success', 'Successfully Saved');

//        return redirect()->back()->with('success','Successfully Saved');
    }
}
