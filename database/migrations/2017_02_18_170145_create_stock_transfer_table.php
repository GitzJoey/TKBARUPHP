<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTransferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id')->default(0);
            $table->unsignedBigInteger('stock_id')->default(0);
            $table->unsignedBigInteger('product_id')->default(0);
            $table->dateTime('transfer_date')->nullable();
            $table->unsignedBigInteger('source_warehouse_id')->default(0);
            $table->unsignedBigInteger('destination_warehouse_id')->default(0);
            $table->decimal('quantity', 19, 2)->default(0);
            $table->decimal('cost', 19, 2)->default(0);
            $table->string('reason', 25)->nullable();
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
        Schema::dropIfExists('stock_transfers');
    }
}
