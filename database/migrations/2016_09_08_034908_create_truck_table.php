<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTruckTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plate_number');
            $table->unique('plate_number');
            $table->date('inspection_date');
            $table->string('driver');
            $table->tring('status');
            $table->string('remarks');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('truck');
    }
}
