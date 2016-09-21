<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTruckMaintenance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('truck_maintenance', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('truck_id')->default(0);
            $table->string('maintenance_type',45)->nullable();
            $table->bigInteger('cost')->default(0);
            $table->bigInteger('odometer')->default(0);
            $table->string('remarks')->nullable();
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
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
        Schema::drop('truck_maintenance');
    }
}
