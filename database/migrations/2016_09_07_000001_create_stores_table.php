<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/7/2016
 * Time: 11:06 AM
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoresTable extends Migration
{
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->string('phone_num')->nullable();
            $table->string('fax_num')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('status')->nullable();
            $table->string('is_default')->nullable();
            $table->string('frontweb')->nullable();
            $table->string('image_filename')->nullable();
            $table->string('remarks')->nullable();
            $table->string('date_format')->nullable();
            $table->string('time_format')->nullable();
            $table->string('thousand_separator')->nullable();
            $table->string('decimal_separator')->nullable();
            $table->integer('decimal_digit')->default(0);
            $table->string('ribbon')->nullable();
            $table->unsignedBigInteger('created_by')->default(0);
            $table->unsignedBigInteger('updated_by')->default(0);
            $table->unsignedBigInteger('deleted_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('stores');
    }
}