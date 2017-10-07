<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_outputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no')->nullable();
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tax_outputs');
    }
}
