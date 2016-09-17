<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/16/2016
 * Time: 12:27 PM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

Class CreateUserDetailTable extends Migration
{
    public function up()
    {
        Schema::create('user_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('type')->nullable();
            $table->boolean('allow_login')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('user_detail');
    }
}