<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\View;

class WarrantyVendorReportExport implements FromView, WithHeadings, ShouldAutoSize, WithEvents
{
    public $cusData;
    public $search;
    public $prnt_page_dir;
    public $pge_title;

    public function __construct($datas = "", $srch_fltr = "", $prnt_page_dir = "", $pge_title = "")
    {
        $this->cusData = $datas;
        $this->search = implode(",", $srch_fltr);
        $this->prnt_page_dir = $prnt_page_dir;
        $this->pge_title = $pge_title;
    }

    public function registerEvents(): array
    {
        return [
            BeforeSheet::class => function (BeforeSheet $event) {
                // BeforeSheet logic here...
            },
            AfterSheet::class => function (AfterSheet $event) {
                // AfterSheet logic here...
            },
        ];
    }

    public function view(): ViewContract
    {
        $query = $this->cusData;
        $pge_title = $this->pge_title;
        return view($this->prnt_page_dir, compact('query', 'pge_title'));
    }

    public function headings(): array
    {
        return [
            'Job No',
            'Receiving Date',
            'Client Name',
            'Job Title',
            'Vendor',
            'Brand',
            'Category',
            'Model',
            'Equipment',
            'S#',
            'Fault',
            'Part Name / Qty',
            'Total Amount Paid (Rs)'
        ];
    }
}
