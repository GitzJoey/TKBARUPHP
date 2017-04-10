<?php

namespace App\Console\Commands;

use App\User;
use App\Model\Role;
use App\Model\Permission;
use App\Model\Lookup;
use App\Model\UserDetail;
use App\Services\StoreService;

use Illuminate\Console\Command;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user-create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create User';

    /**
     * Store Service
     *
     * @var App\Service\Store
     */
    protected $storeService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(StoreService $storeService)
    {
        parent::__construct();
        $this->storeService = $storeService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $availableRoles = Role::all();
        $availablePermissions = Permission::all();
        $availableUserTypes = Lookup::where('code', 'like', 'USERTYPE.%')->get();

        $name = $this->ask('Name?');
        $email = $this->ask('Email?');
        $password = $this->ask('Password?');

        $askStore = true;
        while ($askStore) {
            $store_id = $this->ask('Store ID?');

            if (!$this->storeService->getStore($store_id)) {
                $this->error('Store is not found!');
            } else {
                $askStore = false;
            }
        }

        $allow_login = $this->choice('Allow Login?', ['yes', 'no']);
        $user_type = $this->choice('User Type?', $availableUserTypes->pluck('code')->toArray());

        $roles = collect([]);
        $role = 1;

        while ($role != 'No') {
            $role = $this->choice('Do you want to add role?', $availableRoles->pluck('name')->prepend('No')->toArray(), 0);
            if ($role != 'No') {
                $roles->push($role);
            }
        }

        $permissions = collect([]);
        $permission = 1;

        while ($permission != 'No') {
            $permission = $this->choice('Do you want to add permission?', $availablePermissions->pluck('name')->prepend('No')->toArray(), 0);
            if ($permission != 'No') {
                $permissions->push($permission);
            }
        }

        $this->info('Name: '.$name);
        $this->info('Email: '.$email);
        $this->info('Password: '.$password);
        $this->info('Store ID: '.$store_id);
        $this->info('Store Name: '.$this->storeService->getStore($store_id)->name);
        $this->info('Allow Login: '.$allow_login);

        if ($roles->count()) {
            $this->info('Roles:');

            foreach ($roles as $roleName) {
                $this->info($roleName);
            }
        }

        if ($permissions->count()) {
            $this->info('Permissions:');

            foreach ($permissions as $permissionName) {
                $this->info($permissionName);
            }
        }

        if ($this->confirm('Do you wish to continue?')) {
            $user = User::create([
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
            ]);

            $user->store()->associate($store_id);
            $user->save();

            $user_detail = new UserDetail();
            $user_detail->allow_login = $allow_login == 'yes' ?: false;
            $user_detail->type = $user_type;
            $user->userDetail()->save($user_detail);

            foreach ($roles as $roleName) {
                $user->attachRole(Role::where('name', $roleName)->first());
            }

            foreach ($permissions as $permissionName) {
                $user->attachPermission(Permission::where('name', $permissionName)->first());
            }

            $this->info('User created!');
        } else {
            $this->info('Abort');
        }
    }
}
