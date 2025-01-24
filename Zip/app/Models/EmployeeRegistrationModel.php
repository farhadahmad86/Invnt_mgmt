<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class EmployeeRegistrationModel extends Model
{
    use LogsActivity;

    protected $table = "users";
    use HasFactory;
    protected $primaryKey='id';
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name','f_name','address','login_status','gender','email','employee_status','number','work_status']);
    }
}
