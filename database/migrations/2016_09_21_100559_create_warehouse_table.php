<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id')->default(0);
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_num')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->bigIncrements('created_by')->default(0);
            $table->bigIncrements('updated_by')->default(0);
            $table->bigIncrements('deleted_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('warehouse');
    }
}
