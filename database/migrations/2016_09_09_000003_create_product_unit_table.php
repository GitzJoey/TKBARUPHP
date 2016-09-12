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

Class CreateProductUnitTable extends Migration
{
    public function up()
    {
        Schema::create('product_unit', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('store_id');
            $table->bigInteger('unit_id');
            $table->boolean('is_base');
            $table->decimal('conversion_value');
            $table->string('remarks');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('product');
        });

    }

    public function down()
    {
        Schema::drop('product_unit');
    }
}