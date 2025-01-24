<?php

namespace App\Http\Controllers;

use App\Models\Accessory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AccessoryController extends Controller
{

    public function add_accessory()
    {
        return view('accessory/add_accessory');
    }

    public function store_accessory(Request $request)
    {
        DB::transaction(function () use( $request ) {
        $this->validation($request);

        $auth = Auth::user();


            $accessory = new Accessory();
        $accessory->acc_name=ucwords($request->accessory);
        $accessory->acc_remarks=$request->remarks;
        $accessory->acc_user_id=$auth->id;
        // coding from shahzaib start
        $tbl_var_name = 'accessory';
        $prfx = 'ja';
        $brwsr_rslt = $this->getBrwsrInfo();
        $clientIP = $this->get_ip();

        $brwsr_col = $prfx . '_browser_info';
        $ip_col = $prfx . '_ip_address';
        $updt_date_col = $prfx . '_updated_at';

        $$tbl_var_name->$brwsr_col = $brwsr_rslt;
        $$tbl_var_name->$ip_col = $clientIP;
        $$tbl_var_name->$updt_date_col = Carbon::now();
        // coding from shahzaib end

        DB::transaction(function ($accessory) {
            $accessory->save();
        });
            return redirect()->back()->with('success','Successfully Saved');
        });

    }
    public function validation($request)
    {
        return $this->validate($request,[
            'accessory' => ['required', 'string','unique:accessories,acc_name'],
            'remarks' => ['nullable', 'string'],
        ]);

    }

    public function getBrwsrInfo()
    {
        $agnt = new Agent();
        $chk_dsktp = ($agnt->isDesktop() === TRUE) ? 'Desktop' : '';
        $chk_iphn = ($agnt->isPhone() === TRUE) ? 'iPhone' : '';
        $chk_mbl = ($agnt->isMobile() === TRUE) ? 'Mobile' : '';
        $chk_tblt = ($agnt->isTablet() === TRUE) ? 'Tablet' : '';
        $device = '';
        if (!empty($chk_dsktp)) {
            $device = $chk_dsktp;
        } elseif (!empty($chk_iphn)) {
            $device = $chk_iphn;
        } elseif (!empty($chk_mbl)) {
            $device = $chk_mbl;
        } elseif (!empty($chk_tblt)) {
            $device = $chk_tblt;
        }

        $browser = $agnt->browser();
        $browser_rslt = $device . ' Device ' . PHP_EOL . '' . $browser . ' browser | Version:- ' . $agnt->version($browser);

        return $browser_rslt;
    }

    /////////////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////// Ip Related Code ////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////

    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }
}
