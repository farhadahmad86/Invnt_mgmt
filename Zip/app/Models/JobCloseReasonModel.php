<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobCloseReasonModel extends Model
{
    use LogsActivity;

    protected $table = "job_close_reason";
    protected $primaryKey='jcr_id';
    use HasFactory;
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jcr_name']);
    }
}
