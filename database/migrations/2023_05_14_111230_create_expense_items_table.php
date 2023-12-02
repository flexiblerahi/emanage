<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('expense_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->foreignId('parent')->nullable()->constrained('expense_items')->cascadeOnDelete();
            $table->foreignId('entry')->constrained('user_details');
            $table->tinyInteger('status')->default(0)->comment('if expense have then 1 else 0');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expense_items');
    }
};
