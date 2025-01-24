<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedJobsModel extends Model
{
    protected $table = "failed_jobs";
    use HasFactory;
    public $timestamps = false;

}
