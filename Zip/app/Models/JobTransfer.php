<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobTransfer extends Model
{
    use LogsActivity;


    protected $table = "job_transfer";
    protected $primaryKey='jt_id';

    use HasFactory;
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jt_job_no','jt_technician','jt_new_technician']);
    }

}
