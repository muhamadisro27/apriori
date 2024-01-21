<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\DataTransaction;
use App\Models\DetailTransaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    protected $transactions;

    public function __construct()
    {
        $this->transactions = collect(json_decode(file_get_contents(__DIR__ . '../../data/data-transactions.json', true)));
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
                'transaction_code' => $transaction_create->transaction_code,
                'item_code' => $transaction->item_code,
                'item_name' => $transaction->item_name,
                'quantity' => $transaction->quantity,
            ]);
        }
    }
}
