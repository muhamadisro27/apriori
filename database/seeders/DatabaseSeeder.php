<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataTransaction;
use App\Models\DetailTransaction;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $transactions, $items;

    public function __construct()
    {
        $this->transactions = collect(json_decode(file_get_contents(__DIR__ . '../../data/data-transactions.json', true)));
        $this->items = ['Sikat', 'Pelan', 'Sabun','Shampoo', 'Roti', 'Susu', 'Mentega', 'Minyak', 'Pel', 'Sapu'];
    }

    public function run(): void
    {
        \App\Models\User::firstOrCreate([
            'email' => 'superadmin@mail.com',
        ], [
            'name' => 'Super Admin',
            'password' => Hash::make('superadmin2024'),
        ]);

        foreach ($this->transactions as $transaction) {
            $transaction_create = DataTransaction::firstOrCreate([
                'transaction_code' => $transaction->transaction_code,
            ], [
                'date' => $transaction->date,
            ]);

            DetailTransaction::create([
                'data_transaction_id' => $transaction_create->id,
                'item_code' => $transaction->item_code,
                'item_name' => $transaction->item_name,
                'quantity' => $transaction->quantity,
            ]);
        }

        // for($i=1; $i < rand(100, 200); $i++) {
        //     $transaction = DataTransaction::create([
        //         'date' => now()->subDay(rand(1, 55)),
        //         'transaction_code' => 'Ca-' . (string) $i
        //     ]);

        // }

        // for($j =0; $j < 500; $j++) {
        //     DetailTransaction::firstOrCreate([
        //         'item_code' => 'Gs00'. (string) $j,
        //     ],[
        //         'data_transaction_id' => DataTransaction::all()->random()->id,
        //         'item_name' => Arr::random($this->items),
        //         'quantity' => rand(5, 8)
        //     ]);
        // }
    }
}
