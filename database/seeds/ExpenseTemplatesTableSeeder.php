<?php

use App\Model\ExpenseTemplate;
use Illuminate\Database\Seeder;

class ExpenseTemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ExpenseTemplate::create([
            'name' => 'Adding Value Expense',
            'type' => 'EXPENSETYPE.ADD',
            'amount' => 5000,
            'remarks' => 'Expense that add value'
        ]);

        ExpenseTemplate::create([
            'name' => 'Subtracting Value Expense',
            'type' => 'EXPENSETYPE.SUB',
            'amount' => 5000,
            'remarks' => 'Expense that subtract value'
        ]);

    }
}
