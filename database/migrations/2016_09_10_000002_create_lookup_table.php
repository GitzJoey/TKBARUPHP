<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 1:17 PM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

Class CreateLookupTable extends Migration
{
    public function up()
    {
        Schema::create('lookup', function (Blueprint $table) {
            $table->string('code');
            $table->primary('code');
            $table->unique('code');
            $table->string('description');
            $table->string('category');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('lookup');
    }
}