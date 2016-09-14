<?php
/**
 * Created by PhpStorm.
 * User: GitzJoey
 * Date: 9/14/2016
 * Time: 1:17 AM
 */

use \Illuminate\Support\Facades\Schema;
use \Illuminate\Database\Schema\Blueprint;
use \Illuminate\Database\Migrations\Migration;

Class AlterUserTable extends Migration
{
    public function up()
    {
        if(Schema::hasTable('users') && !Schema::hasColumn('users', 'store_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('store_id')->default(0);
            });
        }

        if(Schema::hasTable('users') && !Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')->default(0);
            });
        }

        if(Schema::hasTable('users') && !Schema::hasColumn('users', 'profile_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('profile_id')->default(0);
            });
        }

        DB::statement("ALTER TABLE users CHANGE COLUMN profile_id profile_id BIGINT(20) UNSIGNED DEFAULT '0' AFTER id");
        DB::statement("ALTER TABLE users CHANGE COLUMN role_id role_id BIGINT(20) UNSIGNED DEFAULT '0' AFTER id");
        DB::statement("ALTER TABLE users CHANGE COLUMN store_id store_id BIGINT(20) UNSIGNED DEFAULT '0' AFTER id");
    }

    public function down()
    {

    }
}