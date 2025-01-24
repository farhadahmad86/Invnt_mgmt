<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    protected $table = "job_accessories";
    use HasFactory;
    public $timestamps = false;

    protected $primaryKey='ja_id';

}
