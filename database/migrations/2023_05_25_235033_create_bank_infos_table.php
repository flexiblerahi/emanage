<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bank_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_name_id')->constrained('bank_names');
            $table->string('account_id', 500)->unique();
            $table->double('amount')->default(0);
            $table->text('address')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->foreignId('entry')->constrained('user_details');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bank_infos');
    }
};
