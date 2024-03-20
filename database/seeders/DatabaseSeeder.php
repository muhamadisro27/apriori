<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataTransaction;
use App\Models\DetailTransaction;
use App\Models\Item;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Uuid;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $transactions, $items, $users, $roles, $permissions;

    public function __construct()
    {
        $this->transactions = Excel::toCollection(null, base_path('database/data/transactions.xlsx'));
        $this->items = Excel::toCollection(null, base_path('database/data/items.xlsx'));
        $this->users = json_decode(file_get_contents(base_path('database/data/user.json'), true));
        $this->roles = json_decode(file_get_contents(base_path('database/data/role.json'), true));
        $this->permissions = json_decode(file_get_contents(base_path('database/data/permission.json'), true));
    }

    public function run(): void
    {
        // \App\Models\User::firstOrCreate([
        //     'email' => 'superadmin@mail.com',
        //     'uuid' => Uuid::uuid1()
        // ], [
        //     'name' => 'Super Admin',
        //     'password' => Hash::make('superadmin2024'),
        //     'phone_number' => '-'
        // ]);

         // initial role
         $this->command->info('initial permissions');
         $this->command->getOutput()->progressStart(count($this->permissions));
         foreach ($this->permissions as $permission) {
             $this->initializePermission($permission);
             $this->command->getOutput()->progressAdvance();
         }

         // initial role
         $this->command->info('initial roles');
         $this->command->getOutput()->progressStart(count($this->roles));
         foreach ($this->roles as $role) {
             $this->initializeRole($role);
             $this->command->getOutput()->progressAdvance();
         }

         // initial user
         $this->command->info('initial users');
         $this->command->getOutput()->progressStart(count($this->users));
         foreach ($this->users as $user) {
             $this->initializeUser($user);
             $this->command->getOutput()->progressAdvance();
         }

        foreach ($this->items as $item) {
            foreach ($item as $i) {
                Item::firstOrCreate([
                    'item_code' => $i[2],
                ], [
                    'uuid' => Uuid::uuid1(),
                    'item_name' => $i[1],
                    'quantity' => rand(1,5)
                ]);
            }
        }

        foreach ($this->transactions as $transaction) {
            foreach ($transaction as $t) {
                $date = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($t[4]))->translatedFormat('Y-m-d');

                $transaction_create = DataTransaction::firstOrCreate([
                    'transaction_code' => $t[3],
                ], [
                    'date' => $date,
                ]);

                DetailTransaction::create([
                    'item_code' => $t[0],
                    'data_transaction_id' => $transaction_create->id,
                    'item_name' => $t[1],
                    'quantity' => $t[2]
                ]);
            }
        }
    }

    protected function initializePermission($permission)
    {
        Permission::firstOrcreate([
            'name' => $permission->name,
        ], [
            'category' => $permission->category,
            'guard_name' => 'web',
        ]);
    }

    protected function initializeRole($role)
    {
        $new_role = Role::firstOrcreate([
            'name' => $role->name,
        ], [
            'uuid' => Uuid::uuid1(),
            'guard_name' => 'web'
        ]);

        $new_role->givePermissionTo($role->permissions);
    }

    protected function initializeUser($user)
    {
        $new_user = User::withoutEvents(function () use ($user) {
            return User::firstOrCreate([
                "name" => $user->name,
            ], [
                "uuid" => Uuid::uuid1(),
                "email" => $user->email,
                "email_verified_at" => null,
                "password" => bcrypt($user->password),
                "phone_number" => "-"
            ]);
        });

        $new_user->syncRoles($user->roles);

        $role = Role::where('name', $new_user->roles->pluck('name')[0])->first();

        $new_user->syncPermissions($role->permissions);
    }
}
