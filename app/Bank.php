<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:25 AM
 */

namespace App;

use \Illuminate\Database\Eloquent\Model;
use Vinkla\Hashids\Facades\Hashids;
/**
 * App\Bank
 *
 * @mixin \Eloquent
 */
class Bank extends Model
{
    protected $table = 'bank';

    protected $fillable = [
        'name', 'short_name', 'branch', 'branch_code', 'status', 'remarks'
    ];

    public function hId() {
        return HashIds::encode($this->attributes['id']);
    }
}