<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 10/24/2016
 * Time: 10:33 AM
 */

use App\Model\Profile;
use App\Model\Customer;
use App\Model\PriceLevel;
use App\Model\BankAccount;
use App\Model\PhoneNumber;

use Illuminate\Database\Seeder;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($s = 0; $s < 3; $s++) {
            $customer = new Customer();
            $customer->name = 'Customer '.$s;
            $customer->address = 'Jl. Customer Alamat '.$s;
            $customer->city = 'Kota Customer '.$s;
            $customer->phone_number = '0000000000';
            $customer->fax_num = '0000000000';
            $customer->tax_id = '123-123-123-123-123';
            $customer->price_level_id = 1;
            $customer->status = 'STATUS.ACTIVE';
            $customer->store_id = 1;

            $customer->save();

            for ($b = 0; $b < 2; $b++) {
                $ba = new BankAccount();
                $ba->bank_id = $b + 1;
                $ba->account_name = 'name 123123123';
                $ba->account_number = '123123123';
                $ba->remarks = 'Bank ' . $b;

                $customer->bankAccounts()->save($ba);
            }

            for ($p = 0; $p < 1; $p++) {
                $pf = new Profile();
                $pf->first_name = "First Name ".$p;
                $pf->last_name = "First Name ".$p;

                $customer->profiles()->save($pf);

                for ($ph = 0; $ph < 1; $ph++) {
                    $phone = new PhoneNumber();
                    $phone->phone_provider_id = $ph + 1;
                    $phone->number = '123123123';

                    $pf->phoneNumbers()->save($phone);
                }
            }
        }
    }
}