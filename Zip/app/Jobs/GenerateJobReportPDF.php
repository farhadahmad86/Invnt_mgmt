<?php

// app/Jobs/GenerateJobReportPDF.php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateJobReportPDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $pdf = PDF::loadView('modal_views.job_report_pdf', ['data' => $this->data]);

        // Save the PDF to storage or send it as needed
        $pdf->save(storage_path('app/public/job_report.pdf'));
    }
}
