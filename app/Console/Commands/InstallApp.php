<?php

namespace App\Console\Commands;

use App\User;
use App\Model\Store;
use App\Model\Role;
use App\Model\UserDetail;

use App;
use File;
use Config;
use Artisan;
use Validator;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InstallApp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run Installation';

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
        $this->info('Starting App Installation...');
        $this->info('Review this installation process in \App\Console\Commands\InstallApp.php');

        sleep(3);

        if (!File::exists('.env')) {
            $this->error('File Not Found: .env');
            $this->error('Aborted');
            return false;
        }

        $this->info('Generating App Key...');
        Artisan::call('key:generate');
        $this->info('Database Migrating...');
        if (App::environment('prod', 'production')) {
            Artisan::call('migrate', ['--force' => true,]);
        } else {
            Artisan::call('migrate');
        }
        $this->info('Seeding ...');
        if (App::environment('prod', 'production')) {
            Artisan::call('db:seed', ['--force' => true,]);
        } else {
            Artisan::call('db:seed');
        }
        $this->info('Storage Linking ...');
        if (is_link(public_path().'/storage')) {
            $this->info('Found Storage Link, Skipping ...');
        } else {
            Artisan::call('storage:link');
        }

        $this->info('Setup will create the default store and admin user');

        sleep(3);

        // setup default
        $storeName = 'Toko Baru';
        $userName = 'Admin';
        $userEmail = 'admin@tkbaru.com';
        $userPassword = 'thepassword';

        $valid = false;

        while (!$valid) {
            // input
            $storeName = $this->ask('Enter Default Store Name:', $storeName);
            $userName = $this->ask('Enter User Name:', $userName);
            $userEmail = $this->ask('Enter User Email:', $userEmail);
            $userPassword = $this->secret('Enter User Password:', $userPassword);

            $validator = Validator::make([
                'store' => $storeName,
                'name' => $userName,
                'email' => $userEmail,
                'password' => $userPassword
            ], [
                'store' => 'required|min:3|max:100',
                'name' => 'required|min:3|max:50',
                'email' => 'required|max:255|email|unique:users,email',
                'password' => 'required|min:7'
            ]);

            if (!$validator->fails()) {
                $valid = true;
            } else {
                foreach ($validator->errors()->all() as $errorMessage) {
                    $this->error($errorMessage);
                }
            }
        }

        // confirmation
        $confirmed = $this->confirm("Everything's OK? Do you wish to continue?");

        if (!$confirmed) {
            $this->error('Aborted');
            return false;
        }

        $this->info('Starting NPM Install');
        exec('npm install');

        $this->info('Starting Mix');
        if (App::environment('prod', 'production')) {
            $this->info('Executing for production enviroment');
            exec('npm run prod');
        } else {
            exec('npm run dev');
        }

        // create entity
        $store = Store::create([
            'name'                  => $storeName,
            'tax_id'                => '0000000000',
            'status'                => Config::get('lookups.STATUS.ACTIVE'),
            'is_default'            => Config::get('lookups.YESNOSELECT.YES'),
            'frontweb'              => Config::get('lookups.YESNOSELECT.YES'),
            'date_format'           => Config::get('const.DATETIME_FORMAT.PHP_DATE'),
            'time_format'           => Config::get('const.DATETIME_FORMAT.PHP_TIME'),
            'thousand_separator'    => Config::get('const.DIGIT_GROUP_SEPARATOR'),
            'decimal_separator'     => Config::get('const.DECIMAL_SEPARATOR'),
            'decimal_digit'         => Config::get('const.DECIMAL_DIGIT'),
        ]);

        if ($store) {
            $this->info('Store "'.$store->name.'" is created.');
        }

        $user = User::create([
            'name' => $userName,
            'email' => $userEmail,
            'password' => bcrypt($userPassword),
            'api_token' => str_random(60),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        if ($user) {
            $this->info('User "'.$user->name.'" is created.');
        }

        $this->info('Associate "'.$user->name.'" with "'.$store->name.'".');

        $user->store()->associate($store->id);
        $user->save();

        $this->info('Setup "'.$user->name.'" as Admin.');

        $userDetail = new UserDetail();
        $userDetail->allow_login = true;
        $userDetail->type = 'USERTYPE.A';
        $user->userDetail()->save($userDetail);

        $user->attachRole(Role::where('name', 'admin')->first());

        sleep(3);

        $this->info('Done!');
    }
}
