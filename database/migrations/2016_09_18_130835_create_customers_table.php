<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function ( Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id')->default(0);
            $table->string('sign_code')->nullable();
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->decimal('latitude', 9, 6)->nullable();
            $table->decimal('longitude', 9, 6)->nullable();
            $table->bigInteger('distance')->nullable();
            $table->string('distance_text')->nullable();
            $table->bigInteger('duration')->nullable();
            $table->string('duration_text')->nullable();
            $table->string('city')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fax_num')->nullable();
            $table->string('tax_id')->nullable();
            $table->integer('payment_due_day')->default(0);
            $table->unsignedBigInteger('price_level_id')->default(0);
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::drop('customers');
    }
}
