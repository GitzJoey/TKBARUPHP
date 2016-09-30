<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierSetting extends Model
{
    protected $table = 'supplier_setting';
    protected $fillable = ['supplier_id','due_day'];

}
