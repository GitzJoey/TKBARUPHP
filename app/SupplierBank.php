<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierBank extends Model
{
    protected $table = 'supplier_bank';
    protected $fillable = ['bank_id','supplier_id','account','remarks','status'];

    public function scopeSupplier($query, $id)
    {
    	return $query->where('supplier_id', $id);
    }

    public function bank()
    {
    	return $this->belongsTo('App\Bank');
    }
}
