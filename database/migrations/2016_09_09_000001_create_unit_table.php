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
            $table->increments('id');
            $table->string('unit_name');
            $table->string('symbol');
            $table->string('status');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('unit');
    }
}