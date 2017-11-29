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

Class AlterUsersTable extends Migration
{
    public function up()
    {
        if(Schema::hasTable('users') && !Schema::hasColumn('users', 'store_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('store_id')->default(0);
                $table->string('api_token', 60)->unique();
                $table->boolean('active')->default(false);
                $table->string('activation_token', 60)->unique();
            });
        }

        DB::statement("ALTER TABLE users CHANGE COLUMN store_id store_id BIGINT(20) UNSIGNED DEFAULT '0' AFTER id");
        DB::statement("ALTER TABLE users CHANGE COLUMN api_token api_token VARCHAR(60) CHARACTER SET 'utf8' NULL DEFAULT NULL AFTER remember_token");
        DB::statement("ALTER TABLE users CHANGE COLUMN active active TINYINT(1) NOT NULL DEFAULT '0' AFTER api_token");
        DB::statement("ALTER TABLE users CHANGE COLUMN activation_token activation_token VARCHAR(60) CHARACTER SET 'utf8' NULL DEFAULT NULL AFTER active");
    }

    public function down()
    {

    }
}