<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxInputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_inputs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->string('invoice_date');
            $table->integer('month');
            $table->integer('year');
            $table->boolean('is_creditable')->default(false);
            $table->string('opponent_tax_id_no');
            $table->string('opponent_name');
            $table->string('detail');
            $table->integer('qty');
            $table->integer('unit_price');
            $table->bigInteger('tax_base');
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
        Schema::dropIfExists('tax_inputs');
    }
}
