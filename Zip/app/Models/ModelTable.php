<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ModelTable extends Model
{
    use LogsActivity;


    protected $table = "model_table";
    protected $primaryKey='mod_id';

    use HasFactory;
    public $timestamps = false;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['mod_name','mod_cat_id','mod_bra_id']);
    }

}
