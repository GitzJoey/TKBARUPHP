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
use App\Model\Price;
use App\Model\Receipt;
use App\Model\Deliver;
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
        $this->info('[4] Check Outdated NPM Packages');
        $this->info('[5] Language Sync');
        $this->info('[6] Update Lookup Table');
        $this->info('[7] Clear All Cache');

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
            case 3:
                $this->updateComposerAndNPM();
                break;
            case 4:
                $this->checkOutdated();
                break;
            case 5:
                $this->langSync();
                break;
            case 6:
                $this->updateLookup();
                break;
            case 7:
                $this->clearCache();
                break;
            default:
                break;
        }

        sleep(3);
        $this->info('Done!');
    }

    private function clearCache()
    {
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('debugbar:clear');
        Artisan::call('cache:clear');
        Artisan::call('clear-compiled');

        exec('composer dump-autoload');
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
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $po->getTable())) {
                PurchaseOrder::truncate();
            }
        } else {
            PurchaseOrder::truncate();
        }

        $so = new SalesOrder();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $so->getTable())) {
                SalesOrder::truncate();
            }
        } else {
            SalesOrder::truncate();
        }

        $item = new Item();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $item->getTable())) {
                Item::truncate();
            }
        } else {
            Item::truncate();
        }

        $r = new Receipt();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $r->getTable())) {
                Receipt::truncate();
            }
        } else {
            Receipt::truncate();
        }

        $d = new Deliver();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $d->getTable())) {
                Deliver::truncate();
            }
        } else {
            Deliver::truncate();
        }

        $payment = new Payment();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $payment->getTable())) {
                Payment::truncate();
            }
        } else {
            Payment::truncate();
        }

        $stock = new Stock();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $stock->getTable())) {
                Stock::truncate();
            }
        } else {
            Stock::truncate();
        }

        $stockin = new StockIn();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $stockin->getTable())) {
                StockIn::truncate();
            }
        } else {
            StockIn::truncate();
        }

        $stockout = new StockOut();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $stockout->getTable())) {
                StockOut::truncate();
            }
        } else {
            StockOut::truncate();
        }

        $pr = new Price();
        if ($selective) {
            if ($this->confirm('Starting Truncating Table '. $pr->getTable())) {
                Price::truncate();
            }
        } else {
            Price::truncate();
        }
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

    private function checkOutdated()
    {
        $this->info('Start Checking Outdated Packages');
        exec('npm outdated', $out);
        print_r($out);
    }

    private function langSync()
    {
        Artisan::call('langman:sync');
    }

    private function updateLookup()
    {
        Artisan::call('db:seed', ['--class' => 'LookupTableSeeder',]);
    }
}