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
            $table->unsignedBigInteger('store_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('selected_unit_id');
            $table->unsignedBigInteger('base_unit_id');
            $table->date('receipt_date');
            $table->decimal('brutto');
            $table->decimal('base_brutto');
            $table->decimal('netto');
            $table->decimal('base_brutto');
            $table->decimal('tare');
            $table->decimal('base_tare');
            $table->string('licence_plate');
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
