<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(DefaultStoreTableSeeder::class);
        $this->call(DefaultListUnitTableSeeder::class);
        $this->call(PhoneProviderTableSeeder::class);
        $this->call(CreateLookupTableSeeder::class);
        $this->call(BankTableSeeder::class);
    }
}
