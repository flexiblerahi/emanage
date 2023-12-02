<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('account_id', 500)->unique();
            $table->foreignId('bank_info_id')->nullable()->constrained('bank_infos');
            $table->double('amount')->default(0);
            $table->tinyInteger('trx_by')->default(0)->comment('cash=0,online_transfer=1,check=2');
            $table->string('trx_no')->nullable()->comment('transaction_no');
            $table->text('other')->nullable();
            $table->tinyInteger('status')->default(0)->comment('withdraw=0,cashin=1');
            $table->date('date')->nullable();
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->foreignId('entry')->constrained('user_details');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_transactions');
    }
};
