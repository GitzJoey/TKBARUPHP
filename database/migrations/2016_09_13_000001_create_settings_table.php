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
            $table->string('skey');
            $table->primary('skey');
            $table->unique('skey');
            $table->string('category');
            $table->string('value');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('settings');
    }
}