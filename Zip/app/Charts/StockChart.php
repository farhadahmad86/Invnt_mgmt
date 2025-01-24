<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class StockChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\RadialChart
    {


        $datas = DB::table('parts')->get();


        $qty = [];
        $part_name = [];
        foreach ($datas as $work) {
            $qty[] = $work->par_total_qty;
            $part_name[] = $work->par_name;
        }


        return $this->chart->radialChart()
            ->setTitle('')
            ->setSubtitle('')
            ->addData($qty)
            ->setLabels($part_name);
//            ->setColors(['#D32F2F', '#03A9F4']);
    }
}
