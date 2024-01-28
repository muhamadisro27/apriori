<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('transaction_code')->unique();
            $table->timestamps();
        });

        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('data_transaction_id')->unsigned();
            $table->string('item_code');
            $table->string('item_name');
            $table->unsignedInteger('quantity');
            $table->timestamps();
        });

        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->foreign('data_transaction_id')->references('id')->on('data_transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExist('data_transactions');
        Schema::dropIfExists('detail_transactions');
    }
};
