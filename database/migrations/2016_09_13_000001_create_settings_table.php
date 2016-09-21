<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/13/2016
 * Time: 9:57 PM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

Class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('skey')->nullable();
            $table->unique('skey');
            $table->unique('user_id');
            $table->string('category')->nullable();
            $table->string('value')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('settings');
    }
}