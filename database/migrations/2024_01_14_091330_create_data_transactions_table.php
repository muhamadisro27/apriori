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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->string('item_name');
            $table->string('item_code');
            $table->string('quantity');
            $table->timestamps();
            $table->softDeletes();
        });

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

        Schema::create('result_itemsets', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->integer('item_set_combination');
            $table->timestamps();
        });

        Schema::create('detail_result_itemsets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('result_itemset_id')->unsigned();
            $table->integer('item_set_combination');
            $table->string('item_codes');
            $table->string('item_names');
            $table->bigInteger('frequency');
            $table->float('support_count');
            $table->float('minimal_support');
            $table->tinyInteger('remark');
            $table->timestamps();
        });

        Schema::table('detail_result_itemsets', function (Blueprint $table) {
            $table->foreign('result_itemset_id')->references('id')->on('result_itemsets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
        Schema::dropIfExist('data_transactions');
        Schema::dropIfExists('detail_transactions');
        Schema::dropIfExists('result_itemsets');
        Schema::dropIfExists('detail_result_itemsets');
    }
};
