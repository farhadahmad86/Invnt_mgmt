<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobInformationItemsModel extends Model
{
    use LogsActivity;


    protected $table = "job_information_items";
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'jii_id';


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['jii_ji_id','jii_item_name','jii_status']);
    }
}
