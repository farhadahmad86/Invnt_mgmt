<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobCloseModel extends Model
{
    use LogsActivity;

    protected $table = "job_close";
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey='jc_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jc_job_no','jc_reason','jc_remarks']);
    }

}
