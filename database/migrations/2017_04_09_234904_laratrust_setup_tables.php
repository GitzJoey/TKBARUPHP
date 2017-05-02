<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class LaratrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Laratrust migration setup has been done in EntrustSetupTables.
        // Just add a bit...

        Schema::table('role_user', function (Blueprint $table) {
            $table->string('user_type');

            $table->dropForeign('role_user_user_id_foreign');
            $table->dropPrimary('role_user_id_primary');

            $table->primary(['user_id', 'role_id', 'user_type']);
        });

        // Create table for associating permissions to users (Many To Many Polymorphic)
        Schema::create('permission_user', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('user_type');

            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'user_id', 'user_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('permission_user');

        Schema::table('role_user', function (Blueprint $table) {
            $table->dropPrimary('role_user_id_primary');

            $table->primary(['user_id', 'role_id']);
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->dropColumn('user_type');
        });
    }
}
