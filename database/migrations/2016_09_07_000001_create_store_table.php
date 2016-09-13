<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 11:06 AM
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTable extends Migration
{
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('address');
            $table->string('phone_num');
            $table->string('fax_num');
            $table->string('tax_id');
            $table->string('status');
            $table->string('is_default');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('store');
    }
}