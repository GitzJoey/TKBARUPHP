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
            $table->unsignedBigInteger('product_id')->default(0);
            $table->bigInteger('unit_id')->default(0);
            $table->boolean('is_base')->nullable();
            $table->decimal('conversion_value')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::drop('product_unit');
    }
}