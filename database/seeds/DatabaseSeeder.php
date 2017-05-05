<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DefaultListUnitTableSeeder::class);
        $this->call(PhoneProviderTableSeeder::class);
        $this->call(LookupTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);

        /* DUMMY DATA */
        if (App::environment('local', 'dev')) {

            $this->command->info('Local/Development Enviroment Detected. Starting Dummy Data Seeder...');

            $this->call(BankTableSeeder::class);
            $this->call(ProductTableSeeder::class);
            $this->call(ProductTypeTableSeeder::class);
            $this->call(SupplierTableSeeder::class);
            $this->call(CustomerTableSeeder::class);
            $this->call(VendorTruckingTableSeeder::class);
            $this->call(WarehouseTableSeeder::class);
            $this->call(PriceLevelTableSeeder::class);
            $this->call(ExpenseTemplatesTableSeeder::class);
            $this->call(TrucksTableSeeder::class);
            $this->call(TruckMaintenancesTableSeeder::class);
        }
    }

    /**
     * Override the Seeder.php call method, to accept 2 parameters
     *
     * @param  string  $class
     * @param  string  $extra
     * @return void
     */
    public function call($class, $extra = null)
    {
        if (isset($this->command)) {
            $this->command->getOutput()->writeln("<info>Seeding:</info> $class");
        }

        $this->resolve($class)->run($extra);
    }
}
