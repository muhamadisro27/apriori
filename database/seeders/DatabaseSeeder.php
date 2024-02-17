<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataTransaction;
use App\Models\DetailTransaction;
use App\Models\Item;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $transactions, $items;

    public function __construct()
    {
        $this->transactions = Excel::toCollection(null, base_path('database/data/transactions.xlsx'));
        $this->items = Excel::toCollection(null, base_path('database/data/items.xlsx'));
    }

    public function run(): void
    {
        \App\Models\User::firstOrCreate([
            'email' => 'superadmin@mail.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('superadmin2024'),
        ]);

        foreach ($this->items as $item) {
            foreach ($item as $i) {
                Item::firstOrCreate([
                    'item_code' => $i[2],
                ], [
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
}
