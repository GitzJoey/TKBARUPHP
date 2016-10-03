<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:14 PM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

class CreateUnitTable extends Migration
{
    public function up()
    {
        Schema::create('unit', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('symbol')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->bigIncrements('created_by')->default(0);
            $table->bigIncrements('updated_by')->default(0);
            $table->bigIncrements('deleted_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('unit');
    }
}