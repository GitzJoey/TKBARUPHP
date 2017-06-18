<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no')->unique();
            $table->string('invoice_date');
            $table->string('gst_transaction_type')->nullable();
            $table->string('transaction_doc')->nullable();
            $table->string('transaction_detail')->nullable();
            $table->integer('month');
            $table->integer('year');
            $table->string('tax_id_no');
            $table->string('name');
            $table->string('address');
            $table->string('opponent_tax_id_no');
            $table->string('opponent_name');
            $table->string('opponent_address');
            $table->string('gst_type');
            $table->bigInteger('tax_base');
            $table->bigInteger('gst');
            $table->bigInteger('luxury_tax');
            $table->string('reference');
            $table->unsignedBigInteger('created_by')->default(0);
            $table->unsignedBigInteger('updated_by')->default(0);
            $table->unsignedBigInteger('deleted_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for associating roles to users (Many To Many Polymorphic)
        Schema::create('tax_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('transactionable_id')->unsigned()->index();
            $table->string('transactionable_type')->nullable();
            $table->string('name');
            $table->boolean('is_gst_included');
            $table->bigInteger('price');
            $table->bigInteger('discount');
            $table->bigInteger('qty');
            $table->bigInteger('gst');
            $table->bigInteger('luxury_tax');
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
        Schema::drop('tax_items');
        Schema::drop('taxes');
    }
}
