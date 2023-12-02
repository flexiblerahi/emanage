<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_other_deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('other_deposit_id')->constrained('other_deposits');
            $table->text('other')->nullable();
            $table->string('document')->nullable();
            $table->foreignId('entry')->constrained('user_details');
            $table->text('comment');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_other_deposits');
    }
};
