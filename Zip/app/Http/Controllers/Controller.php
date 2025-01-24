<?php

namespace App\Http\Controllers;

use App\Models\AccountRegisterationModel;
use App\Models\IssuePartsToJobModel;
use App\Models\ReportConfigModel;
use App\Models\SaleInvoiceItemsModel;
use App\Models\SaleInvoiceModel;
use App\Models\ServicesInvoiceModel;
use App\Models\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use NumberToWords\NumberToWords;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function myCnvrtNbr($value)
    {
        $nbrToWrds = new NumberToWords();
        $nbrTrnsfr = $nbrToWrds->getNumberTransformer('en');
        $nbrOfWrds = $nbrTrnsfr->toWords($value);
        return $nbrOfWrds;
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

    public static function get_ip()
    {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }


}
