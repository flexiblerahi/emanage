<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions');
            $table->foreignId('user_details_id')->constrained('user_details')->cascadeOnDelete();
            $table->string('model_type');
            $table->unsignedBigInteger('model_id')->default(0);
            $table->double('amount')->default(0);
            $table->date('date')->nullable();
            $table->tinyInteger('status')->default(0)->comment('withdraw = 0, cashin = 1');
            $table->text('other')->nullable();
            $table->foreignId('entry')->constrained('user_details')->cascadeOnDelete();
            $table->text('comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_transactions');
    }
};
