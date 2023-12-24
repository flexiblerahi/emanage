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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            // $table->string('sku')->unique();
            $table->string('name', 500);
            // $table->text('description')->nullable();
            // $table->string('image')->nullable();
            $table->foreignId('entry')->constrained('users');
            $table->index('name', 'brands_name_index');
            // $table->index('sku', 'brands_sku_index');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brands');
    }
};
