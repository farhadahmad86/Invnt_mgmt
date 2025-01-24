<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobIssueToTechnicianModel extends Model
{
    use LogsActivity;

    protected $table = "job_issue_to_technician";
    protected $primaryKey='jitt_id';

    use HasFactory;
    public $timestamps = false;


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jitt_job_no','jitt_technician']);
    }
}
