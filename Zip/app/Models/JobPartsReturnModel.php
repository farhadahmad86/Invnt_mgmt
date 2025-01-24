<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class JobPartsReturnModel extends Model
{

    protected $table = "job_parts_return";
    protected $primaryKey='jpr_id';

    use HasFactory;
    public $timestamps = false;


}
