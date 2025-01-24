<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Technician;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TechnicianController extends Controller
{
    public function add_technician()
    {
        return view('technician/add_technician');
    }

    public function technician_list(Request $request)
    {
        $datas = Technician::all();
        $datas = DB::table('technician')
            ->leftJoin('users', 'users.id','=', 'technician.tech_user_id')
//            ->leftJoin('users', 'users.id','=', 'technician.tech_user_id')
            ->orderBy('tech_id','Desc')
            ->get();

        $search = $request->search;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $query = $datas;


        return view('technician/technician_list', compact( 'search', 'from_date', 'to_date', 'query'));
    }

    public function store_technician(Request $request)
    {
        DB::transaction(function () use( $request ) {

            $this->validation($request);

            $auth = Auth::user();

            $technician = new Technician();
            $technician->tech_name = $request->tech_name;
            $technician->tech_user_id = $auth->id;

            // coding from shahzaib start
            $tbl_var_name = 'technician';
            $prfx = 'tech';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

//        return $brwsr_rslt;

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now();
            // coding from shahzaib end

            $technician->save();
        });
        return redirect()->back()->with('success','Successfully Saved');
    }
    public function validation($request)
    {
        return $this->validate($request,[

        ]);

    }


    public function update_technician(Request $request, $id)
    {
        DB::transaction(function () use( $request,$id ) {

            $auth = \Illuminate\Support\Facades\Auth::user();
            $technician = Technician::where('tech_id', '=', $id)->first();

            $technician->tech_name = $request->tech_name;
//        $technician->tech_bra_id=$request->bra_name;

            $technician->tech_user_id = $auth->id;
            // coding from shahzaib start
            $tbl_var_name = 'technician';
            $prfx = 'tech';
            $brwsr_rslt = $this->getBrwsrInfo();
            $clientIP = $this->get_ip();

//        return $brwsr_rslt;

            $brwsr_col = $prfx . '_browser_info';
            $ip_col = $prfx . '_ip_address';
            $updt_date_col = $prfx . '_updated_at';

            $$tbl_var_name->$brwsr_col = $brwsr_rslt;
            $$tbl_var_name->$ip_col = $clientIP;
            $$tbl_var_name->$updt_date_col = Carbon::now('GMT+5');
            // coding from shahzaib end
            $technician->save();
        });
        return redirect()->route('technician_list')->with('success', 'Successfully Updated');

    }

    public function edit_technician($id)
    {
        $technician = Technician::where('tech_id','=',$id)->first();
        return view('technician/edit_technician',compact('technician'));
    }
}

