<?php

namespace App\Charts;

use App\Models\JobInformationModel;
use App\Models\StockMovementModels;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;

class MonthlyJobCharte
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {

        $jobs = DB::table('job_information')
            ->leftJoin('job_issue_to_technician', 'job_issue_to_technician.jitt_job_no','=', 'job_information.ji_id')
            ->leftJoin('technician', 'technician.tech_id','=','job_issue_to_technician.jitt_technician')
            ->select([DB::raw("COUNT(ji_id) as total_jobs, tech_name")])
            ->where("ji_job_status","=","Close")
            ->orwhere("ji_job_status","=","Credit")
            ->orwhere("ji_job_status","=","Paid")
            ->groupBy('tech_name');



        $jobss=$jobs->get();


        $qty = [];
        $tech_name = [];
        foreach ($jobss as $work) {
            $qty[] = $work->total_jobs;
            $tech_name[] = $work->tech_name;
        }


//        dd($jobss);

        return $this->chart->pieChart()
            ->setTitle('')
            ->setSubtitle('')
            ->addData($qty)
            ->setLabels($tech_name);
    }
}
