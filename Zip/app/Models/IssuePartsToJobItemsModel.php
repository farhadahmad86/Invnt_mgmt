<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class IssuePartsToJobItemsModel extends Model
{
    use LogsActivity;

    protected $table = "issue_parts_to_job_items";
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'iptji_id';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['iptji_iptj_id','iptji_parts','iptji_qty','iptji_rate','iptji_amount']);
    }
}
