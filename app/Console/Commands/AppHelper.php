<?php
/**
 * Created by PhpStorm.
 * User: gitzj
 * Date: 11/9/2017
 * Time: 9:43 AM
 */

namespace App\Console\Commands;

use App\Model\Item;
use App\Model\Payment;
use App\Model\Stock;
use App\Model\StockIn;
use App\Model\StockOut;
use App\Model\Permission;
use App\Model\SalesOrder;
use App\Model\PurchaseOrder;

use App;
use File;
use Artisan;
use Validator;
use Illuminate\Console\Command;

class AppHelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:helper';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'App Helper';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Available Helper:');
        $this->info('[1] Update Permission Table');
        $this->info('[2] Truncate All Transactions');
        $this->info('[3] Update Composer And NPM');

        $choose = $this->ask('Choose Helper');

        switch ($choose) {
            case 1:
                $this->updatePermission();
                break;
            case 2:
                $this->truncateTables();
                break;
            case 3:
                $this->updateComposerAndNPM();
                break;
            default:
                sleep(3);
                $this->info('Done!');
                break;
        }

    }

    private function updatePermission()
    {
        Artisan::call('db:seed', ['--class' => 'PermissionTableSeeder',]);
    }

    private function truncateTables()
    {
        $confirm = false;

        if (App::environment('prod', 'production')) {
            $this->info('*** PRODUCTION ENVIROMENT DETECTED ***');
            sleep(3);
            $confirm = $this->confirm('Execute truncating table in production enviroment?');
        } else {
            $confirm = true;
        }

        if (!$confirm) return;

        $selective = $this->confirm('Selective Truncate?');

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());

        $po = new PurchaseOrder();
        $this->info('Starting Truncating Table '. $po->getTable());
    }

    private function updateComposerAndNPM()
    {
        $this->info('Starting Composer Update');
        exec('composer update');

        $this->info('Starting NPM Update');
        exec('npm update');

        $this->info('Starting Mix');
        if (App::environment('prod', 'production')) {
            $this->info('Executing for production enviroment');
            exec('npm run prod');
        } else {
            exec('npm run dev');
        }
    }
}