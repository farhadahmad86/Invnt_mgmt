<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobHoldModel extends Model
{
    use LogsActivity;

    protected $table = "job_hold";
    protected $primaryKey='jh_id';
    use HasFactory;
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jh_job_no','jh_reason','jh_remarks']);
    }
}
