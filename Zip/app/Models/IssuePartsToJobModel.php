<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class IssuePartsToJobModel extends Model
{
    use LogsActivity;

    protected $table = "issue_parts_to_job";
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey='iptj_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['iptj_job_no','iptj_remarks','iptj_status']);
    }
}
