<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('backup_expense_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expense_item_id')->constrained('expense_items')->cascadeOnDelete();
            $table->string('title');
            $table->foreignId('parent')->nullable()->constrained('expense_items');
            $table->foreignId('entry')->constrained('user_details');
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('backup_expense_items');
    }
};
