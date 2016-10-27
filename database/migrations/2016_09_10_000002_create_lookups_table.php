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

Class CreateLookupsTable extends Migration
{
    public function up()
    {
        Schema::create('lookups', function (Blueprint $table) {
            $table->string('code')->nullable();
            $table->primary('code');
            $table->unique('code');
            $table->string('description')->nullable();
            $table->string('category')->nullable();
        });
    }

    public function down()
    {
        Schema::drop('lookups');
    }
}