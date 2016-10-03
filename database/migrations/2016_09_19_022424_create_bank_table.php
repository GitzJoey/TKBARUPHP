<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->string('branch')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->bigIncrements('created_by')->default(0);
            $table->bigIncrements('updated_by')->default(0);
            $table->bigIncrements('deleted_by')->default(0);
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
        Schema::drop('bank');
    }
}
