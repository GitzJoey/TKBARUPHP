<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/9/2016
 * Time: 11:28 PM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

Class CreateProductTable extends Migration
{
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->string('name');
            $table->string('short_code');
            $table->string('description');
            $table->string('image_path');
            $table->string('status');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('product');
    }
}