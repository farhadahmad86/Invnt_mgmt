<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetsModel extends Model
{
    protected $table = "password_resets";

    use HasFactory;
    public $timestamps = false;

}
