<?php

/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/7/2016
 * Time: 12:06 AM
 */
namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Profile
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $address
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property integer $user_id
 * @property string $ic_num
 * @property string $image_filename
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereIcNum($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Profile whereImageFilename($value)
 */
class Profile extends Model
{
    protected $table = 'profiles';

    protected $fillable = [
        'first_name', 'last_name', 'address', 'ic_num', 'image_filename',
    ];

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}