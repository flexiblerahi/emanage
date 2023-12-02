<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('other_deposits', function (Blueprint $table) {
            $table->id();
            $table->string('account_id', 500)->unique();
            $table->text('other')->nullable();
            $table->string('document')->nullable();
            $table->foreignId('entry')->constrained('user_details');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('other_deposits');
    }
};
