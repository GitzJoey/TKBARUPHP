<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccRevenueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acc_revenue', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('store_id')->default(0);
            $table->dateTime('date')->nullable();
            $table->unsignedBigInteger('destination_cash_account_id')->default(0);
            $table->unsignedBigInteger('revenue_category_id')->default(0);
            $table->decimal('amount', 19, 2)->default(0);
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
        Schema::drop('acc_revenue');
    }
}
