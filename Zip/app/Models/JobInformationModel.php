<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobInformationModel extends Model
{
    use LogsActivity;


    protected $table = "job_information";

    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'ji_id';


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['ji_id','ji_cli_id','ji_delivery_datetime','ji_title','ji_warranty_status','ji_vendor','ji_job_status','ji_serial_no','ji_estimated_cost','ji_remaining','ji_amount_pay','ji_discount']);
    }
}
