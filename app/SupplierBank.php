<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\SupplierBank
 *
 * @property-read \App\Bank $bank
 * @method static \Illuminate\Database\Query\Builder|\App\SupplierBank supplier($id)
 * @mixin \Eloquent
 */
class SupplierBank extends Model
{
    protected $table = 'supplier_bank';
    protected $fillable = ['bank_id','supplier_id','account','remarks','status'];

    public function scopeSupplier($query, $id)
    {
    	return $query->where('supplier_id', $id);
    }

    public function getBank()
    {
    	return $this->belongsTo('App\Bank');
    }
}
