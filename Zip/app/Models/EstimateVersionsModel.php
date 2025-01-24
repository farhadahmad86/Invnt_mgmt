<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EstimateVersionsModel extends Model
{
    use LogsActivity;

    protected $table = "estimate_versions";
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey='ev_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['ev_job_no','ev_old_estimate_version','ev_new_estimate_version','ev_reason','ev_remarks']);
    }
}
