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
            $table->string('first_name');
            $table->string('last_name');
            $table->string('address');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('profiles');
    }
}