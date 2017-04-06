<?php
/**
 * Created by PhpStorm.
 * User: Sugito
 * Date: 2/8/2017
 * Time: 8:22 AM
 */

namespace App\Services;


interface AccountingService
{
    public function createCashAccount();

    public function createCapitalDeposit();

    public function createCapitalWithdrawal();

    public function createCost();

    public function createRevenue();

    public function createNewCashFlow();
}