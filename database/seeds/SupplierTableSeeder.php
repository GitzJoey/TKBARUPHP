<?php

use App\Model\Supplier;
use App\Model\Profile;
use App\Model\BankAccount;
use App\Model\PhoneNumber;

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($s = 0; $s < 3; $s++) {
            $supplier = new Supplier();
            $supplier->name = 'Supplier '.$s;
            $supplier->address = 'Jl. Supplier Alamat '.$s;
            $supplier->city = 'Kota Supplier '.$s;
            $supplier->phone_number = '0000000000';
            $supplier->fax_num = '0000000000';
            $supplier->tax_id = '123-123-123-123-123';

            $supplier->save();

            for ($b = 0; $b < 2; $b++) {
                $ba = new BankAccount();
                $ba->bank_id = $b + 1;
                $ba->account_number = '123123123';
                $ba->remarks = 'Bank ' . $b;

                $supplier->bankAccounts()->save($ba);
            }

            for ($p = 0; $p < 1; $p++) {
                $pf = new Profile();
                $pf->first_name = "First Name ".$p;
                $pf->last_name = "First Name ".$p;

                $supplier->profiles()->save($pf);

                for ($ph = 0; $ph < 1; $ph++) {
                    $phone = new PhoneNumber();
                    $phone->phone_provider_id = $ph;
                    $phone->number = '123123123';

                    $pf->phoneNumbers()->save($phone);
                }
            }
        }
    }
}
