<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:09 AM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

Class CreatePhoneProviderTable extends Migration
{
    public function up()
    {
        Schema::create('phone_provider', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('short_name');
            $table->string('status');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('phone_provider');
    }
}