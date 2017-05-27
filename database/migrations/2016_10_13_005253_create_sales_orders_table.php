<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id')->default(0);
            $table->unsignedBigInteger('customer_id')->default(0);
            $table->unsignedBigInteger('warehouse_id')->default(0);
            $table->unsignedBigInteger('vendor_trucking_id')->default(0);
            $table->string('code')->nullable();
            $table->dateTime('so_created')->nullable();
            $table->string('so_type')->nullable();
            $table->dateTime('shipping_date')->nullable();
            $table->string('customer_type')->nullable();
            $table->string('walk_in_cust')->nullable();
            $table->string('walk_in_cust_detail')->nullable();
            $table->string('article_code')->nullable();
            $table->string('remarks')->nullable();
            $table->string('internal_remarks')->nullable();
            $table->string('private_remarks')->nullable();
            $table->string('status')->nullable();
            $table->decimal('disc_percent', 5,2)->unsigned()->nullable();
            $table->decimal('disc_value', 19,2)->unsigned()->nullable();
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
        Schema::drop('sales_orders');
    }
}