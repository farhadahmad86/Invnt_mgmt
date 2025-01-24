<?php

namespace App\Http\Controllers;

use App\Models\JobHoldModel;
use App\Models\PartsModel;
use App\Models\StockModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PartRegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:part-registration-list', ['only' => ['index','show']]);
        $this->middleware('permission:part-registration-create', ['only' => ['create','store']]);
        $this->middleware('permission:part-registration-edit', ['only' => ['edit','update']]);
    }



    public function index(Request $request)
    {
        $auth = Auth::user();
        $ar = json_decode($request->array);
        $part_name = $request->part_name;
        $from_date = $request->from_date;
        $to_date = $request->to_date;
        $pagination_number = empty($ar) ? 30 : 100000000;
        $datas = PartsModel::all();
        $datas = DB::table('parts')
            ->leftJoin('users', 'users.id','=', 'parts.par_user_id')
            ->where('parts.company_id', $auth->company_id);
            // ->get();
            // dd($datas);
            // ->orderBy('par_id','Desc');


            $query = $datas;

            if (isset($request->part_name)) {
                $query->orWhere('parts.par_name', 'like', '%' . $request->part_name . '%');
        }

        if (isset($request->from_date)) {
            $query->whereDate('parts.par_created_at', '>=', $request->from_date);
        }
        if (isset($request->to_date)) {
            $query->whereDate('parts.par_created_at', '<=', $request->to_date);
        }

        if ((!empty($from_date)) && (!empty($to_date))) {
            $query->whereDate('parts.par_created_at', '>=', $request->from_date)
            ->whereDate('parts.par_created_at', '<=', $request->to_date);
        }

        $parts_title = PartsModel::where('par_status', 'Opening')->get();

        // $query = $query->get();
       $query = $query->orderBy('par_id', 'DESC')->paginate($pagination_number);
        // dd($query);

        return view('part_registration/part_registration_list', compact('parts_title', 'part_name',  'from_date', 'to_date','query'))->with('pageTitle', 'Part Registration List');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('part_registration/add_part_registration')->with('pageTitle', 'Create Part Registration');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use( $request ) {
            // $this->validation($request);

            $this->validation($request);

            $auth = Auth::user();
            $parts = new PartsModel();
            $parts->par_name = $request->part_name;
            $parts->par_purchase_price = $request->purchase_price;
            $parts->par_bottom_price = $request->bottom_price;
            $parts->par_sale_price = $request->retail_price;
//            $parts->par_total_qty = $request->qty;
            $parts->par_total_qty = 0;
            $parts->par_status = "Created";
            $parts->par_ip_address = $this->get_ip();
            $parts->par_browser_info = $this->getBrwsrInfo();
            $parts->par_user_id = $auth->id;
            $parts->company_id = $auth->company_id;
            $parts->save();


//        add stock data
            $stock = new StockModel();
            $stock->sto_par_id = $parts->par_id;
            $stock->sto_user_id = $auth->id;
            $stock->company_id = $auth->company_id;
            $stock->sto_type = "Created";
            $stock->sto_type_id = $parts->par_id;
            $stock->sto_in = 0;
            $stock->sto_total = 0;
            $stock->save();

        });


        return redirect()->back()->with('success','Successfully Saved');
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
        $part = PartsModel::where('par_id','=',$id)->where('company_id', $auth->company_id)->first();
        return view('part_registration/edit_part_registration',compact('part'))->with('pageTitle', 'Edit Part Registration');
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
        DB::transaction(function () use( $request ,$id) {
            $auth = Auth::user();
            $part = PartsModel::where('par_id', '=', $id)->first();
            $part->par_name = $request->part_name;
            $part->par_purchase_price = $request->purchase_price;
            $part->par_bottom_price = $request->bottom_price;
            $part->par_sale_price = $request->retail_price;
            $part->par_ip_address = $this->get_ip();
            $part->par_browser_info = $this->getBrwsrInfo();
            $part->par_user_id = $auth->id;
            $part->company_id = $auth->company_id;
            $part->save();
        });
        return redirect()->route('part_registration.index')->with('success', 'Successfully Updated');

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

    public function validation($request)
    {
        $auth = Auth::user();
         $this->validate($request, [
            'part_name' => [
                'required',
                Rule::unique('parts', 'par_name')->where(function ($query) use ($auth) {
                    return $query->where('company_id', $auth->company_id);
                }),
            ],
            'purchase_price' => 'required',
            'bottom_price' => 'required',
            'retail_price' => 'required',
        ]);
        // return $this->validate($request,[
        //     'part_name' => ['required', 'string','unique:parts,par_name'],

        // ]);

    }
}
