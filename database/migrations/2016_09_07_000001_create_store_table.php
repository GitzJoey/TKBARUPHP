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

class CreateStoreTable extends Migration
{
    public function up()
    {
        Schema::create('store', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('fax_num')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('status')->nullable();
            $table->string('is_default')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('store');
    }
}