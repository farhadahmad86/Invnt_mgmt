<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class SaleInvoiceForJobsModel extends Model
{
    use LogsActivity;


    protected $table = "sale_invoice_for_jobs";
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey='sifj_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['sifj_remarks','sifj_cash_account','sifj_job_no','sifj_real_estimated_cost','sifj_estimated_cost','sifj_amount_paid','sifj_remaining_cost','sifj_discount']);
    }
}
