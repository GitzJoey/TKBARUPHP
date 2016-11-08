<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddItemableTypeToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('itemable_type');
        });

        DB::statement("ALTER TABLE items CHANGE COLUMN itemable_type itemable_type VARCHAR(255) CHARACTER SET 'utf8' NOT NULL AFTER itemable_id");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('itemable_type');
        });
    }
}
