<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_bank_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_info_id')->constrained('bank_infos');
            $table->foreignId('bank_name_id')->constrained('bank_names');
            $table->string('account_id', 500);
            $table->text('address')->nullable();
            $table->double('amount')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->foreignId('entry')->constrained('user_details');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_bank_infos');
    }
};
