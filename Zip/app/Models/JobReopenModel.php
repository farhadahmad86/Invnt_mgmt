<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobReopenModel extends Model
{
    use LogsActivity;

    protected $table = "job_reopen";
    protected $primaryKey='jro_id';

    use HasFactory;
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jro_job_no','jro_reason','jro_remarks']);
    }

}
