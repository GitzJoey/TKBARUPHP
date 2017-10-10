<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxOutputItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_output_items', function (Blueprint $table) {
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
        Schema::drop('tax_output_items');
    }
}
