<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobComplaintModel extends Model
{
    protected $table = "job_complaint";
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey='jc_id';

}
