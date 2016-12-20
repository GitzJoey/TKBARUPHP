<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 9/10/2016
 * Time: 11:09 AM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

Class CreatePhoneProvidersTable extends Migration
{
    public function up()
    {
        Schema::create('phone_providers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->default(0);
            $table->unsignedBigInteger('updated_by')->default(0);
            $table->unsignedBigInteger('deleted_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::drop('phone_providers');
    }
}