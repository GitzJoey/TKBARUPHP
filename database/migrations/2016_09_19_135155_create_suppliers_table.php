<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier', function ( Blueprint $table) {
            $table->increments('id');
            $table->string('supplier_name');
            $table->text('supplier_address');
            $table->string('supplier_city');
            $table->string('phone_number');
            $table->string('fax_num')->nullable();
            $table->string('tax_id')->nullable();
            $table->string('remarks');
            $table->string('status');
            $table->string('due_day')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('supplier');
    }
}
