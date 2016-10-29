<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id')->default(0);
            $table->unsignedBigInteger('item_id')->default(0);
            $table->unsignedBigInteger('selected_unit_id')->default(0);
            $table->unsignedBigInteger('base_unit_id')->default(0);
            $table->date('receipt_date')->nullable();
            $table->decimal('brutto')->default(0);
            $table->decimal('base_brutto')->default(0);
            $table->decimal('netto')->default(0);
            $table->decimal('base_netto')->default(0);
            $table->decimal('tare')->default(0);
            $table->decimal('base_tare')->default(0);
            $table->string('licence_plate')->nullable();
            $table->unsignedBigInteger('created_by')->default(0);
            $table->unsignedBigInteger('updated_by')->default(0);
            $table->unsignedBigInteger('deleted_by')->default(0);
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
        Schema::dropIfExists('receipts');
    }
}
