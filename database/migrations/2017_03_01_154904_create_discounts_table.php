<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_orders', function($table)
        {
            $table->decimal('disc_percent', 5,2)->unsigned()->after('status')->nullable();
            $table->decimal('disc_value', 19,2)->unsigned()->after('disc_percent')->nullable();
        });
        Schema::table('sales_orders', function($table)
        {
            $table->decimal('disc_percent', 5,2)->unsigned()->after('status')->nullable();
            $table->decimal('disc_value', 19,2)->unsigned()->after('disc_percent')->nullable();
        });
        
        Schema::create('item_discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('discountable_id');
            $table->string('discountable_type');
            $table->decimal('item_disc_percent', 5,2);
            $table->decimal('item_disc_value', 19,2);
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
        Schema::dropIfExists('item_discounts');
    }
}
