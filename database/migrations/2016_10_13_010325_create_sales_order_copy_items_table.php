<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderCopyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_copy_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_order_copy_id')->default(0);
            $table->unsignedBigInteger('product_id')->default(0);
            $table->unsignedBigInteger('selected_unit_id')->default(0);
            $table->unsignedBigInteger('base_unit_id')->default(0);
            $table->decimal('conversion_value')->default(0);
            $table->decimal('quantity')->default(0);
            $table->decimal('price')->default(0);
            $table->decimal('to_base_quantity')->default(0);
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
        Schema::drop('sales_order_copy_items');
    }
}
