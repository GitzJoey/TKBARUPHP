<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 2/8/2017
 * Time: 12:04 AM
 */

namespace App\Model;


use App\Traits\StoreFilter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountingCost extends Model
{
    use SoftDeletes;

    use StoreFilter;

    protected $dates = ['deleted_at'];

    protected $table = 'acc_cost';

    protected $fillable = [
        'store_id',
        'date',
        'source_account_id',
        'category_id',
        'amount',
        'remarks',
    ];

}