<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class StockBarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {

        $datas = DB::table('parts')->get();


        $qty = [];
        $part_name = [];
        foreach ($datas as $work) {
            $qty[] = $work->par_total_qty;
            $part_name[] = $work->par_name;
        }


        return $this->chart->barChart()
            ->setTitle('San Francisco vs Boston.')
            ->setSubtitle('Wins during season 2021.')
            ->addData('San Francisco', $qty)
            ->addData('Boston', $part_name);
//            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
