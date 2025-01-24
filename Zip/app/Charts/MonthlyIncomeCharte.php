<?php

namespace App\Charts;

use App\Models\CashBookModel;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\DB;

class MonthlyIncomeCharte
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        //panga
        $items = CashBookModel::select(
            DB::raw("(COUNT(*)) as count"),
            DB::raw("MONTHNAME(cb_created_at) as month_name"),
            DB::raw("SUM(cb_out) as total_out"),
            DB::raw("SUM(cb_in) as total_in")
        )
            ->whereYear('cb_created_at', date('Y'))
            ->groupBy('month_name')
            ->orderBy('cb_id','ASC')
            ->get();
//            ->toArray();
//        dd($items->month_name);
//panga

        $total_out = [];
        $month_name = [];
        $total_in = [];
        foreach ($items as $work) {
            $total_out[] = $work->total_out;
            $month_name[] = $work->month_name;
            $total_in[] = $work->total_in;
        }



        return $this->chart->areaChart()
            ->setTitle('')
            ->setSubtitle('')
            ->addData('Sales', $total_in)
            ->addData('Expense', $total_out)
            ->setXAxis($month_name);
    }
}
