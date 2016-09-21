<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/13/2016
 * Time: 11:57 PM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

Class CreateProfileTable extends Migration
{
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->unique('user_id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('ic_num')->nullable();
            $table->string('image_filename')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('profiles');
    }
}