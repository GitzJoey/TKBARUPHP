<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 12/17/2016
 * Time: 11:44 AM
 */

namespace App\Scopes;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class StoreFilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        if (!is_null(Auth::user()) && !empty(Auth::user()->store_id)) {
            $builder->where($model->getTable().'.store_id', '=', Auth::user()->store_id);
        }
    }

    /**
     * Remove the scope from the given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function remove(Builder $builder, Model $model)
    {
        $query = $builder->getQuery();

        foreach((array)$query->wheres as $key => $where) {

            if($where['column'] == 'store_id') {

                unset($query->wheres[$key]);

                $query->wheres = array_values($query->wheres);
            }
        }
    }
}