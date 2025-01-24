<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobAccessoriesModel extends Model
{
    protected $table = "job_accessories";
    use HasFactory;
    protected $primaryKey='ja_id';
    use HasFactory;
    public $timestamps = false;

}
