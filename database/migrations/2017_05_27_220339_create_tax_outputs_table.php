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
<<<<<<< HEAD:database/migrations/2017_05_27_220339_create_taxes_table.php
            $table->string('invoice_no');
=======
            $table->string('invoice_no')->nullable();
>>>>>>> dd9b1bb0909e6ab80169f0b655b212352469381a:database/migrations/2017_05_27_220339_create_tax_outputs_table.php
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
