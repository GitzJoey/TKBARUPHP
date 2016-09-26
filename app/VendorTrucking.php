<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/22/2016
 * Time: 3:16 AM
 */

namespace App;

use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Database\Eloquent\Model;

class VendorTrucking extends Model
{
    protected $table = 'vendor_trucking';

    protected $fillable = [
        'store_id', 'name', 'address', 'tax_id', 'status', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }

    public function bankAccount()
    {
        $this->hasMany('\App\BankAccount');
    }
}