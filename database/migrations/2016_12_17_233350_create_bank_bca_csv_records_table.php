<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankBcaCsvRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_bca_csv_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->string('remarks');
            $table->string('branch');
            $table->decimal('amount', 19, 2)->default(0);
            $table->string('db_cr');
            $table->decimal('balance', 19, 2)->default(0);
            $table->unsignedBigInteger('bank_upload_id')->default(0);
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
        Schema::dropIfExists('bank_bca_csv_records');
    }
}
