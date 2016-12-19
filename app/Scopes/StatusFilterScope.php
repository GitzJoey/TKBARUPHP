<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 12/20/2016
 * Time: 1:10 AM
 */

namespace App\Scopes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Builder;

class StatusFilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param Builder $builder
     * @param Model $model
     */
    public function apply(Builder $builder, Model $model)
    {
        $builder->where($model->getTable().'.status', '=', 'STATUS.ACTIVE');
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

            if($where['column'] == 'status') {

                unset($query->wheres[$key]);

                $query->wheres = array_values($query->wheres);
            }
        }
    }
}